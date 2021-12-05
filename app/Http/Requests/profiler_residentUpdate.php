<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class profiler_residentUpdate extends FormRequest
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
        $id = $this->profiler_resident;
        return [
            'place_of_residence' => 'required|string|max:50|min:2' . $id,
            'profiler_infos_id' => 'required',
            'city_of_residence' => 'required|string|max:50|min:2',
            'country_of_residence' => 'required|string|max:50|min:2',
            'residence_longitude' => 'required|double',
            'residence_latitude' => 'required|double',
        ];
    }
}
