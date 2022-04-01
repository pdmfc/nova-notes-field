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
        // Avoid loop in the auth guard model (Usually App\Models\User)
        // So we want the Guard's cached user
        $userId = null;
        if (method_exists(auth()->guard(), 'getUser')) {
            $userId = optional(auth()->guard()->getUser())->getKey();
        }

        $this->withCount['notes'] = static function ($query) use ($userId) {
            $query->where('personal', false)
                ->orWhere('created_by', $userId);
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
