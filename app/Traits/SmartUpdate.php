<?php

namespace App\Traits;

use Carbon\Carbon;

use Illuminate\Http\Request;

trait SmartUpdate
{
	public function updateOrIgnore(Request $request)
	{
		$request->starts_at = Carbon::parse($request->date)->setTime($request->start_time,0,0);
		$request->ends_at = Carbon::parse($request->date)->setTime($request->end_time,0,0);

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
