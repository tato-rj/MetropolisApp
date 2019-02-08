<?php

namespace Tests\Traits;

use App\Workshop;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

trait AdminEvents
{
	public function newWorkshop($image = 'cover.jpg') {   
                Storage::fake('public');             
                
                $request = make(Workshop::class);

                $request->date = $request->starts_at;
                $request->start_time = $request->starts_at->hour;
                $request->end_time = $request->ends_at->hour;
                $request->cropped_width = '200';
                $request->cropped_height = '200';
                $request->cropped_x = '0';
                $request->cropped_y = '0';
                $request->cover_image = UploadedFile::fake()->image($image);

                $this->post(route('admin.workshops.store'), $request->toArray())->assertSessionHas('status');

                return Workshop::where('name', $request->name)->first();
	}
}
