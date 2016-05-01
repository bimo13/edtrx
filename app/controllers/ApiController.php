<?php

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Input;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ApiController extends BaseController {

    public function login() {

        $response = array();

        try {
            $credentials = array(
                'email'    => Input::get('email'),
                'password' => Input::get('password'),
            );

            $user = Sentry::authenticate($credentials, false);
            $response['status'] = 1;
            $response['message'] = "You are now logged in.";
        } catch (Cartalyst\Sentry\Users\LoginRequiredException $e) {
            $response['status'] = 0;
            $response['message'] = "Email field is required.";
        } catch (Cartalyst\Sentry\Users\PasswordRequiredException $e) {
            $response['status'] = 0;
            $response['message'] = "Password field is required.";
        } catch (Cartalyst\Sentry\Users\WrongPasswordException $e) {
            $response['status'] = 0;
            $response['message'] = "Password incorrect, try again.";
        } catch (Cartalyst\Sentry\Users\UserNotFoundException $e) {
            $response['status'] = 0;
            $response['message'] = "User not found.";
        } catch (Cartalyst\Sentry\Users\UserNotActivatedException $e) {
            $response['status'] = 0;
            $response['message'] = "User not activated.";
        }

        return json_encode($response);

    }

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

    public function getAlbum($parent_id = NULL) {

        try {

            $parent = StudentParent::findOrFail($parent_id);
            $teacher_id = $parent->Students[0]->Classes->teacher_id;
            $albums = Album::where('teacher_id', '=', $teacher_id)->get();
            $returnData = array();

            foreach ($albums as $album) {
                $publicity = explode(',',$album->publicity);
                if ($publicity[0] == "public" || in_array($parent_id, $publicity)) {
                    array_push($returnData, $album);
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
            $response = JsonResponse::create(array('message' => 'An error occured while parsing album data, please try again.', 'status' => 0), 200, array(), JSON_PRETTY_PRINT);
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

    public function getPinboard($parent_id = NULL) {
        try {
            $parent = StudentParent::findOrFail($parent_id);
            $teacher_id = $parent->Students[0]->Classes->teacher_id;
            $pinboard = Pinboard::where('teacher_id', '=', $teacher_id)
                                ->orderBy('created_at', 'desc')
                                ->get();

            $data = array(
                'data' => $pinboard,
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

    public function getPinboardDetail($id = NULL) {
        try {
            $pinboard = Pinboard::findOrFail($id);

            $data = array(
                'data' => $pinboard,
                'message' => 'Data successfully retrieved.',
                'status' => 1
            );

            $response = JsonResponse::create($data, 200, array(), JSON_PRETTY_PRINT);
            $response->header('Content-Type', 'application/json');
            return $response;
        } catch (ModelNotFoundException $e) {
            $response = JsonResponse::create(array('message' => 'An error occured while parsing data, please try again.', 'status' => 0), 200, array(), JSON_PRETTY_PRINT);
            $response->header('Content-Type', 'application/json');
            return $response;
        }
    }

    public function getToDoDates($parent_id = NULL) {
        try {
            $parent = StudentParent::findOrFail($parent_id);
            $teacher_id = $parent->Students[0]->Classes->teacher_id;
            $tododates = ToDo::select('date')
                                ->where('teacher_id', '=', $teacher_id)
                                ->groupBy('date')
                                ->orderBy('date', 'desc')
                                ->get();

            $data = array(
                'data' => $tododates,
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

    public function getToDo($parent_id = NULL, $date = NULL) {
        try {
            $parent = StudentParent::findOrFail($parent_id);
            $teacher_id = $parent->Students[0]->Classes->teacher_id;
            $todo = ToDo::where('teacher_id', '=', $teacher_id)
                                ->where('date', '=', $date)
                                ->orderBy('name')
                                ->get();

            $data = array(
                'data' => $todo,
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

    public function getToDoDetail($id = NULL) {
        try {
            $todo = ToDo::findOrFail($id);

            $data = array(
                'data' => $todo,
                'message' => 'Data successfully retrieved.',
                'status' => 1
            );

            $response = JsonResponse::create($data, 200, array(), JSON_PRETTY_PRINT);
            $response->header('Content-Type', 'application/json');
            return $response;
        } catch (ModelNotFoundException $e) {
            $response = JsonResponse::create(array('message' => 'An error occured while parsing data, please try again.', 'status' => 0), 200, array(), JSON_PRETTY_PRINT);
            $response->header('Content-Type', 'application/json');
            return $response;
        }
    }

}