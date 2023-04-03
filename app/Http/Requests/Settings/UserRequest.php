<?php

namespace App\Http\Requests\Settings;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
  /**
   * Determine if the user is authorized to make this request.
   */
  public function authorize(): bool
  {
    return true;
  }

  /**
   * Get the validation rules that apply to the request.
   *
   * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
   */
  public function rules(): array
  {
    return [
      'name' => 'required|string|max:50',
      'email' => [
        'required', 'email:dns',
        Rule::unique('users', 'email')->ignore($this->user)
      ],
      'phone' => [
        'required', 'numeric', 'min:12',
        Rule::unique('users', 'phone')->ignore($this->user)
      ],
      'avatar' => 'nullable|mimes:jpg,png|max:3048',
    ];
  }
}
