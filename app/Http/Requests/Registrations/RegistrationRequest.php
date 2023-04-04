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
      'schedule_id' => 'required|numeric',
      'student' => 'required',
      'date' => 'required|date',
      'note' => 'required|mimes:pdf|max:3048',
    ];
  }
}
