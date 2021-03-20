<?php

namespace PDMFC\NovaNotesField\Traits;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use PDMFC\NovaNotesField\Models\Note;

/**
 * Trait HasNotes
 * @package PDMFC\NovaNotesField\Traits
 *
 * @mixin Model
 */
trait ModelHasNotes
{
    /**
     * Initialize the Trait for the instance
     */
    public function initializeModelHasNotes(): void
    {
        $this->withCount['notes'] = static function ($query) {
            $query->where('personal', false)
                ->orWhere('created_by', 1); //TODO avoid loop on USER model
        };
    }

    /**
     * @return MorphMany|Note
     */
    public function notes()
    {
        return $this->morphMany(Note::class, 'notable');
    }
}
