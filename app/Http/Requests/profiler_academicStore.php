<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use JetBrains\PhpStorm\ArrayShape;

class profiler_academicStore extends FormRequest
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
    #[ArrayShape(['diploma_title' => "string", 'profiler_infos_id' => "string", 'institution_attended' => "string", 'diploma_description' => "string"])]
    public function
    rules(): array
    {
        return [
            'diploma_title' => 'required|string|max:50|min:2',
            'profiler_infos_id' => 'required',
            'institution_attended' => 'required|string|max:50|min:2',
            'diploma_description' => 'required|string|max:300|min:5',
        ];
    }
}
