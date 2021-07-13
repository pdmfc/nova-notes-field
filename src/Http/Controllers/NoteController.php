<?php

namespace PDMFC\NovaNotesField\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
// use App\Http\Controllers\Controller;
use PDMFC\NovaNotesField\Http\Requests\NoteRequest;
use PDMFC\NovaNotesField\Models\Note;
use App\Models\User;
use PDMFC\NovaNotesField\Http\Resources\NoteResource;

class NoteController extends Controller
{
    public function index(Request $request, Note $note): JsonResponse
    {
        $notes = Note::whereNotableTypeAndId($request->input('notable_type'), $request->input('notable_id'))->with('author', 'notes')->get();
        return response()->json(NoteResource::collection($notes));
    }

    public function store(NoteRequest $request): JsonResponse
    {
        if($request->input('reply_to_id')) {
            $note = Note::find($request->input('reply_to_id'));
            $noteData = $request->validated();
            $newNote = $note->notes()->create($noteData)
                ->load('author', 'notes');
            return response()->json(new NoteResource($newNote));
        }
        $note = Note::create($request->validated())->load('author', 'notes');
        return response()->json(new NoteResource($note));
    }

    public function destroy(Request $request)
    {
        $note = Note::find($request->input('id'));
        if ($note->created_by === auth()->id()) {
            return $note->delete();
        }
    }
}
