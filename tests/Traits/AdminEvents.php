<?php

namespace Tests\Traits;

use App\Workshop;
use Illuminate\Http\UploadedFile;

trait AdminEvents
{
	public function newWorkshop()
	{
        $request = make(Workshop::class);

        $request->cover_image = UploadedFile::fake()->image('cover.jpg');

        $this->post(route('admin.workshops.store'), $request->toArray())->assertSessionHas('status');

        return Workshop::where('name', $request->name)->first();
	}
}
