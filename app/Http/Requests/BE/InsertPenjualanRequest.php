<?php

namespace App\Http\Requests\BE;

use Illuminate\Foundation\Http\FormRequest;

class InsertPenjualanRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            [
                'tanggal' => 'required',
                'pembeli' => 'required',
                'qty' => 'required',
                'unit' => 'required',
                'harga' => 'required',
                'total' => 'required'
            ]
        ];
    }
}
