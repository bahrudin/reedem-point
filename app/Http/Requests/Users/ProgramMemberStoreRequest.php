<?php

namespace App\Http\Requests\Users;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class ProgramMemberStoreRequest extends FormRequest
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
//        $userId = $this->user()->id; // Ambil ID pengguna saat ini
        $userId = Auth::id(); // Ambil ID pengguna saat ini

        return [

            'program_id' => [
                'required',
                'exists:programs,id', //check-1
                Rule::unique('user_programs', 'program_id')->where(function ($query) use ($userId) {
                    return $query->where('user_id', $userId); //check-2
                }),
            ],


//            'program_id' => 'required|',
//            'program_id' => 'required|same:user_program_members,program_member_id',
//            'program_id' => [
//                'required',
//                Rule::exists('invitelists')->whereHas('token', function ($query) use ($key) {
//                }),
//            ],

//            'program_id' => [
//                'required',
//                Rule::exists('user_program_members')->where(function ($query) {
//                    $query->where('program_member_id', Auth::id());
//                }),
//            ],
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'program_id.unique' => 'Anda sudah terdaftar.',
            'program_id.required' => 'Program harus di isi',
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
}
