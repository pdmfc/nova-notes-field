<?php

namespace PDMFC\NovaNotesField\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use PDMFC\NovaNotesField\Http\Requests\NoteRequest;
use PDMFC\NovaNotesField\Models\Note;

class NoteController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $notes = Note::where('notable_type', $request->input('notable_type'))
            ->where('notable_id', $request->input('notable_id'))
            ->get();

        return response()->json($notes);
    }

    public function store(NoteRequest $request): JsonResponse
    {
        $note = Note::create($request->validated());

        return response()->json($note);
    }
}
