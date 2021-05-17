<?php

namespace PDMFC\NovaNotesField;

use Illuminate\Database\Eloquent\Model;
use Laravel\Nova\Fields\Field;

class NovaNotesField extends Field
{
    /**
     * The field's component.
     *
     * @var string
     */
    public $component = 'nova-notes-field';

    /**
     * NovaNotesField constructor.
     * @param $name
     * @param null $attribute
     * @param callable|null $resolveCallback
     */
    public function __construct($name, $attribute = null, callable $resolveCallback = null)
    {
        parent::__construct($name, $attribute, $resolveCallback);

        $this->attribute = 'notes_count';
    }

    /**
     * Get additional meta information to merge with the element payload.
     *
     * @return array
     */
    public function meta(): array
    {
        /** @var Model $resource */
        if ($resource = $this->resource) {
            return array_merge(parent::meta(), [
                'resourceId' => $resource->getKey()
            ]);
        }

        return parent::meta();
    }
}
