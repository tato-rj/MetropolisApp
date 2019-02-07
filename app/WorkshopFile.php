<?php

namespace App;

use Illuminate\Support\Facades\Storage;

class WorkshopFile extends Metropolis
{
    protected static function boot()
    {
        parent::boot();

        self::deleting(function($file) {
        	Storage::delete($file->path);
        });
    }

    public function getFullNameAttribute()
    {
    	return $this->name.' ('.strtoupper(pathinfo($this->path)['extension']).')';
    }
}
