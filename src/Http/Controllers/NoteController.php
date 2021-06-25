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
        return response()->json(Note::whereNotableTypeAndId($request->input('notable_type'), $request->input('notable_id'))->with('author')->get());
    }

    public function store(NoteRequest $request): JsonResponse
    {
        return response()->json(Note::create($request->validated())->load('author'));
    }
}
