<?php

namespace App\Http\Requests\Activities;

use App\Helpers\Global\Constant;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class JournalRequest extends FormRequest
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
    if ($this->method() === Constant::POST) {
      $validate = [
        'title' => [
          'required', 'string', 'max:50',
        ],
        'description' => 'required|string',
        'proof' => 'required|mimes:jpg,png|max:3048',
      ];
    } else {
      $validate = [
        'title' => [
          'required', 'string', 'max:50',
        ],
        'description' => 'required|string',
        'proof' => 'nullable|mimes:jpg,png|max:3048',
      ];
    }

    return $validate;
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

      'description.required' => ':attribute tidak boleh dikosongkan',
      'description.string' => ':attribute tidak valid, masukkan yang benar',

      'proof.required' => ':attribute tidak boleh dikosongkan',
      'proof.image' => ':attribute tidak valid, pastikan memilih gambar',
      'proof.mimes' => ':attribute tidak valid, masukkan gambar dengan format jpg atau png',
      'proof.max' => ':attribute terlalu besar, maksimal :max kb',
    ];
  }

  /**
   * Get custom attributes for validator errors.
   *
   */
  public function attributes(): array
  {
    return [
      'title' => 'Materi',
      'description' => 'Deskripsi',
      'proof' => 'Bukti',
    ];
  }
}
