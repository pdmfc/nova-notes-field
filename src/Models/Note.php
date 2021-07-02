<?php

namespace PDMFC\NovaNotesField\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;
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
     * The event map for the model.
     *
     * @var array
     */

    public static function booted()
    {
        static::addGlobalScope('personal_or_by_author', function(Builder $query) {
             $query->where(function ($query){
                 $query->where('personal', false);
                 if (auth()->hasUser()) {
                    $query->orWhere('created_by', auth()->id());
                 }
             });
        });

        static::creating(function (Note $note) {
            $note->created_by = auth()->id();
        });
    }

    public function scopeWhereNotableTypeAndId($query, $type, $id)
    {
        return $query->where('notable_type', $type)
        ->where('notable_id', $id);
    }

    /**
     * @return MorphTo
     */
    public function notable(): MorphTo
    {
        return $this->morphTo();
    }

    public function notes()
    {
        return $this->morphMany(Note::class, 'notable')->with('author');
    }

    public function author()
    {
            return $this->belongsTo(User::class, 'created_by');
    }
}
