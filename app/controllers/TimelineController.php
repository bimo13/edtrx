<?php

use Trim\TrimCustom as Trim;
use DataTables\DataTablesCustom as DatatablesCustom;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class TimelineController extends BaseController {

    public function index() {
        $user = Sentry::getUser();
        $timelineDates = Timeline::select(DB::raw('DATE(created_at) as day'))->groupBy('day')->get();
        return View::make('timeline', compact('user', 'timelineDates'));
    }

}