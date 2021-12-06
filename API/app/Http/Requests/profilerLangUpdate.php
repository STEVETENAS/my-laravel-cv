<?php

namespace App\Http\Requests;

use App\Rules\profilerInfoIDRule;
use Illuminate\Foundation\Http\FormRequest;

class profilerLangUpdate extends FormRequest
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
            'profiler_infos_id' => ['required', 'int', new profilerInfoIDRule(),],
            'language_level' => 'required|int|max:10|min:1',
        ];
    }
}
