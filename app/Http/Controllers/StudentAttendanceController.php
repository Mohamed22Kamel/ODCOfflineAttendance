<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\StudentAttendance;
use App\Models\StudentCourse;
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
        $StudentCourse = StudentCourse::where('id', $Student_Course_ID)->first();
        $Course = Course::where('id', $StudentCourse['course_id'])->first();

        $Attends = StudentAttendance::where('student_course_id', $Student_Course_ID)->get();

        if (Carbon::create($Course['start'])->isAfter($CurrentTime)) {
            return ResponseController::sendError('Date Conflict', "Isn't started yet", 406);
        } elseif (Carbon::create($Course['end'])->isBefore($CurrentTime)) {
            return ResponseController::sendError('Date Conflict', "Course is Ended", 406);
        }
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

    public function StudentTimeSheet(Request $request)
    {
        $input = $request->query->all();
        if (array_key_exists('Student_id', $input) && array_key_exists('Course_id', $input)) {
            if ($input['Student_id'] == null || $input['Course_id'] == null) {
                return ResponseController::sendError('Bad Request', 'Missing Data', 400);
            }
        }else{
            return ResponseController::sendError('Bad Request', 'Missing Data', 400);
        }

        $StudentCourse = StudentCourse::where([['Student_id', '=', $input['Student_id']], ['course_id', '=', $input['Course_id']]])->first();
        $Course = Course::where('id', $StudentCourse['course_id'])->first();

        $NumberOfDays = Carbon::create($Course['start'])->diffInDays(Carbon::create($Course['end'])) + 1;
        $StudentAttendance = StudentAttendance::where("student_course_id", $StudentCourse["id"])->get();

        $Sheet = array();
        $start = Carbon::create($Course['start'])->floorDay();
        $c = 0;
        for ($i = 0; $i < $NumberOfDays; $i++) {
            if (count($StudentAttendance) > $c) {
                $attendTime = Carbon::create($StudentAttendance[$c]['created_at'])->floorDay();
                if ($attendTime->eq($start)) {
                    $Sheet[$i] = $StudentAttendance[$c]['created_at'];
                    $c++;
                } else {
                    $Sheet[$i] = false;
                }
                $start->addDay();
            } else {
                $Sheet[$i] = false;
                $start->addDay();
            }
        }
        return ResponseController::sendResponse($Sheet, 'StudentAttendance retrieved successfully.');
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
