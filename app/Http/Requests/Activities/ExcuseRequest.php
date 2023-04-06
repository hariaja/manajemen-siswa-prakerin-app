<?php

namespace App\Http\Requests\Activities;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class ExcuseRequest extends FormRequest
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
      'title' => [
        'required', 'string', 'max:50',
        Rule::unique('attendances', 'title')->ignore($this->attendance)
      ],
      'description' => 'required|string',
    ];
  }

  /**
   * Get the error messages for the defined validation rules.
   *
   */
  public function messages(): array
  {
    return [
      'title.required' => ':attribute tidak boleh dikosongkan',
      'title.string' => ':attribute tidak valid, masukkan yang benar',
      'title.max' => ':attribute terlalu panjang, maksimal :max karakter',
      'title.unique' => ':attribute sudah digunakan, silahkan pilih yang lain',

      'description.required' => ':attribute tidak boleh dikosongkan',
      'description.string' => ':attribute tidak valid, masukkan yang benar',
    ];
  }

  /**
   * Get custom attributes for validator errors.
   *
   */
  public function attributes(): array
  {
    return [
      'title' => 'Alsan tidak hadir',
      'description' => 'Deskripsi',
    ];
  }
}
