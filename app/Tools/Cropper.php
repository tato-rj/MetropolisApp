<?php

namespace App\Tools;

use Illuminate\Http\Request;

class Cropper
{
	protected $request, $file, $image, $path, $filename;

	public function __construct(Request $request)
	{
		$this->request = $request;
	}

	public function make($name)
	{
		$this->file = $this->request->file($name);

        $this->image = \Image::make($this->file)->crop(
            intval($this->request->cropped_width), 
            intval($this->request->cropped_height), 
            intval($this->request->cropped_x), 
            intval($this->request->cropped_y)
        );

        $this->generateFilename();

        return $this;
	}

	public function generateFilename()
	{
		$this->filename = str_slug($this->request->name) . '.' . $this->file->getClientOriginalExtension();
	}

	public function getPath()
	{
		return 'storage/' . $this->path . $this->filename;
	}

	public function saveTo($path)
	{
		$this->path = $path;

		$location = storage_path('app/public/' . $this->path . $this->filename);

		$this->image->save($location);

		return $this;
	}
}
