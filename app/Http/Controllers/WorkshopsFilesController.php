<?php

namespace App\Http\Controllers;

use App\{WorkshopFile, Workshop};
use Illuminate\Http\Request;

class WorkshopsFilesController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Workshop $workshop)
    {
        $name = cleanFileName($request->file('file')->getClientOriginalName());

        try {
            WorkshopFile::create([
                'workshop_id' => $workshop->id,
                'path' => $request->file('file')->store("/workshops/{$workshop->slug}/arquivos"),
                'name' => $name
            ]);            
        } catch (\Exception $e) {
            return response()->json('Não foi possível fazer o upload nesse momento...', 404);
        }

        return response()->json(200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\WorkshopFile  $workshopFile
     * @return \Illuminate\Http\Response
     */
    public function destroy(Workshop $workshop, WorkshopFile $file)
    {
        try {
            $file->delete();
        } catch (\Exception $e) {
            return response()->json('Não foi possível deletar esse arquivo.', 404);
        } 

        return response()->json(200);
    }
}
