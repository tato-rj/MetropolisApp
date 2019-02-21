<?php

namespace App\Traits;

use App\Office\Report;
use Illuminate\Foundation\Http\FormRequest;

trait Scheduler
{
    public function checkAvailability($date, $duration, $participants = null, $includePlan = false)
    {
        if ($duration <= office()->day_length && ! office()->isWorkingDay($date))
            return new Report($this, $date, false);

        if (! $this->is_shared)
            return new Report($this, $date, $status = $this->eventsOn($date, $duration)->isEmpty());

        $participantsLeft = $this->participantsLeftOn($date, $duration, $includePlan);

        if ($participantsLeft >= $participants)
            return new Report($this, $date, $status = true);

        return new Report($this, $date, $status = false, $participantsLeft);
    }

    public function eventsOn($date, $duration, $includePlan = false)
    {
        $startDate = $date;
        $endDate = $date->copy()->addHours($duration);

        if (! $startDate->isSameDay($endDate))
            return collect();

        $query = [
            ['space_id', $this->id],
            ['starts_at', '<', $endDate],
            ['ends_at', '>', $startDate],
            ['status_id', '!=', 6],
            ['status_id', '!=', 7],
            ['status_id', '!=', 9],
        ];

        if ($includePlan) {
            $events = $this->events()->where($query);
        } else {
            $events = $this->events()->doesnthave('plan')->where($query);
        }

        for ($i = 1; $i < $endDate->diffInHours($startDate); $i++) {
            $planCheck = $includePlan ? null: 'AND plan_id IS NULL';
            $events->orWhereRaw(
                'space_id = ' . $this->id . 
                ' AND starts_at < "' . $endDate->copy()->subHours($i) . '"' .
                ' AND ends_at > "' . $startDate->copy()->addHours($i) . '"' .
                ' AND status_id NOT IN (6,7,9) '.$planCheck);
            // $events->orWhere([
            //     ['space_id', $this->id],
            //     ['starts_at', '<', $endDate->copy()->addHours($i)],
            //     ['ends_at', '>', $startDate->copy()->addHours($i)],
            // ]);
        }

        return $events->get();
    }

    public function participantsLeftOn($date, $duration, $includePlan = false)
    {
        return $this->capacity - $this->eventsOn($date, $duration, $includePlan)->sum('participants');
    }

    public function authorize(FormRequest $form)
    {
        if (auth()->guard('admin')->check())
            return new Report($this, $form->starts_at, $status = true);

        return $this->checkAvailability($form->starts_at, $form->duration, $form->participants);
    }
}
