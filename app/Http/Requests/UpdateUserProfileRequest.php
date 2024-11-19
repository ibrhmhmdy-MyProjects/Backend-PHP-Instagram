<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;

class UpdateUserProfileRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $user = User::find($this->route('user')->id);
        return Gate::allows('edit-update-profile',$user);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'username' => ['required','string',Rule::unique('users')->ignore($this->user())],
            'bio' => ['nullable','string'],
            'image' => ['image','mimes:jpg,jpeg,png,gif'],
            'name' => ['required','string'],
            'email' => 'email',
            'password' => ['string','min:8','nullable','confirmed'],
        ];
    }
}
