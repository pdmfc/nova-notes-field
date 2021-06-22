<?php

namespace PDMFC\NovaNotesField\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NoteRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'note' => 'required',
            'notable_id' => 'required|numeric',
            'notable_type' => 'required',
            'personal' => 'required|boolean',
            'as_html' => 'required|boolean'
        ];
    }
}
