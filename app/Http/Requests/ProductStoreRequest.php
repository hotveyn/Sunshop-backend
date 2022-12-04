<?php

namespace App\Http\Requests;

use App\Models\Category;
use App\Models\Image;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProductStoreRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            "title"=>["required","string"],
            "category_id" => ["required","integer","nullable", Rule::exists(Category::class, "id")],
            "image_id"=>["required", "integer", Rule::exists(Image::class, "id")],
            "to_price"=>["required", "numeric"],
            "cost_price"=>["required", "numeric"],
            "unit"=>["required","string"],
            "stock"=>["required","integer"],
            "hot"=>["required","boolean"],
            "describe"=>["required","string"]
        ];
    }
}
