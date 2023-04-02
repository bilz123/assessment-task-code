<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductUpdateRequest extends FormRequest
{
    private $maxSize;

    public function __construct()
    {
        $this->maxSize = env('PRODUCT_MAX_IMAGE_SIZE', 5);
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->user()->can('product.update');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'main_image' => 'file|mimes:jpg,png,gif|max:' . $this->maxSize * 1024, // 1024 KB = 1 MB
            'product_name' => 'required|string|max:50',
            'price' => 'required|min:1',
            'sale_price' => 'required_with:on_sale|lt:price',
            'on_sale' => 'nullable',
            'stock' => 'required|gte:-1',
            'categories.0' => 'required',
            'categories.*' => 'exists:categories,uuid,user_id,' . auth()->user()->id,
            'allergens.*' => 'exists:allergens,uuid,vendor_id,' . auth()->user()->id,
            'is_active' => 'nullable',
            'description' => 'required',
            'gallery_images.*' => 'nullable|file|mimes:jpg,png,gif|max:' . $this->maxSize * 1024, // 1024 KB = 1 MB
        ];
    }

    public function messages()
    {
        return [
            
            'product_name.string' => 'Product name field must be a string.',
            'product_name.max' => 'Product name cannot be more then 50 characters.',
            'categories.0.required' => 'At least one category is required.',
            'categories.*.exists' => 'One or more selected categories are invalid.',
            'allergens.*.exists' => 'One or more selected allergens are invalid.',
            'main_image.file' => 'Main image must be a file.',
            'main_image.mimes' => 'Main image must be an image of type: jpg, png or gif.',
            'main_image.max' => 'Main image must be less then ' . $this->maxSize . ' MB.',
            'gallery_images.*.file' => 'Each gallery image must be a file.',
            'gallery_images.*.mimes' => 'Each gallery image must be an image of type: jpg, png or gif.',
            'gallery_images.*.max' => 'Each gallery image must be less then ' . $this->maxSize . ' MB.',
        ];
    }
}
