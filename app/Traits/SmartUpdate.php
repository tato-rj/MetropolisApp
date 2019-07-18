<?php

namespace App\Traits;

use Carbon\Carbon;

use Illuminate\Http\Request;

trait SmartUpdate
{
	public function updateOrIgnore(Request $request)
	{
		$start_hour = strhas($request->start_time, '30') ? substr($request->start_time, 0, 2) : $request->start_time;
		$start_minutes = strhas($request->start_time, '30') ? 30 : 0;
		$end_hour = strhas($request->end_time, '30') ? substr($request->end_time, 0, 2) : $request->end_time;
		$end_minutes = strhas($request->end_time, '30') ? 30 : 0;
		$request->starts_at = Carbon::parse($request->date)->setTime($start_hour,$start_minutes,0);
		$request->ends_at = Carbon::parse($request->date)->setTime($end_hour,$end_minutes,0);

		$this->update([
			'slug' => $this->evaluate($request, 'slug'),
            'name' => $this->evaluate($request, 'name'),
            'headline' => $this->evaluate($request, 'headline'),
            'description' => $this->evaluate($request, 'description'),
            'fee' => $this->evaluate($request, 'fee'),
            'discount' => $this->evaluate($request, 'discount'),
            'capacity' => $this->evaluate($request, 'capacity'),
            'starts_at' => $this->evaluate($request, 'starts_at'),
            'ends_at' => $this->evaluate($request, 'ends_at')
        ]);
	}

	public function evaluate(Request $request, $field)
	{
		if ($field == 'slug')
			return $request->name != $this->name ? str_slug($request->name) : $this->slug;

		return $request->$field != $this->$field ? $request->$field : $this->$field;
	}
}
