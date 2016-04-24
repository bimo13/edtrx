<?php

use Illuminate\Support\Facades\Input;
use Illuminate\Database\Eloquent\Model;

class Agenda extends Model {

    protected $table = 'agenda';

    public function scopeSaveNewAgenda($query,$params) {

        $response = array();
        $input = $params['input'];
        $rules = $params['rules'];
        $message = $params['messages'];
        $mobile = Input::get('mobile');

        $validating = Validator::make($input, $rules, $message);
        if ($validating->fails()) {
            if ($mobile == 'on') {
                header('Content-Type: application/json');
                $response['status'] = 0;
                $response['message'] = $validating->messages();
                echo json_encode($response);
                die();
            } else {
                return Redirect::route('agenda.create')->withInput()->withErrors($validating);
            }
        }

        $this->teacher_id = Input::get('teacher_id');
        $this->date = Input::get('date');
        $this->time_start = Input::get('time_start');
        $this->time_end = Input::get('time_end');
        $this->description = Input::get('description');

        if($this->save()) {
            $timeline = new Timeline;
            if ($timeline->saveNewTimeline(array('user_id' => Input::get('teacher_id'), 'category' => 'agenda', 'post_id' => $this->id, 'publicity' => 'public'))) {
                $response['status'] = 1;
                $response['message'] = "Data saved successfully.";
            } else {
                $response['status'] = 1;
                $response['message'] = "Data saved successfully, yet it failed to be saved into timline.";
            }
        } else {
            $response['status'] = 0;
            $response['message'] = "An error occured, cannot save to database.";
        }

        if ($mobile == 'on') {
            header('Content-Type: application/json');
            echo json_encode($response);
            die();
        } else {
            return Redirect::route('agenda.index');
        }

    }

    public function scopeUpdateAgenda($query,$params) {

        $input = $params['input'];
        $rules = $params['rules'];
        $message = $params['messages'];

        $validating = Validator::make($input, $rules, $message);
        if ($validating->fails()) {
            return Redirect::route('agenda.edit', array(Input::get('id')))->withInput()->withErrors($validating);
        }

        $update = $this->findOrFail(Input::get('id'));
        $update->teacher_id = Input::get('teacher_id');
        $update->date = Input::get('date');
        $update->time_start = Input::get('time_start');
        $update->time_end = Input::get('time_end');
        $update->description = Input::get('description');
        $update->update();

        return Redirect::route('agenda.index');

    }

    public function scopeDeleteAgenda($query,$params) {

        $response = array();
        $response['status'] = 0;
        $response['message'] = "An error occured, please try again.";

        if($this->destroy($params['id'])) {
            Timeline::where('category', '=', 'agenda')->where('post_id', '=', $params['id'])->delete();
            $response['status'] = 1;
            $response['message'] = "Data has been deleted successfully.";
        }

        return Redirect::route('agenda.index');

    }

    public function scopeGetAgendaData($query,$params) {

        // var_dump($params); die();
        $query->where('teacher_id', '=', $params['teacher_id'])
            ->where('date', '=', $params['date'])
            ->orderBy('time_start', 'asc');
        return $query->get();

    }

}