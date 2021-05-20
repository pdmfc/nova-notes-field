<?php

namespace PDMFC\NovaNotesField\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;
use PDMFC\NovaNotesField\Http\Requests\NoteRequest;
use PDMFC\NovaNotesField\Models\Note;

class NoteController extends Controller
{
    public function store(NoteRequest $request): JsonResponse
    {
        return response()->json(Note::create($request->validated()));
    }
}
