<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\StudentCourse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class StudentController extends Controller
{
    public function index()
    {
        $Students = Student::all();
        if (empty($Students))
            return ResponseController::sendResponse($Students, 'No Students.');
        return ResponseController::sendResponse($Students, 'Students Getted successfully.');
    }

    public function store(Request $request)
    {
        $Constrains = ['name' => 'required|regex:/^[a-zA-Z]{4,}(?: [a-zA-Z]+){0,2}$/', 'email' => 'required|email|unique:students,email', 'image' => 'nullable|regex:/^([^!*<>]*)$/', 'phone' => 'required|regex:/(01)[0-9]{9}/'];

        $input = $request->all();
        $validator = Validator::make($input, $Constrains);
        foreach ($input as &$value) {
            if (empty($value)) {
                $value = null;
            }
        }
        if ($validator->fails()) {
            return ResponseController::sendError('Validation Error.', $validator->errors());
        }

        $Students = Student::create($input);

        return ResponseController::sendResponse($Students, 'Student created successfully.');

    }

    public function show($id)
    {
        $Students = Student::find($id);

        if (is_null($Students)) {
            return ResponseController::sendError('Student not found.');
        }
        return ResponseController::sendResponse($Students, 'Student retrieved successfully.');
    }

    public function update(Request $request, $id)
    {
        $Constrains = ['name' => 'regex:/^[a-zA-Z]{4,}(?: [a-zA-Z]+){0,2}$/', 'email' => 'email|unique:Instructors,email', 'image' => 'nullable|regex:/^([^!*<>]*)$/', 'phone' => 'regex:/(01)[0-9]{9}/'];

        $input = $request->all();

        $validator = Validator::make($input, $Constrains);

        if ($validator->fails()) {
            return ResponseController::sendError('Validation Error.', $validator->errors()->first('name'));
        }
        $Students = Student::find($id);
        if (is_null($Students)) {
            return ResponseController::sendError('Student not found.');
        }

        $Students->name = !array_key_exists('name', $input) ? $Students->name : $input['name'];
        $Students->email = !array_key_exists('email', $input) ? $Students->email : $input['email'];
        $Students->image = !array_key_exists('image', $input) ? $Students->image : $input['image'];
        $Students->phone = !array_key_exists('phone', $input) ? $Students->phone : $input['phone'];
        $Students->save();

        return ResponseController::sendResponse($Students, 'Student updated successfully.');
    }

    public function destroy($id)
    {

        $Students = Student::find($id);
        if (is_null($Students)) {
            return ResponseController::sendError('Student not found.');
        }

        if (count(StudentCourse::where('Student_id', $id)->get()) == 0) {
            $Students->delete();
            return ResponseController::sendResponse($Students, 'Student deleted successfully.');
        } else {
            return ResponseController::sendError('Restricted Delete', 'Cant be deleted cause there where course enrolled by this student this Student', 409);
        }


    }

    public static function getName($id)
    {
        $Student = Student::find($id);

        if (is_null($Student)) {
            return ResponseController::sendError('Student not found.');
        }
        return $Student->name;
    }

    public static function getEmail($id)
    {
        $Student = Student::find($id);

        if (is_null($Student)) {
            return ResponseController::sendError('Student not found.');
        }
        return $Student->email;
    }
}
