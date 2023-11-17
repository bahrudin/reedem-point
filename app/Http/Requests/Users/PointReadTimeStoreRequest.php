<?php

namespace App\Http\Requests\Users;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;

class PointReadTimeStoreRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        //login
        $userId = $this->user()->id;
        return [
            'user_id' => 'required|exists:users,id',
            'program_id' => [
                'required',
                //cek table programs ada
                Rule::exists('programs', 'id'),
                //cek user sudah mendaftar
                Rule::exists('user_programs', 'program_id')->where(function ($query) use ($userId) {
                    return $query->where('user_id', $userId);
                }),
            ],
            'point_id'=>'nullable|exists:points,id',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        $response = response()->json([
            'message' => 'Validation failed',
            'errors' => $validator->errors()
        ], 422);

        throw new HttpResponseException($response);
    }

    public function messages()
    {
        return [
            'program_id.required'=>'Program harus di pilih',
            'program_id.exists'=>'Program anda tidak terdaftar',
        ];
    }
}
