<?php

namespace App\Traits;

trait Scheduler
{
    public function checkAvailability($date, $duration, $participants = null)
    {
        if (! $this->is_shared)
            return ['status' => $this->eventsOn($date, $duration)->isEmpty()];

        $participantsLeft = $this->participantsLeftOn($date, $duration);
        
        return $participantsLeft >= $participants ? ['status' => true] : ['status' => false, 'participantsLeft' => $participantsLeft];
    }

    public function eventsOn($date, $duration)
    {
        $startDate = $date;
        $endDate = $date->copy()->addHours($duration);

        $events = $this->events()->where([
            ['space_id', $this->id],
            ['starts_at', '<=', $date],
            ['ends_at', '>', $date]
        ]);

        for ($i = 1; $i < $endDate->diffInHours($startDate); $i++) {
            $events->orWhere([
                ['space_id', $this->id],
                ['starts_at', '<=', $date->copy()->addHours($i)],
                ['ends_at', '>', $date->copy()->addHours($i)]
            ]);
        }

        return $events->get();
    }

    public function participantsLeftOn($date, $duration)
    {
        return $this->capacity - $this->eventsOn($date, $duration)->sum('participants');
    }
}
