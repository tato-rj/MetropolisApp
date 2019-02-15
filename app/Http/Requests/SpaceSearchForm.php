<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Space;

class SpaceSearchForm extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->prepareEvent();
    }

    public function prepareEvent()
    {
        try {

            $hour = explode(':', $this->time)[0];
            $min = explode(':', $this->time)[1];

            $this->user = auth()->user() ?? null;
            $this->starts_at = carbon($this->date)->setTime($hour,$min,0);
            $this->ends_at = calculateEndingTime($this->starts_at, $this->duration);
            $this->time = $this->starts_at->format('H:i');
            $this->space = Space::bySlug($this->type);

        } catch (\Exception $e) {
            abort(404, 'Os dados fornecidos não estão corretos');
        }

        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'type' => 'required|exists:spaces,slug',
            'date' => 'required|date',
            'time' => 'required',
            'duration' => 'required|integer',
            'participants' => 'required|integer'
        ];
    }
}
