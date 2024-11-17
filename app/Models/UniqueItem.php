<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UniqueItem extends Model
{
    public const MAX_PROPERTIES = 12;

    public $timestamps = false;

    protected $fillable = [
        'name',
        'name_code',
        'code',
        'rarity',
        'level',
        'attribute_override',
        'inventory_image',
    ];

    protected $casts = [
        'attribute_override' => 'json'
    ];

    protected $with = ['baseItem'];

    public function baseItem()
    {
        return $this->hasOne(BaseItem::class, 'id', 'base_item_id');
    }

    // Accessor for attributes field
    public function getAttributeOverrideAttribute($value)
    {
        // Decode the value from JSON (if it's stored as a JSON string)
        $decodedValue = json_decode($value, true) ?? [];

        // Create an ItemAttributes instance
        $itemAttributes = new ItemAttributes($this->baseItem->category, $decodedValue);

        // Return the attributes as an array or another appropriate format
        return $itemAttributes->get(); // Return as array
    }

    // Mutator for attributes field
    public function setAttributeOverrideAttribute($value)
    {
        if ($value instanceof ItemAttributes) {
            $this->attributes['attribute_override'] = json_encode($value->get());
        } else if (is_null($value)) {
            $this->attributes['attribute_override'] = json_encode([]); // Handle null case gracefully
        } else {
            // Handle invalid type or other cases as needed
            $this->attributes['attribute_override'] = json_encode([]);
        }
    }

    public function propertyDescriptors()
    {
        return $this->morphMany(PropertyDescriptor::class, 'describable');
    }
}
