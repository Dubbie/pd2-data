<?php

namespace App\Models;

use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class ItemAttributes
{
    protected $attributes = [];
    protected $category;

    public function __construct(string $category, array $attributes = [])
    {
        $this->category = $category;
        $this->attributes = $this->filterNullValues($attributes);
    }

    // Define the schema for each category (you can extend or modify this as needed)
    public static function getAttributeSchema(): array
    {
        return [
            'common' => [
                'required_attributes' => [
                    'strength' => 'integer',
                    'dexterity' => 'integer',
                    'level' => 'integer',
                ],
                'speed' => 'integer'
            ],
            'Weapon' => [
                'damage' => [
                    'one_handed' => [
                        'min' => 'integer',
                        'max' => 'integer',
                    ],
                    'two_handed' => [
                        'min' => 'integer',
                        'max' => 'integer',
                    ],
                    'throwing' => [
                        'min' => 'integer',
                        'max' => 'integer',
                    ],
                ],
                'range' => 'integer',
                'bonuses' => [
                    'strength' => 'integer',
                    'dexterity' => 'integer'
                ],
                'weapon_class' => 'string',
                'two_handed_weapon_class' => 'string',
                'is_two_handed' => 'boolean',
                'is_one_or_two_handed' => 'boolean',
            ],
            'Armor' => [
                'defense' => [
                    'base' => 'integer',
                    'max' => 'integer',
                ],
            ],
        ];
    }

    // Generate validation rules dynamically based on the category
    public function generateValidationRules(): array
    {
        $schema = self::getAttributeSchema();
        $rules = [];

        // Common rules
        foreach ($schema['common']['required_attributes'] as $key => $type) {
            $rules["$key"] = $type === 'array' ? 'array' : "$type|nullable";
        }

        // Category-specific rules
        if (isset($schema[$this->category])) {
            foreach ($schema[$this->category] as $key => $value) {
                if (is_array($value)) {
                    // Nested arrays (like 'damage' and 'bonuses')
                    foreach ($value as $nestedKey => $nestedValue) {
                        $rules["$key.$nestedKey"] = is_array($nestedValue)
                            ? 'array'
                            : (is_string($nestedValue) ? $nestedValue : 'nullable');
                    }
                } else {
                    $rules["$key"] = is_string($value) ? "$value|nullable" : 'nullable';
                }
            }
        }

        return $rules;
    }

    // Validate the attributes based on the generated rules
    public function validate(): void
    {
        $rules = $this->generateValidationRules();
        $validator = Validator::make($this->attributes, $rules);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }
    }

    // Get a specific attribute or all attributes
    public function get(string $key = null)
    {
        if ($key) {
            return $this->attributes[$key] ?? null;
        }

        return $this->attributes;
    }

    // Merge with defaults if needed
    public function mergeWithDefaults(): void
    {
        $schema = self::getAttributeSchema();
        // Merge common defaults first
        $defaults = $schema['common'];

        // Merge category-specific defaults
        if (isset($schema[$this->category])) {
            foreach ($schema[$this->category] as $key => $value) {
                if (is_array($value)) {
                    // If the value is an array (like 'damage'), we need to merge it recursively
                    if (isset($this->attributes[$key]) && is_array($this->attributes[$key])) {
                        // Merge existing values with the default structure
                        $this->attributes[$key] = array_merge_recursive($value, $this->attributes[$key]);
                    } else {
                        $this->attributes[$key] = $value; // Set default value if not set
                    }
                } else {
                    // Otherwise just set the default value
                    $this->attributes[$key] = $this->attributes[$key] ?? $value;
                }
            }
        }

        // Merge with existing attributes
        $this->attributes = array_merge($defaults, $this->attributes);
    }


    protected function filterNullValues(array $attributes)
    {
        return array_map(function ($value) {
            // If the value is an array, recursively filter it
            if (is_array($value)) {
                $filtered = $this->filterNullValues($value);

                // Remove empty arrays or arrays where all values are null
                return (empty($filtered) || $this->isArrayOnlyNull($filtered)) ? null : $filtered;
            }

            // If the value is null, remove it
            return $value !== null ? $value : null;
        }, array_filter($attributes, function ($value) {
            // Keep only values that are not null, empty arrays, or arrays with all null values
            return $value !== null && !(is_array($value) && $this->isArrayOnlyNull($value));
        }));
    }

    // Helper function to check if an array contains only null values
    protected function isArrayOnlyNull(array $array): bool
    {
        return !array_filter($array, function ($value) {
            return $value !== null;
        });
    }
}
