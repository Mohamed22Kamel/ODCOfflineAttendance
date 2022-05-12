<?php

namespace App\Http\Controllers;

use App\Models\Instructor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class InstructorController extends Controller
{
    public function index()
    {
        $Instructors = Instructor::all();
        if (empty($Instructors))
            return ResponseController::sendResponse($Instructors, 'No Instructors.');
        return ResponseController::sendResponse($Instructors, 'Instructors Getted successfully.');
    }

    public function store(Request $request)
    {
        $Constrains = ['name' => 'required|regex:/^[a-zA-Z]{4,}(?: [a-zA-Z]+){0,2}$/', 'email' => 'required|email|unique:Instructors,email', 'image' => 'nullable|regex:/^([^!*<>]*)$/', 'phone' => 'required|regex:/(01)[0-9]{9}/'];

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

        $Instructors = Instructor::create($input);

        return ResponseController::sendResponse($Instructors, 'Instructor created successfully.');
    }

    public function show($id)
    {
        $Instructors = Instructor::find($id);

        if (is_null($Instructors)) {
            return ResponseController::sendError('Instructor not found.');
        }
        return ResponseController::sendResponse($Instructors, 'Instructor retrieved successfully.');
    }

    public function update(Request $request, $id)
    {
        $Constrains = ['name' => 'regex:/^[a-zA-Z]{4,}(?: [a-zA-Z]+){0,2}$/', 'email' => 'email|unique:Instructors,email', 'image' => 'nullable|regex:/^([^!*<>]*)$/', 'phone' => 'regex:/(01)[0-9]{9}/'];

        $input = $request->all();

        $validator = Validator::make($input, $Constrains);

        if ($validator->fails()) {
            return ResponseController::sendError('Validation Error.', $validator->errors()->first('name'));
        }
        $Instructors = Instructor::find($id);
        if (is_null($Instructors)) {
            return ResponseController::sendError('Instructor not found.');
        }

        $Instructors->name = !array_key_exists('name', $input) ? $Instructors->name : $input['name'];
        $Instructors->email = !array_key_exists('email', $input) ? $Instructors->email : $input['email'];
        $Instructors->image = !array_key_exists('image', $input) ? $Instructors->image : $input['image'];
        $Instructors->phone = !array_key_exists('phone', $input) ? $Instructors->phone : $input['phone'];
        $Instructors->save();

        return ResponseController::sendResponse($Instructors, 'Instructor updated successfully.');
    }

    public function destroy($id)
    {

        $Instructors = Instructor::find($id);
        if (is_null($Instructors)) {
            return ResponseController::sendError('Instructor not found.');
        }
        $Instructors->delete();
        return ResponseController::sendResponse($Instructors, 'Instructor deleted successfully.');

//        if (count(Teach::where('instructor_id', $id)->get()) == 0) {
//            $Instructors->delete();
//            return ResponseController::sendResponse($Instructors, 'Instructor deleted successfully.');
//        } else {
//            return ResponseController::sendError('Restricted Delete', 'Cant be deleted cause there where Instructor enrolled this Instructor', 409);
//        }


    }
}
