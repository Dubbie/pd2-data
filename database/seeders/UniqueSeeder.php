<?php

namespace Database\Seeders;

use App\Models\BaseItem;
use App\Models\ItemAttributes;
use App\Models\UniqueItem;

class UniqueSeeder extends FromFileSeeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        UniqueItem::query()->delete();

        $entries = $this->readFile('app/UniqueItems.txt');
        $this->createEntries($entries);
    }

    private function createEntries(array $entries)
    {
        $created = 0;
        foreach ($entries as $entry) {
            $code = $this->getActualValue($entry['code']);
            $base = BaseItem::where('code', $code)->first();
            if (!$base) {
                $this->command->info("Code " . $code . " not found in bases, skipping.");
                continue;
            }

            $image = $this->getActualValue($entry['invfile']);
            if (!$image) {
                $image = $base->unique_image ?? $base->inventory_image;
            }

            $raw = [
                'base_item_id' => $base->id,
                'name_code' => $this->getActualValue($entry['index']),
                'rarity' => $this->getActualValue($entry['rarity']),
                'level' => $this->getActualValue($entry['lvl']),
                'code' => $code,
                'inventory_image' => $image
            ];

            $attributes = new ItemAttributes($base->category, [
                'required_attributes' => [
                    'level' => $this->getActualValue($entry['lvl req']),
                ],
            ]);

            // Translate the name
            $raw['name'] = $this->getTranslatedValue($raw['name_code']);

            // Add the attributes
            $raw['attribute_override'] = $attributes;

            $unique = UniqueItem::create($raw);

            // Add the property descriptors
            for ($i = 1; $i <= UniqueItem::MAX_PROPERTIES; $i++) {
                $propertyCode = $this->getActualValue($entry["prop$i"]);
                if (!$propertyCode) {
                    continue;
                }

                $rawPropertyDescriptor = [
                    'property_code' => str_replace('*', '', $propertyCode),
                    'param' => $this->getActualValue($entry["par$i"]),
                    'min' => $this->getActualValue($entry["min$i"]),
                    'max' => $this->getActualValue($entry["max$i"]),
                ];

                $unique->propertyDescriptors()->create($rawPropertyDescriptor);
            }

            $created++;
        }

        $this->command->info(sprintf('Created %d unique records.', $created));
    }
}
