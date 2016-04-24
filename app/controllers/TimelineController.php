<?php

use DataTables\DataTablesCustom as DatatablesCustom;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class TimelineController extends BaseController {

    public function index() {
        $timeline = Timeline::get();
        return View::make('timeline', compact('timeline'));
    }

}