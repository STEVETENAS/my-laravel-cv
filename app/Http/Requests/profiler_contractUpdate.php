<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use JetBrains\PhpStorm\ArrayShape;

class profiler_contractUpdate extends FormRequest
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
    #[ArrayShape(['contract_type' => "string", 'profiler_infos_id' => "string", 'contract_description' => "string"])]
    public function rules(): array
    {
        $id = $this->profiler_contract;
        return [
            'contract_type' => 'required|string|max:50|min:2' . $id,
            'profiler_infos_id' => 'required',
            'contract_description' => 'required|string|max:300|min:5',
        ];
    }
}
