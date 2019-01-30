<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\{User, Space};
use Carbon\Carbon;

class CreateEventForm extends FormRequest
{
    public $user, $space, $starts_at, $ends_at;

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $this->setFields();

        return auth()->check() && $this->getReport()->status;
    }

    public function getReport()
    {
        return $this->space->checkAvailability($this->starts_at, $this->duration, $this->participants);
    }

    public function setFields()
    {
        $this->user = User::find($this->user_id);
        $this->space = Space::find($this->space_id);

        $this->starts_at = Carbon::parse($this->date)->setTime($this->time, 0, 0);
        $this->ends_at = calculateEndingTime($this->starts_at, $this->duration); 
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'user_id' => 'required',
            'space_id' => 'required|exists:spaces,id',
            'participants' => 'required|integer',
            'duration' => 'required|integer',
            'date' => 'required',
            'time' => 'required'
        ];
    }
}
