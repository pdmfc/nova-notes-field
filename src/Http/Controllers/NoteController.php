<?php

namespace PDMFC\NovaNotesField\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use PDMFC\NovaNotesField\Http\Requests\NoteRequest;
use PDMFC\NovaNotesField\Models\Note;
use SebastianBergmann\Environment\Console;
use PDMFC\NovaNotesField\Http\Resources\NoteResource;

class NoteController extends Controller
{
    public function index(Request $request, Note $note): JsonResponse
    {
        return response()->json(Note::whereNotableTypeAndId($request->input('notable_type'), $request->input('notable_id'))->with('author', 'notes')->get());
        
    }

    public function store(NoteRequest $request): JsonResponse
    {
        // aqui eh um exemplo de como ele faz para criar uma nova nota
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

   

    //UPDATE NOTE
    public function update(NoteRequest $request): JsonResponse
    {
        // $request->update();
        return response()->json(['message'=>'susses']);
        //CODE..
    }
}
