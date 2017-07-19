<?php

namespace App\Http\Requests\Frontend\User;

use App\Http\Requests\Request;
use Illuminate\Validation\Rule;

/**
 * Class UpdateProfileRequest.
 */
class UpdateProfileRequest extends Request
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
            'username'          => ['required', 'max:255', Rule::unique('users')->ignore(access()->id())],
            'email'             => ['sometimes', 'required', 'email', 'max:255', Rule::unique('users')->ignore(access()->id())],
            'first_name'        => 'required|max:255',
            'last_name'         => 'required|max:255',
            'address'           => 'required|max:255',
            'contact_number'    => 'required|max:255',
            'image'             => 'mimes:jpeg,jpg,png',
        ];
    }
}
