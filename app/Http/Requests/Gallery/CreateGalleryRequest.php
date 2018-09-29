<?php

namespace App\Http\Requests\Gallery;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @author i.rebega <i.rebega@bvblogic.com>
 */
class CreateGalleryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required|string|max:255'
        ];

    }

    /**
     * @return array
     */
    public function attributes()
    {
        return [
            'title' => 'Title'
        ];
    }
}
