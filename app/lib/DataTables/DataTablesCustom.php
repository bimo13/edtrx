<?php namespace DataTables;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Bllim\Datatables\Datatables;
use Exception;
use Response;
use Excel;
use View;

class DataTablesCustom extends Datatables {

    public $viewPath = false;
    public $additionalData = array();
    public $title;
    public $filename;
    public $formats = array();

    /**
     * Organizes works
     *
     * @return null
     */
    public function export($mDataSupport=false,$raw=false)
    {
        $this->mDataSupport = $mDataSupport;
        $this->create_last_columns();
        $this->count('count_all');
        $this->filtering();
        $this->count('display_all');
        $this->get_result();
        $this->init_columns();
        $this->regulate_array();

        $data = $this->result_array;

        if (!$this->viewPath)
            throw new Exception('FATAL ERROR : You have to pass [view]');

        $path = $this->viewPath;

        $additionalData = $this->additionalData;

        $formats = $this->formats;

        $title = $this->title;

        if ($this->debug) {
            return View::make($path, compact('data', 'additionalData'));
        }

        Excel::create($this->filename, function($excel) use ($path, $data, $additionalData, $title, $formats)
            {
                $excel->setTitle($title);
                $excel->setCreator('Erasmus+')->setCompany('Altissia');
                $excel->sheet($title, function($sheet) use ($path,$data, $additionalData, $formats)
                    {
                        $sheet->loadView($path, compact('data', 'additionalData'));
                        if (count($formats) > 0) {
                            $sheet->setColumnFormat($formats);
                        }
                    });
            })->export('xlsx');

        exit;
    }

    /**
     * Organizes works
     *
     * @return null
     */
    public function out($mDataSupport=false,$raw=false)
    {
        $this->mDataSupport = $mDataSupport;
        $this->create_last_columns();
        $this->count_custom('count_all'); //Total records
        $this->custom_filtering();
        $this->count_custom('display_all'); // Filtered records
        $this->paging();
        $this->ordering();
        $this->get_result();
        $this->init_columns();
        $this->regulate_array();

        return $this->output($raw);
    }



    protected function count_custom($count  = 'count_all'){

        //Get columns to temp var.
        if($this->query_type == 'eloquent') {
            $query = $this->query->getQuery();
            $connection = $this->query->getModel()->getConnection()->getName();
        }
        else {
            $query = $this->query;
            $connection = $query->getConnection()->getName();
        }

        // if its a normal query ( no union ) replace the slect with static text to improve performance
        $myQuery = clone $query;
        if( !preg_match( '/UNION/i', $myQuery->toSql() ) ){
            $myQuery->select( DB::raw("sql_calc_found_rows *") );

            // if query has "having" clause add select columns
            if ($myQuery->havings) {
                foreach($myQuery->havings as $having) {
                    if (isset($having['column'])) {
                        $myQuery->addSelect($having['column']);
                    } else {
                        // search filter_columns for query string to get column name from an array key
                        $found = false;
                        foreach($this->filter_columns as $column => $val) {
                            if ($val['parameters'][0] == $having['sql'])
                            {
                                $found = $column;
                                break;
                            }
                        }
                        // then correct it if it's an alias and add to columns
                        if ($found!==false) {
                            foreach($this->columns as $val) {
                                $arr = explode(' as ',$val);
                                if (isset($arr[1]) && $arr[1]==$found)
                                {
                                    $found = $arr[0];
                                    break;
                                }
                            }
                            $myQuery->addSelect($found);
                        }
                    }
                }
            }
        }
        $calc_rows =  $myQuery->take(1)->get();
        $results = DB::connection($connection)->select('SELECT FOUND_ROWS() as count limit 1');
        $total= $results[0]->count;
        $this->$count = $total;
    }

    /**
     * Datatable filtering
     *
     * @return null
     */
    protected function custom_filtering()
    {
        
        // copy of $this->columns without columns removed by remove_column
        $columns_copy = $this->columns;
        for ($i=0,$c=count($columns_copy);$i<$c;$i++)
        {
            if(in_array($this->getColumnName($columns_copy[$i]), $this->excess_columns))
            {
                unset($columns_copy[$i]);
            }
        }
        $columns_copy = array_values($columns_copy);

        // copy of $this->columns cleaned for database queries
        $columns_clean = $this->clean_columns( $columns_copy, false );
        $columns_copy = $this->clean_columns( $columns_copy, true );

        // global search
        if ($this->input['search']['value'] != '')
        {
            $_this = $this;

            $this->query->where(function($query) use (&$_this, $columns_copy, $columns_clean) {
                
                $db_prefix = $_this->database_prefix();
 
               for ($i=0,$c=count($_this->input['columns']);$i<$c;$i++)
                {
                    if (isset($columns_copy[$i]) && $_this->input['columns'][$i]['searchable'] == "true")
                    {
                        // if filter column exists for this columns then use user defined method
                        if (isset($_this->filter_columns[$columns_copy[$i]]))
                        {
                            // check if "or" equivalent exists for given function
                            // and if the number of parameters given is not excess 
                            // than call the "or" equivalent
                            
                            $method_name = 'or' . ucfirst($_this->filter_columns[$columns_copy[$i]]['method']);
                            
                            if ( method_exists($query->getQuery(), $method_name) && count($_this->filter_columns[$columns_copy[$i]]['parameters']) <= with(new \ReflectionMethod($query->getQuery(),$method_name))->getNumberOfParameters() )
                            {
                                call_user_func_array(
                                    array(
                                        $query,
                                        $method_name
                                    ),
                                    $_this->inject_variable(
                                        $_this->filter_columns[$columns_copy[$i]]['parameters'],
                                        $_this->input['search']['value']
                                    )
                                );
                            }
                        } else
                        // otherwise do simple LIKE search                    
                        {
                        
                            $keyword = '%'.$_this->input['search']['value'].'%';
                        
                            if(Config::get('datatables::search.use_wildcards', false)) {
                                $keyword = $_this->wildcard_like_string($_this->input['search']['value']);
                            }
                        
                            // Check if the database driver is PostgreSQL
                            // If it is, cast the current column to TEXT datatype
                            $cast_begin = null;
                            $cast_end = null;
                            if( DB::getDriverName() === 'pgsql') {
                                $cast_begin = "CAST(";
                                $cast_end = " as TEXT)";
                            }
                        
                            $column = $db_prefix . $columns_clean[$i];
                        
                            if(Config::get('datatables::search.case_insensitive', false)) {
                                $query->orwhere(DB::raw('LOWER('.$cast_begin.$column.$cast_end.')'), 'LIKE', strtolower($keyword));
                            } else {
                                $query->orwhere(DB::raw($cast_begin.$column.$cast_end), 'LIKE', $keyword);
                            }
                        }
                    }
                }
            });

        }

        $db_prefix = $this->database_prefix();
        
        // column search
        for ($i=0,$c=count($this->input['columns']);$i<$c;$i++)
        {
            if (isset($columns_copy[$i]) && $this->input['columns'][$i]['orderable'] == "true" && $this->input['columns'][$i]['search']['value'] != '')
            {
                // if filter column exists for this columns then use user defined method
                if (isset($this->filter_columns[$columns_copy[$i]]))
                {
                    call_user_func_array(
                        array(
                            $this->query,
                            $this->filter_columns[$columns_copy[$i]]['method']
                        ),
                            $this->inject_variable(
                            $this->filter_columns[$columns_copy[$i]]['parameters'],
                            $this->input['columns'][$i]['search']['value']
                        )
                    );
                    
                }
            }
        }
    }

}