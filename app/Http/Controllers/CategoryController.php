<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryPageRequest;
use App\Http\Requests\CategoryStoreRequest;
use App\Http\Requests\UserPageRequest;
use App\Http\Resources\CategoryPageResource;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\UserResource;
use App\Http\Services\ResponseService;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function create(CategoryStoreRequest $request)
    {
        $category = Category::create($request->validated());

        return ResponseService::success(CategoryResource::make($category));
    }

    public function infoPaged(CategoryPageRequest $request)
    {
        $categories = Category::query()
            ->skip($request->skip)
            ->take($request->take)
            ->get();

        return ResponseService::success([
            "items" => CategoryResource::collection($categories),
            "count" => $categories->count(),
            "skip" => $request->skip
        ], 200);
    }

    public function info()
    {
        $categories = Category::all();
        return ResponseService::success([
            "items" => CategoryResource::collection($categories),
            "count" => $categories->count(),
            "skip" => 0
        ], 200);
    }

    public function delete(Category $id)
    {
        $id->delete();

        return ResponseService::success($id,200);
    }

    public function update(CategoryStoreRequest $request, Category $id)
    {
        $id->fill($request->validated());
        $id->save();

        return ResponseService::success(CategoryResource::make($id), 200);
    }
}
