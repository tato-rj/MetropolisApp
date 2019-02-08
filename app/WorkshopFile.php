<?php

namespace App;

class WorkshopFile extends Metropolis
{
    protected static function boot()
    {
        parent::boot();

        self::deleting(function($file) {
        	\Storage::disk('public')->delete($file->path);
        });
    }

    public function getIconAttribute()
    {
        return 'images/file_icons/' . $this->extension . '.svg';
    }

    public function getDownloadPathAttribute()
    {
        return 'storage/' . $this->path;
    }
}
