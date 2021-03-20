<?php

namespace PDMFC\NovaNotesField;

use Laravel\Nova\Fields\Field;

class NovaNotesField extends Field
{
    /**
     * The field's component.
     *
     * @var string
     */
    public $component = 'nova-notes-field';

    public function __construct($name, $attribute = null, callable $resolveCallback = null)
    {
        parent::__construct($name, $attribute, $resolveCallback);

        $this->displayCallback = static function ($value, $resource, $attribute) {
            return $resource->notes_count ?? 0;
        };
    }
}
