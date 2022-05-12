<?php

namespace App\Http\Controllers;

use App\Models\StudentAttendance;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class StudentAttendanceController extends Controller
{
    public function index()
    {
        $StudentAttendance = StudentAttendance::all();
        if (empty($StudentAttendance))
            return ResponseController::sendResponse($StudentAttendance, 'No StudentAttendances.');
        return ResponseController::sendResponse($StudentAttendance, 'StudentAttendances Getted successfully.');
    }

    public function store(Request $request)
    {
        $CurrentTime = Carbon::now()->floorDay();

        $Constrains = ['student_course_id' => 'required|integer|exists:student_courses,id'];

        $input = $request->all();

        $validator = Validator::make($input, $Constrains);
        if ($validator->fails()) {
            return ResponseController::sendError('Validation Error.', $validator->errors());
        }

        $Student_Course_ID = $input['student_course_id'];

        $Attends = StudentAttendance::where('student_course_id', $Student_Course_ID)->get();

        foreach ($Attends as $attend) {
            $date = Carbon::create($attend['created_at'])->floorDay();
            if ($attend['student_course_id'] == $input['student_course_id'] && $date->eq($CurrentTime))
                return ResponseController::sendError('Already Attended.', "You Can't ِAttend Again");
        }

        $StudentAttendance = StudentAttendance::create($input);

        return ResponseController::sendResponse($StudentAttendance, 'StudentAttendance created successfully.');
    }

    public function show($id)
    {
        $StudentAttendance = StudentAttendance::find($id);

        if (is_null($StudentAttendance)) {
            return ResponseController::sendError('StudentAttendance not found.');
        }
        return ResponseController::sendResponse($StudentAttendance, 'StudentAttendance retrieved successfully.');
    }


    public function destroy($id)
    {


        $StudentAttendance = StudentAttendance::find($id);
        if (is_null($StudentAttendance)) {
            return ResponseController::sendError('StudentAttendance not found.');
        }
        $StudentAttendance->delete();
        return ResponseController::sendResponse($StudentAttendance, 'StudentAttendance deleted successfully.');
    }
}
