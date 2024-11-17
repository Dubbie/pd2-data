<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BaseItem extends Model
{
    public const CATEGORY_ARMOR = 'Armor';
    public const CATEGORY_WEAPON = 'Weapon';
    public const CATEGORY_MISC = 'Misc';

    public $timestamps = false;

    protected $fillable = [
        'name',
        'name_code',
        'code',
        'type',
        'type2',
        'rarity',
        'level',
        'magic_level',
        'auto_prefix',
        'normal_code',
        'exceptional_code',
        'elite_code',
        'inventory_width',
        'inventory_height',
        'inventory_image',
        'unique_image',
        'set_image',
        'has_sockets',
        'socket_count',
        'socket_apply_type',
        'is_unique_only',
        'skip_name',
        'attributes',
        'category',
    ];

    protected $casts = [
        'is_unique_only' => 'bool',
        'skip_name' => 'bool',
        'attributes' => 'array'
    ];

    // Accessor for attributes field
    public function getAttributesAttribute($value)
    {
        // Decode the value from JSON (if it's stored as a JSON string)
        $decodedValue = json_decode($value, true) ?? [];

        // Create an ItemAttributes instance
        $itemAttributes = new ItemAttributes($this->category, $decodedValue);

        // Return the attributes as an array or another appropriate format
        return $itemAttributes->get(); // Return as array
    }

    // Mutator for attributes field
    public function setAttributesAttribute($value)
    {
        if ($value instanceof ItemAttributes) {
            $this->attributes['attributes'] = json_encode($value->get());
        } else if (is_null($value)) {
            $this->attributes['attributes'] = json_encode([]); // Handle null case gracefully
        } else {
            // Handle invalid type or other cases as needed
            $this->attributes['attributes'] = json_encode([]);
        }
    }
}
