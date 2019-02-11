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

        if (auth()->guard('admin')->check())
            return true;

        return auth()->check() && $this->getReport()->status;
    }

    public function getReport()
    {
        return $this->space->checkAvailability($this->starts_at, $this->duration, $this->participants);
    }

    public function setFields()
    {
        $this->user = auth()->user();
        $this->space = Space::find($this->space_id);
        $hour = explode('.', $this->time)[0];
        $min = explode('.', $this->time)[1];

        $this->starts_at = Carbon::parse($this->date)->setTime($hour, $min, 0);
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
            'space_id' => 'required|exists:spaces,id',
            'participants' => 'required|integer',
            'duration' => 'required|integer',
            'date' => 'required',
            'time' => 'required'
        ];
    }
}
