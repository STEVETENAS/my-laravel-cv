<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class profiler_skillStore extends FormRequest
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
            'skill_title' => 'required|string|max:50|min:2',
            'profiler_infos_id' => 'required',
            'skill_level' => 'required|int|max:100|min:1',
            'skill_description' => 'required|string|max:300|min:2',
        ];
    }
}
