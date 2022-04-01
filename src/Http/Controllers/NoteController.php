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
        return response()->json(Note::whereNotableTypeAndId($request->input('notable_type'), $request->input('notable_id'))->with('author', 'notes')->get());
    }

    public function store(NoteRequest $request): JsonResponse
    {
        if($request->input('reply_to_id')) {
            $note = Note::find($request->input('reply_to_id'));

            $noteData = collect($request->validated())->except('reply_to_id', 'notable_type', 'notable_id')
                ->toArray();

            $newNote = $note->notes()->create($noteData)
                ->load('author', 'notes');

            return response()->json($newNote);
        }

        return response()->json(Note::create($request->validated())->load('author', 'notes'));
    }

    //DELETE -> DESTROY


    //EDIT 

    // public function store(NoteRequest $request): JsonResponse
    // {
    //     if($request->validated()['reply_to_id'] != null){
    //         $note = Note::find($request->input('reply_to_id'));
    //         $noteData = collect($request->validated())->except('notable_type', 'notable_id', 'reply_to_id')->toArray();
    //         $newNote = $note->notes()->create($noteData);
    //         return response()->json($newNote->load('author'));
    //     }
    //     return response()->json(Note::create($request->validated())->load('author'));
    // }
}
