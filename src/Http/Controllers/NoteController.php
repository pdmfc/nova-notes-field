<?php

namespace PDMFC\NovaNotesField\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use PDMFC\NovaNotesField\Http\Requests\NoteRequest;
use PDMFC\NovaNotesField\Models\Note;

class NoteController extends Controller
{
    //VIEW ALL NOTES
    public function index(Request $request): JsonResponse
    {
        return response()->json(Note::whereNotableTypeAndId($request->input('notable_type'), $request->input('notable_id'))->with('author', 'notes')->get());
    }

    //SAVE A NOTE
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

    //DELETE NOTE
    public function destroy(Request $request, Note $note): JsonResponse
    {
        $note->delete();
        return response()->json(['message'=>'success']);
    }

    //UPDATE NOTE
    public function update(NoteRequest $request): JsonResponse
    {
        return response();
    }
}
