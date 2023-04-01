<?php

namespace App\Http\Requests\Master;

use App\Helpers\Global\Constant;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class LeaderRequest extends FormRequest
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
        $this->method() == Constant::POST ? Rule::unique('users', 'email') : Rule::unique('users', 'email')->ignore($this->leader->user_id)
      ],
      'phone' => [
        'required', 'numeric', 'min:12',
        $this->method() == Constant::POST ? Rule::unique('users', 'phone') : Rule::unique('users', 'phone')->ignore($this->leader->user_id)
      ],
      'study_program_id' => [
        'required', 'string', 'max:50',
        Rule::unique('leaders', 'study_program_id')->ignore($this->leader)
      ],
      'nidn' => [
        'required', 'numeric',
        Rule::unique('leaders', 'nidn')->ignore($this->leader)
      ],
      'gender' => 'required|string',
      'avatar' => 'nullable|mimes:jpg,png|max:3048',
    ];
  }

  /**
   * Get the error messages for the defined validation rules.
   *
   */
  public function messages(): array
  {
    return [
      'study_program_id.required' => ':attribute tidak boleh dikosongkan',
      'study_program_id.string' => ':attribute tidak valid, masukkan yang benar',
      'study_program_id.unique' => ':attribute sudah memiliki Kaprodi, silahkan pilih yang lain',

      'name.required' => ':attribute tidak boleh dikosongkan',
      'name.string' => ':attribute tidak valid, masukkan yang benar',
      'name.max' => ':attribute terlalu panjang, maksimal :max karakter',

      'nidn.required' => ':attribute tidak boleh dikosongkan',
      'nidn.unique' => ':attribute sudah digunakan, silahkan pilih yang lain',
      'nidn.numeric' => ':attribute harus berupa angka',

      'email.required' => ':attribute tidak boleh dikosongkan',
      'email.unique' => ':attribute sudah digunakan, silahkan pilih yang lain',
      'email.email' => ':attribute tidak valid, masukkan yang benar',

      'phone.required' => ':attribute tidak boleh dikosongkan',
      'phone.unique' => ':attribute sudah digunakan, silahkan pilih yang lain',
      'phone.numeric' => ':attribute harus berupa angka',
      'phone.min' => ':attribute terlalu pendek, minimal :min karakter',

      'gender.string' => ':attribute tidak valid, masukkan yang benar',

      'avatar.image' => ':attribute tidak valid, pastikan memilih gambar',
      'avatar.mimes' => ':attribute tidak valid, masukkan gambar dengan format jpg atau png',
      'avatar.max' => ':attribute terlalu besar, maksimal :max kb',
    ];
  }

  /**
   * Get custom attributes for validator errors.
   *
   */
  public function attributes(): array
  {
    return [
      'study_program_id' => 'Prodi',
      'nidn' => 'Nidn',
      'name' => 'Nama Lengkap',
      'email' => 'Email',
      'phone' => 'Telepon',
      'gender' => 'Jenis Kelamin',
      'avatar' => 'Avatar',
    ];
  }
}
