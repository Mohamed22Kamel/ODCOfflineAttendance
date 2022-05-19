<?php

namespace App\Http\Controllers;

use App\Models\StudentAttendance;
use App\Models\StudentCourse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class StudentCourseController extends Controller
{
    public function index()
    {
        $StudentCourses = StudentCourse::all();
        if (empty($StudentCourses))
            return ResponseController::sendResponse($StudentCourses, 'No StudentCourses.');
        return ResponseController::sendResponse($StudentCourses, 'StudentCourses Getted successfully.');
    }

    public function store(Request $request)
    {
        $Constrains = ['student_id' => 'required|integer|exists:students,id', 'course_id' => 'required|integer|exists:courses,id',];

        $input = $request->all();
        $validator = Validator::make($input, $Constrains);
        if ($validator->fails()) {
            return ResponseController::sendError('Validation Error.', $validator->errors());
        }
        $Student_ID = $input['student_id'];
        $Course_ID = $input['course_id'];
        $StudentEnrolledCourses = StudentCourse::where('student_id', $Student_ID)->get();
        foreach ($StudentEnrolledCourses as $EnrolledCourse) {
            if ($EnrolledCourse['course_id'] == $input['course_id'])
                return ResponseController::sendError('Already Registered.', "You Can't Register");
        }
        $StudentCourses = StudentCourse::create($input);
        $StudentCourseID = $StudentCourses->id;

        MailController::SendEmailWithIDs($Student_ID, $StudentCourseID, $Course_ID);

        return ResponseController::sendResponse($StudentCourses, 'StudentCourse created successfully.');
    }

    public function show($id)
    {
        $StudentCourses = StudentCourse::find($id);

        if (is_null($StudentCourses)) {
            return ResponseController::sendError('StudentCourse not found.');
        }
        return ResponseController::sendResponse($StudentCourses, 'StudentCourse retrieved successfully.');
    }

    public function update(Request $request, $id)
    {
        $Constrains = ['student_id' => 'integer|exists:students,id', 'course_id' => 'integer|exists:courses,id',];

        $input = $request->all();

        $validator = Validator::make($input, $Constrains);

        if ($validator->fails()) {
            return ResponseController::sendError('Validation Error.', $validator->errors()->first('name'));
        }
        $StudentCourses = StudentCourse::find($id);
        if (is_null($StudentCourses)) {
            return ResponseController::sendError('StudentCourse not found.');
        }

        $StudentCourses->student_id = !array_key_exists('student_id', $input) ? $StudentCourses->student_id : $input['student_id'];
        $StudentCourses->course_id = !array_key_exists('course_id', $input) ? $StudentCourses->course_id : $input['course_id'];
        $StudentCourses->save();

        return ResponseController::sendResponse($StudentCourses, 'StudentCourse updated successfully.');
    }

    public function destroy($id)
    {


        $StudentCourses = StudentCourse::find($id);
        if (is_null($StudentCourses)) {
            return ResponseController::sendError('StudentCourse not found.');
        }
        if (count(StudentAttendance::where('student_course_id', $id)->get()) == 0) {
            $StudentCourses->delete();
            return ResponseController::sendResponse($StudentCourses, 'StudentCourse deleted successfully.');
        } else {
            return ResponseController::sendError('Restricted Delete', 'Cant be deleted cause the student attended', 409);
        }


    }
}
