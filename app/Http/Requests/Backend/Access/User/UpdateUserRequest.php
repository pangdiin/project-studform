<?php

namespace App\Http\Requests\Backend\Access\User;

use App\Http\Requests\Request;
use Illuminate\Validation\Rule;
use Route;
/**
 * Class UpdateUserRequest.
 */
class UpdateUserRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return access()->allow('manage-users');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'email'     => 'required|email',
            'username'  => ['required', 'max:255', Rule::unique('users')->ignore(Route::current()->parameters()['user']->id)]
        ];
    }
}
