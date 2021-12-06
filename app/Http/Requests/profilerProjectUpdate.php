<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class profilerProjectUpdate extends FormRequest
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
    public function rules()
    {
        $id = $this->profiler_project;
        return [
            'project_name' => 'required|string|max:50|min:2' . $id,
            'profiler_infos_id' => 'required',
            'project_description' => 'required|int|max:300|min:2',
        ];
    }
}
