<?php

namespace App\Http\Requests\Photo;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @author i.rebega <i.rebega@bvblogic.com>
 */
class PhotoRequest extends FormRequest
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
            'id'         => 'required',
            'filename'   => 'array',
            'filename.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ];
    }

    /**
     * @return array
     */
    public function attributes()
    {
        return [
            'id'         => 'Gallery id',
            'filename.0' => 'Photo 1',
            'filename.1' => 'Photo 2',
            'filename.2' => 'Photo 3'
        ];
    }
}
