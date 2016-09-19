<?php

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Input;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ApiController extends BaseController {

    public function login() {

        $response = array();
        $input['email'] = Input::get('email');
        $input['password'] = sha1(Input::get('password'));

        $rules = array(
            'email'    => 'required|email',
            'password' => 'required'
        );

        $validating = Validator::make($input, $rules);
        if ($validating->fails()) {
            $data = array(
                'message' => $validating->messages(),
                'status' => 0
            );

            $response = JsonResponse::create($data, 200, array(), JSON_PRETTY_PRINT);
            $response->header('Content-Type', 'application/json');
            return $response;
        }

        try {
            $parent = StudentParent::where('email', '=', $input['email'])->where('password', '=', $input['password']);
            if ($parent->count() != 1) {
                $response['status'] = 0;
                $response['message'] = "Username or password is incorrect, please try again.";
            } else {
                $parent = $parent->first();
                $data = array(
                    'id' => $parent->id,
                    'first_name' => $parent->first_name,
                    'last_name' => $parent->last_name,
                    'address' => $parent->address,
                    'phone_1' => $parent->phone_1,
                    'phone_2' => $parent->phone_2,
                    'photo' => $parent->photo,
                    'email' => $parent->email
                );
                $response['data'] = $data;
                $response['status'] = 1;
                $response['message'] = "You are now logged in.";

                $parent->session = 1;
                $parent->update();

            }
        } catch (Cartalyst\Sentry\Users\LoginRequiredException $e) {
            $response['status'] = 0;
            $response['message'] = "Email field is required.";
        }

        $response = JsonResponse::create($response, 200, array(), JSON_PRETTY_PRINT);
        $response->header('Content-Type', 'application/json');
        return $response;

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
                    if ($timeline->category == "todo") {
                        $getPosts = ToDo::findOrFail($timeline->post_id);
                        $countPosts = ToDo::where('id', '=', $timeline->post_id)->count();
                    } else if ($timeline->category == "agenda") {
                        $getPosts = Agenda::findOrFail($timeline->post_id);
                        $countPosts = Agenda::where('id', '=', $timeline->post_id)->count();
                    } else if ($timeline->category == "pinboard") {
                        $getPosts = Pinboard::findOrFail($timeline->post_id);
                        $countPosts = Pinboard::where('id', '=', $timeline->post_id)->count();
                    } else if ($timeline->category == "gallery") {
                        $getPosts = Album::findOrFail($timeline->post_id);
                        $countPosts = Album::where('id', '=', $timeline->post_id)->count();
                    }

                    if ($countPosts == 1) {
                        if ($timeline->category == "gallery") {
                            $getGallery = Gallery::where('album_id', '=', $timeline->post_id)->get();
                            $getPosts['galleries'] = $getGallery;
                        }

                        $teacherData = Sentry::findUserById($teacher_id);
                        $teacherDetail = UserDetail::where('user_id', '=', $teacher_id)->first();

                        $timeline['postData'] = $getPosts;
                        $timeline['teacherData'] = array(
                            'teacher_id' => $teacher_id,
                            'first_name' => $teacherData->first_name,
                            'last_name' => $teacherData->last_name,
                            'photo' => $teacherDetail->photo
                        );
                        array_push($returnData, $timeline);
                    }
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

    public function getAgenda($parent_id = NULL, $year = NULL, $month = NULL) {
        try {
            $parent = StudentParent::findOrFail($parent_id);
            $teacher_id = $parent->Students[0]->Classes->teacher_id;
            $agenda = Agenda::where('teacher_id', '=', $teacher_id)
                                ->whereYear('date', '=', $year)
                                ->whereMonth('date', '=', $month)
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

    public function getToDo($parent_id = NULL) {
        try {
            $parent = StudentParent::findOrFail($parent_id);
            $teacher_id = $parent->Students[0]->Classes->teacher_id;
            $todo = ToDo::where('teacher_id', '=', $teacher_id)
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

    public function parentRegistration() {

        $response = array();

        $response = array();
        $input = Input::all();
        $rules = array(
            'first_name'  => 'required|max:255',
            'last_name'   => 'required|max:255',
            'address'     => 'required|max:255',
            'phone_1'     => 'required|max:255',
            'email'       => 'required|email|max:255',
            'password'    => 'required|min:8|max:255'
        );

        $imgRule = array('photo' => 'required|image|mimes:png,gif,jpg,jpeg,bmp|max:20000');
        $rules = $rules + $imgRule;

        $image = Input::file('photo');
        $rawPath = 'assets/uploads/parents/';
        $uplPath = public_path($rawPath);
        
        $validating = Validator::make($input, $rules);
        if ($validating->fails()) {
            $response['status'] = 0;
            $response['message'] = $validating->messages();
            return $response;
        }

        // Prevent "directory not exists" error
        if(!\File::exists($uplPath))
            \File::makeDirectory($uplPath, $mode=0755, $recursive=false);

        // Handle image upload with image-intervention.io
        $uniqid = uniqid();
        $imagePath = $uplPath.$uniqid.'-'.$image->getClientOriginalName();
        $thumbPath = $uplPath.'thumb-'.$uniqid.'-'.$image->getClientOriginalName();
        Image::make($image)->save($imagePath);
        Image::make($image)->resize(200, 200)->save($thumbPath);
        $imagePath = $rawPath.$uniqid.'-'.$image->getClientOriginalName();

        $usnm = Input::get('email');
        $pswd = Input::get('password');
        $full_name = Input::get('first_name') . " " . Input::get('last_name');

        // Handle inputs and process to database
        $StudentParent = new StudentParent;
        $StudentParent->first_name = Input::get('first_name');
        $StudentParent->last_name = Input::get('last_name');
        $StudentParent->address = Input::get('address');
        $StudentParent->phone_1 = Input::get('phone_1');
        $StudentParent->phone_2 = Input::get('phone_2');
        $StudentParent->photo = $imagePath;
        $StudentParent->email = $usnm;
        $StudentParent->password = Hash::make($pswd);

        if($StudentParent->save()) {
            $response['status'] = 1;
            $response['message'] = "Data saved successfully.";
            $response['mail'] = $usnm;
            $response['pswd'] = $pswd;
            $response['tags'] = "Parent";
            $response['website'] = $imagePath;
        } else {
            $response['status'] = 0;
            $response['message'] = "An error occured, cannot save to database. Please try again.";
        }

        return $response;

    }

}