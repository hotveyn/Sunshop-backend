<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryStoreRequest;
use App\Http\Requests\ProductStoreRequest;
use App\Http\Resources\ProductResource;
use App\Http\Services\ResponseService;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function create(ProductStoreRequest $request)
    {
        $product = Product::create($request->validated());

        return ResponseService::success(ProductResource::make($product));
    }
}
