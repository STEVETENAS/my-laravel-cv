<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class profiler_langUpdate extends FormRequest
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
        $id = $this->profiler_lang;
        return [
            'language' => 'required|string|max:50|min:2' . $id,
            'profiler_info_id' => 'required',
            'language_level' => 'required|int|max:10|min:1',
        ];
    }
}
