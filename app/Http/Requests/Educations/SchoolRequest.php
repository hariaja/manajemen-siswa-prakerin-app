<?php

namespace App\Http\Requests\Educations;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class SchoolRequest extends FormRequest
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
      'npsn' => [
        'required', 'numeric',
        Rule::unique('schools', 'npsn')->ignore($this->school)
      ],
      'name' => [
        'required', 'string', 'max:50',
        Rule::unique('schools', 'name')->ignore($this->school)
      ],
      'education' => 'required|string',
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
      'npsn.required' => ':attribute tidak boleh dikosongkan',
      'npsn.numeric' => ':attribute harus berupa angka',
      'name.max' => ':attribute terlalu panjang, maksimal :max karakter',
      'npsn.unique' => ':attribute sudah memiliki Kaprodi, silahkan pilih yang lain',

      'name.required' => ':attribute tidak boleh dikosongkan',
      'name.string' => ':attribute tidak valid, masukkan yang benar',
      'name.max' => ':attribute terlalu panjang, maksimal :max karakter',
      'name.unique' => ':attribute sudah memiliki Kaprodi, silahkan pilih yang lain',

      'nidn.required' => ':attribute tidak boleh dikosongkan',
      'nidn.unique' => ':attribute sudah digunakan, silahkan pilih yang lain',
      'nidn.numeric' => ':attribute harus berupa angka',

      'gender.required' => ':attribute tidak boleh dikosongkan',
      'gender.string' => ':attribute tidak valid, masukkan yang benar',

      'status.required' => ':attribute tidak boleh dikosongkan',
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
      'npsn' => 'Npsn',
      'name' => 'Nama Sekolah',
      'education' => 'Bentuk Pendidikan',
      'status' => 'Status Sekolah',
    ];
  }
}
