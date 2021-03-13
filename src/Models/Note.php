<?php

namespace PDMFC\NovaNotesField\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Note extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'note',
        'created_by',
        'personal'
    ];

    /**
     * @return MorphTo
     */
    public function notable(): MorphTo
    {
        return $this->morphTo();
    }
}
