<?php

namespace PDMFC\NovaNotesField\Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use PDMFC\NovaNotesField\Models\Note;

class NoteFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Note::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'notable_type' => User::class,
            'notable_id' => 1,
            'note' => 'Teste',
            'created_by' => 1,
        ];
    }
}
