<?php

namespace App\Http\Requests\Registrations;

use Illuminate\Validation\Rule;
use App\Helpers\Global\Constant;
use Illuminate\Foundation\Http\FormRequest;

class StudentRequest extends FormRequest
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
      'nisn' => [
        'required', 'numeric',
        Rule::unique('students', 'nisn')->ignore($this->student)
      ],
      'name' => 'required|string|max:50',
      'email' => [
        'required', 'email:dns',
        $this->method() == Constant::POST ? Rule::unique('users', 'email') : Rule::unique('users', 'email')->ignore($this->student->user_id)
      ],
      'phone' => [
        'required', 'numeric', 'min:12',
        $this->method() == Constant::POST ? Rule::unique('users', 'phone') : Rule::unique('users', 'phone')->ignore($this->student->user_id)
      ],
      'date_birth' => 'required|date',
      'gender' => 'required|string',
      'major' => 'required|string',
      'address' => 'required|string',
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
      'nisn.required' => ':attribute tidak boleh dikosongkan',
      'nisn.unique' => ':attribute sudah digunakan, silahkan pilih yang lain',
      'nisn.numeric' => ':attribute harus berupa angka',

      'name.required' => ':attribute tidak boleh dikosongkan',
      'name.string' => ':attribute tidak valid, masukkan yang benar',
      'name.max' => ':attribute terlalu panjang, maksimal :max karakter',

      'email.required' => ':attribute tidak boleh dikosongkan',
      'email.unique' => ':attribute sudah digunakan, silahkan pilih yang lain',
      'email.email' => ':attribute tidak valid, masukkan yang benar',

      'phone.required' => ':attribute tidak boleh dikosongkan',
      'phone.unique' => ':attribute sudah digunakan, silahkan pilih yang lain',
      'phone.numeric' => ':attribute harus berupa angka',
      'phone.min' => ':attribute terlalu pendek, minimal :min karakter',

      'date_birth.required' => ':attribute tidak boleh dikosongkan',
      'date_birth.date' => ':attribute harus berupa tanggal',

      'gender.required' => ':attribute tidak boleh dikosongkan',
      'gender.string' => ':attribute tidak valid, masukkan yang benar',

      'major.required' => ':attribute tidak boleh dikosongkan',
      'major.string' => ':attribute tidak valid, masukkan yang benar',

      'address.required' => ':attribute tidak boleh dikosongkan',
      'address.string' => ':attribute tidak valid, masukkan yang benar',

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
      'nisn' => 'Nisn',
      'name' => 'Nama lengkap',
      'email' => 'Email',
      'phone' => 'Telepon',
      'date_birth' => 'Tanggal lahir',
      'major' => 'Jurusan',
      'address' => 'Alamat lengkap',
      'gender' => 'Jenis kelamin',
      'avatar' => 'Avatar',
    ];
  }
}
