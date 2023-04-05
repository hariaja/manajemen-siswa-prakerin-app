<?php

namespace App\Http\Requests\Activities;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class AttendanceRequest extends FormRequest
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
      'study_program_id' => 'required|numeric',
      'description' => 'nullable|string',
      'start_time' => 'required|date_format:H:i',
      'timeout_start_time' => 'required|date_format:H:i|after:start_time',
      'end_time' => 'required|date_format:H:i',
      'timeout_end_time' => 'required|date_format:H:i|after:end_time',
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

      'start_time.required' => ':attribute tidak boleh dikosongkan',
      'start_time.date_format' => ':attribute tidak valid',

      'timeout_start_time.required' => ':attribute tidak boleh dikosongkan',
      'timeout_start_time.date_format' => ':attribute tidak valid',
      'timeout_start_time.after' => ':attribute harus lebih dari :date',

      'end_time.required' => ':attribute tidak boleh dikosongkan',
      'end_time.date_format' => ':attribute tidak valid',

      'timeout_end_time.required' => ':attribute tidak boleh dikosongkan',
      'timeout_end_time.date_format' => ':attribute tidak valid',
      'timeout_end_time.after' => ':attribute harus lebih dari :date',
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
      'start_time' => 'Jam masuk',
      'timeout_start_time' => 'Batas jam masuk',
      'end_time' => 'Jam pulang',
      'timeout_end_time' => 'Batas jam pulang',
      'description' => 'Deskripsi',
    ];
  }
}
