<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Event;


class ShowPaymentForm extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $event = $this->validateEvent();

        return auth()->guard('web')->user()->id == $event->creator->id;
    }

    public function validateEvent()
    {
        $event = Event::byReference($this->referencia)->firstOrFail();

        $this->type = $event->space->slug;
        $this->user = $event->creator;
        $this->starts_at = $this->date = $event->starts_at;
        $this->ends_at = $event->ends_at;
        $this->time = $event->starts_at->format('H:i');
        $this->space = $event->space;
        $this->duration = $this->starts_at->diffInHours($this->ends_at);
        $this->participants = $event->participants;

        return $event;
    }
    
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'referencia' => 'required|exists:events,reference'
        ];
    }
}
