<?php

namespace App\Http\Requests\Activities;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class HolidayRequest extends FormRequest
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
        Rule::unique('holidays', 'title')->ignore($this->holiday)
      ],
      'study_program_id' => 'required|numeric',
      'holiday_date' => 'required|date',
      'description' => 'nullable|string',
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

      'study_program_id.required' => 'Mohon pilih salah satu :attribute',
      'study_program_id.numeric' => ':attribute tidak valid, masukkan yang benar',

      'holiday_date.required' => 'Mohon pilih salah satu :attribute',
      'holiday_date.date' => ':attribute harus berupa tanggal',
    ];
  }

  /**
   * Get custom attributes for validator errors.
   *
   */
  public function attributes(): array
  {
    return [
      'title' => 'Agenda kegiatan',
      'study_program_id' => 'Program studi',
      'holiday_date' => 'Tanggal libur',
      'description' => 'Deskripsi',
    ];
  }
}
