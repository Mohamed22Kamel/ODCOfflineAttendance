<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Course;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    public function index(): JsonResponse
    {
        $Categories = Category::all();
        if (empty($Categories)) {
            return ResponseController::sendError('Categories not found.');
        }
        return ResponseController::sendResponse($Categories, 'Categories Gutted successfully.');
    }

    public function store(Request $request): JsonResponse
    {
        $Constrains = ['name' => 'required|regex:/^[a-zA-Z0-9 _-]*$/|unique:categories,name'];
        $input = $request->all();
        $validator = Validator::make($input, $Constrains);
        if ($validator->fails()) {
            return ResponseController::sendError('Validation Error.', $validator->errors()->first('name'));
        }

        $category = Category::create($input);

        return ResponseController::sendResponse($category, 'Category created successfully.');
    }

    public function show($id): JsonResponse
    {
        $category = Category::find($id);

        if (is_null($category)) {
            return ResponseController::sendError('Category not found.');
        }
        return ResponseController::sendResponse($category, 'Category retrieved successfully.');
    }

    public function update(Request $request, $id): JsonResponse
    {
        $Constrains = ['name' => 'unique:categories,name|regex:/^[a-zA-Z0-9 _-]*$/'];
        $input = $request->all();

        $validator = Validator::make($input, $Constrains);

        if ($validator->fails()) {
            return ResponseController::sendError('Validation Error.', $validator->errors()->first('name'));
        }
        $category = Category::find($id);
        if (is_null($category)) {
            return ResponseController::sendError('Category not found.');
        }

        $category->name = !array_key_exists('name', $input) ? $category->name : $input['name'];
        $category->save();

        return ResponseController::sendResponse($category, 'Category updated successfully.');
    }

    public function destroy($id): JsonResponse
    {
        $category = Category::find($id);
        if (is_null($category)) {
            return ResponseController::sendError('Category not found.');
        }
        if (count(Course::where('category_id', $id)->get()) == 0) {
            $category->delete();
            return ResponseController::sendResponse($category, 'Category deleted successfully.');
        } else {
            return ResponseController::sendError('Restricted Delete', 'Cant be deleted cause there where Courses with this Category', 409);
        }


    }

}
