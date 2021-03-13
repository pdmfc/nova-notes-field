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
     * @return MorphMany|Note
     */
    public function notes()
    {
        return $this->morphMany(Note::class, 'notable');
    }
}
