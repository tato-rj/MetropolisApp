<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Space;

class CheckEventsForm extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        try {

            $hour = explode(':', $this->time)[0];
            $min = explode(':', $this->time)[1];
            $this->starts_at = carbon($this->date)->setTime($hour,$min,0);
            $this->ends_at = calculateEndingTime($this->starts_at, $this->duration);
            $this->time = $this->starts_at->format('H:i');
            $this->space = Space::find($this->space_id);   
        
        } catch (\Exception $e) {
            abort(422);
        }

        return auth()->guard('admin')->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'date' => 'required',
            'space_id' => 'required|exists:spaces,id',
            'duration' => 'required',
            'participants' => 'required',
            'time' => 'required'
        ];
    }
}
