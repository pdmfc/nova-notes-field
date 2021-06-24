<?php

namespace PDMFC\NovaNotesField\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use App\Models\User;

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
        'personal',
        'notable_type',
        'notable_id',
        'as_html'
    ];

    /**
     * @return MorphTo
     */
    public function notable(): MorphTo
    {
        return $this->morphTo();
    }

    public function author() {
            return $this->belongsTo(User::class, 'created_by');
    }
}
