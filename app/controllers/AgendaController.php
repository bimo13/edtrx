<?php

class AgendaController extends BaseController {

    public function rulesList() {
        return $rules = array(
            'teacher_id'  => 'required|integer',
            'date'        => 'required|date',
            'time_start'  => 'required|date_format:H:i',
            'time_end'    => 'required|date_format:H:i',
            'description' => 'required'
        );
    }

    public function messagesList() {
        return $messages = array(
            'teacher_id.required' => 'An error occured while saving user-data, please try again after re-logging in.',
            'teacher_id.integer' => 'An error occured while saving user-data, please try again after re-logging in.',
            'time_start.date_format' => 'The time format for :attribute is invalid.',
            'time_end.date_format' => 'The time format for :attribute is invalid.'
        );
    }

    public function index() {
        $user = Sentry::getUser();
        return View::make('agenda', compact('user'));
    }

    public function create() {
        $user = Sentry::getUser();
        $blankArray = array('' => '');
        $buttonText = "Create Agenda";
        return View::make('agenda-form', compact('user', 'blankArray', 'buttonText'));
    }

    public function store() {
        return Agenda::saveNewAgenda(array('input' => Input::all(), 'rules' => $this->rulesList(), 'messages' => $this->messagesList()));
    }

    public function show($id) {
        //
    }

    public function edit($id) {
        try {
            $model = Agenda::select(
                'id',
                'date',
                DB::raw('DATE_FORMAT(time_start, \'%H:%i\') as time_start'),
                DB::raw('DATE_FORMAT(time_end, \'%H:%i\') as time_end'),
                'description'
            )->where('id', '=', $id)->first();
            $user = Sentry::getUser();
            $buttonText = "Update Agenda";
            return View::make('agenda-form', compact('user', 'model', 'buttonText'));
        } catch (ModelNotFoundException $e) {
            return $this->redirectNotFound();
        }
    }

    public function update($id) {
        return Agenda::updateAgenda(array('input' => Input::all(), 'rules' => $this->rulesList(), 'messages' => $this->messagesList()));
    }

    public function destroy($id) {
        return Agenda::deleteAgenda(array('id' => $id));
    }

    // END OF RESTful ROUTING
    // BEGIN DATA-TRANSACTION ROUTING (AJAX NECESSITIES)
    public function getAgendaData($teacher_id,$date) {
        $agenda = Agenda::getAgendaData(array('teacher_id' => $teacher_id, 'date' => $date));
        $response = array();

        if ($agenda->count() > 0) {
            $response['status'] = 1;
            $response['message'] = "Data retrieved successfully.";
            $response['data'] = $agenda;
        } else {
            $response['status'] = 0;
            $response['message'] = "No agenda for this date.";
        }

        return $response;
    }

/*
|--------------------------------------------------------------------------
| New Layout
|--------------------------------------------------------------------------
|
*/

    public function newLayout() {
        return View::make('new-agenda');
    }

    public function newFormLayout() {
        return View::make('new-agenda-form');
    }

}
