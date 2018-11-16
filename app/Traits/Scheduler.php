<?php

namespace App\Traits;

use App\Office\Report;

trait Scheduler
{
    public function checkAvailability($date, $duration, $participants = null)
    {
        if (! office()->isWorkingDay($date))
            return new Report($this, $date, false);

        if (! $this->is_shared)
            return new Report($this, $date, $status = $this->eventsOn($date, $duration)->isEmpty());

        $participantsLeft = $this->participantsLeftOn($date, $duration);

        if ($participantsLeft >= $participants)
            return new Report($this, $date, $status = true);

        return new Report($this, $date, $status = false, $participantsLeft);
    }

    public function eventsOn($date, $duration)
    {
        $startDate = $date;
        $endDate = $date->copy()->addHours($duration);

        $events = $this->events()->doesnthave('plan')->where([
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
