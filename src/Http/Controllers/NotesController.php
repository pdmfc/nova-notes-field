<?php

namespace PDMFC\NovaNotesField\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use PDMFC\NovaNotesField\Models\Note;

class NotesController extends Controller
{
    public function post(Request $request)
    {
        Note::create($request->merge([
            'notable_type' => 'App\Models\User',
            'notable_id' => 1
        ])->all());
    }
}
