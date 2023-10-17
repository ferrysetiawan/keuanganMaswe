<?php

namespace App\Http\Requests\BE;

use Illuminate\Foundation\Http\FormRequest;

class UpdateKategoriRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    // public function authorize()
    // {
    //     return false;
    // }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            [
                'nama_kategori' => 'required|max:100'
            ]
        ];
    }

    public function messages()
    {
        return [
            'nama_kategori.required' => 'Nama Kategori harus diisi.',
            'nama_kategori.max' => 'Nama Kategori tidak boleh lebih dari :max karakter.',
        ];
    }
}
