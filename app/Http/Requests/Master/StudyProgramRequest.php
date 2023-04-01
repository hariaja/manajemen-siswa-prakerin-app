<?php

namespace App\Http\Requests\Master;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class StudyProgramRequest extends FormRequest
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
      'name' => [
        'required', 'string', 'max:50',
        Rule::unique('study_programs', 'name')->ignore($this->studyProgram)
      ],
      'status' => 'required|string',
    ];
  }

  /**
   * Get the error messages for the defined validation rules.
   *
   */
  public function messages(): array
  {
    return [
      'name.required' => ':attribute tidak boleh dikosongkan',
      'name.string' => ':attribute tidak valid, masukkan yang benar',
      'name.max' => ':attribute terlalu panjang, maksimal :max karakter',
      'name.unique' => ':attribute sudah digunakan, silahkan pilih yang lain',

      'status.required' => 'Mohon pilih salah satu :attribute',
      'status.string' => ':attribute tidak valid, masukkan yang benar',
    ];
  }

  /**
   * Get custom attributes for validator errors.
   *
   */
  public function attributes(): array
  {
    return [
      'name' => 'Nama Prodi',
      'status' => 'Status Keaktifan',
    ];
  }
}
