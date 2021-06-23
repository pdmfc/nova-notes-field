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
            ->where(function ($query) use ($request) {
                $query->where('personal', false)
                    ->orWhere(function ($query) use ($request) {
                        $query->where('personal', true)
                                ->where('created_by', auth()->user()->id);
                    });
            })
            ->with('author')
            ->get();
        return response()->json($notes);
    }

    public function store(NoteRequest $request): JsonResponse
    {
        $validated = $request->validated();
        $note = Note::create([
            'note' => $validated['note'],
            'notable_id' => $validated['notable_id'],
            'notable_type' => $validated['notable_type'],
            'personal' => $validated['personal'],
            'as_html' => $validated['as_html'],
            'created_by' => auth()->user()->id
        ])->load('author');

        return response()->json($note);
    }
}
