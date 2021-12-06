<?php

namespace App\Http\Requests;

use App\Rules\profilerInfoIDRule;
use Illuminate\Foundation\Http\FormRequest;

class profilerEmailUpdate extends FormRequest
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
        $id = $this->profiler_email;
        return [
            'profiler_email' => 'required|string|max:50|min:2' . $id,
            'profiler_infos_id' => ['required', 'int', new profilerInfoIDRule(),],
            'email_description' => 'required|string|max:300|min:5',
        ];
    }
}
