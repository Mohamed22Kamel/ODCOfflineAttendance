<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\StudentCourse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CourseController extends Controller
{
    public function index()
    {
        $Courses = Course::all();
        if (empty($Courses))
            return ResponseController::sendResponse($Courses, 'No Courses.');
        return ResponseController::sendResponse($Courses, 'Courses Getted successfully.');
    }

    public function store(Request $request)
    {
        $Constrains = ['name' => 'required|regex:/^[a-zA-Z0-9 _-]*$/|unique:courses,name', 'description' => 'required|regex:/^[a-zA-Z0-9 _-]*$/', 'category_id' => 'required|integer|exists:categories,id', 'start' => 'required|date_format:Y-m-d|after:yesterday', 'end' => 'required|date_format:Y-m-d|after_or_equal:start'];

        $input = $request->all();
        $validator = Validator::make($input, $Constrains);
        if ($validator->fails()) {
            return ResponseController::sendError('Validation Error.', $validator->errors());
        }

        $Courses = Course::create($input);

        return ResponseController::sendResponse($Courses, 'Course created successfully.');
    }

    public function show($id)
    {
        $Courses = Course::find($id);

        if (is_null($Courses)) {
            return ResponseController::sendError('Course not found.');
        }
        return ResponseController::sendResponse($Courses, 'Course retrieved successfully.');
    }

    public function update(Request $request, $id)
    {
        $Constrains = ['name' => 'regex:/^([^!\*<>.\/@]*)$/', 'description' => 'regex:/^([^!\*<>.\/@]*)$/', 'category_id' => 'integer|exists:categories,id', 'start' => 'date_format:Y-m-d', 'end' => 'date_format:Y-m-d'];

        $input = $request->all();

        $validator = Validator::make($input, $Constrains);

        if ($validator->fails()) {
            return ResponseController::sendError('Validation Error.', $validator->errors()->first('name'));
        }
        $Courses = Course::find($id);
        if (is_null($Courses)) {
            return ResponseController::sendError('Course not found.');
        }

        $Courses->name = !array_key_exists('name', $input) ? $Courses->name : $input['name'];
        $Courses->description = !array_key_exists('description', $input) ? $Courses->description : $input['description'];
        $Courses->category_id = !array_key_exists('category_id', $input) ? $Courses->category_id : $input['category_id'];
        $Courses->start = !array_key_exists('start', $input) ? $Courses->start : $input['start'];
        $Courses->end = !array_key_exists('end', $input) ? $Courses->end : $input['end'];
        $Courses->save();

        return ResponseController::sendResponse($Courses, 'Course updated successfully.');
    }

    public function destroy($id)
    {
        $Courses = Course::find($id);
        if (is_null($Courses)) {
            return ResponseController::sendError('Course not found.');
        }

        if (count(StudentCourse::where('course_id', $id)->get()) == 0) {
            $Courses->delete();
            return ResponseController::sendResponse($Courses, 'Course deleted successfully.');
        } else {
            return ResponseController::sendError('Restricted Delete', 'Cant be deleted cause there where student enrolled this course', 409);
        }


    }

    public static function getName($id)
    {
        $Course = Course::find($id);

        if (is_null($Course)) {
            return ResponseController::sendError('Course not found.');
        }
        return $Course->name;
    }

    public static function getStart($id)
    {
        $Course = Course::find($id);

        if (is_null($Course)) {
            return ResponseController::sendError('Course not found.');
        }
        return $Course->start;
    }

    public static function getEnd($id)
    {
        $Course = Course::find($id);

        if (is_null($Course)) {
            return ResponseController::sendError('Course not found.');
        }
        return $Course->end;
    }
}
