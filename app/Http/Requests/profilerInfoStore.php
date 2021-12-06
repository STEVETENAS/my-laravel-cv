<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class profilerInfoStore extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'first_name' => 'required|string|max:50|min:2',
            'last_name' => 'required|string|max:50|min:2',
            'profession' => 'required|string|max:50|min:2',
            'gender' => 'required|string|max:10|min:4',
            'place_of_birth' => 'required|string|max:30|min:2',
            'place_of_origin' => 'required|string|max:30|min:2',
            'date_of_birth' => 'required',
            'job_end_date' => 'required',
            'profiler_infos_id' => 'required',
            'job_description' => 'required|string|max:300|min:5',
            'number_of_children' => 'required|int',
            'married' => 'required|bool',
            'profiler_image' => 'required|binary',
            'background_image' => 'required|binary',
        ];
    }
}
