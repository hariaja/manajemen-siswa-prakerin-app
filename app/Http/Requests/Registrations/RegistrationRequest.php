<?php

namespace App\Http\Requests\Registrations;

use Illuminate\Validation\Rule;
use App\Helpers\Global\Constant;
use Illuminate\Foundation\Http\FormRequest;

class RegistrationRequest extends FormRequest
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
      'date' => 'required|unique:registrations,date,' . $this->registration . ',id',
      'name.*' => 'required',
      'email.*' => [
        'required', 'email:dns',
        Rule::unique('users', 'email')
      ],
      'phone.*' => [
        'required', 'numeric', 'min:12',
        Rule::unique('users', 'phone')
      ],
      'gender.*' => 'required|string',
      'address.*' => 'required|string',
    ];
  }
}
