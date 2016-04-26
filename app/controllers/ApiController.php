<?php

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Input;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ApiController extends BaseController {

    public function getTimeline($parent_id = NULL) {

        try {
            $parent = StudentParent::findOrFail($parent_id);
            $teacher_id = $parent->Students[0]->Classes->teacher_id;
            $timelines = Timeline::where('user_id', '=', $teacher_id)->get();
            $returnData = array();

            foreach ($timelines as $timeline) {
                $publicity = explode(',',$timeline->publicity);
                if ($publicity[0] == "public" || in_array($parent_id, $publicity)) {
                    array_push($returnData, $timeline);
                }
            }

            $data = array(
                'data' => $returnData,
                'message' => 'Data successfully retrieved.',
                'status' => 1
            );

            $response = JsonResponse::create($data, 200, array(), JSON_PRETTY_PRINT);
            $response->header('Content-Type', 'application/json');
            return $response;
        } catch (ModelNotFoundException $e) {
            $response = JsonResponse::create(array('message' => 'An error occured while parsing user data, please try again.', 'status' => 0), 200, array(), JSON_PRETTY_PRINT);
            $response->header('Content-Type', 'application/json');
            return $response;
        }

    }

    public function getGalleryAlbum($album_id = NULL) {

        try {

            $album = Album::findOrFail($album_id);
            $galleries = Gallery::where('album_id', '=', $album_id)->get();

            $returnData = array();
            $returnData['album_detail'] = $album;
            $returnData['galleries'] = $galleries;

            $data = array(
                'data' => $returnData,
                'message' => 'Data successfully retrieved.',
                'status' => 1
            );

            $response = JsonResponse::create($data, 200, array(), JSON_PRETTY_PRINT);
            $response->header('Content-Type', 'application/json');
            return $response;

        } catch (ModelNotFoundException $e) {
            $response = JsonResponse::create(array('message' => 'An error occured while parsing album data, please try again.', 'status' => 0), 200, array(), JSON_PRETTY_PRINT);
            $response->header('Content-Type', 'application/json');
            return $response;
        }

    }

    public function getAgenda($parent_id = NULL, $date = NULL) {

        try {
            $parent = StudentParent::findOrFail($parent_id);
            $teacher_id = $parent->Students[0]->Classes->teacher_id;
            $agenda = Agenda::where('teacher_id', '=', $teacher_id)
                                ->where('date', '=', $date)
                                ->orderBy('time_start', 'asc')
                                ->get();

            $data = array(
                'data' => $agenda,
                'message' => 'Data successfully retrieved.',
                'status' => 1
            );

            $response = JsonResponse::create($data, 200, array(), JSON_PRETTY_PRINT);
            $response->header('Content-Type', 'application/json');
            return $response;
        } catch (ModelNotFoundException $e) {
            $response = JsonResponse::create(array('message' => 'An error occured while parsing user data, please try again.', 'status' => 0), 200, array(), JSON_PRETTY_PRINT);
            $response->header('Content-Type', 'application/json');
            return $response;
        }

    }

}