<?php

namespace Database\Seeders;

use App\Models\BaseItem;
use App\Models\ItemAttributes;

class WeaponSeeder extends FromFileSeeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        BaseItem::where('category', BaseItem::CATEGORY_WEAPON)->delete();

        $entries = $this->readFile('app/Weapons.txt');
        $this->createEntries($entries);
    }

    private function createEntries(array $entries)
    {
        $created = 0;
        foreach ($entries as $entry) {
            $raw = [
                'name_code' => $this->getActualValue($entry['namestr']),
                'type' => $this->getActualValue($entry['type']),
                'type2' => $this->getActualValue($entry['type2']),
                'code' => $this->getActualValue($entry['code']),
                'rarity' => $this->getActualValue($entry['rarity']),
                'level' => $this->getActualValue($entry['level']),
                'magic_level' => $this->getActualValue($entry['magic lvl']),
                'auto_prefix' => $this->getActualValue($entry['auto prefix']),
                'normal_code' => $this->getActualValue($entry['normcode']),
                'exceptional_code' => $this->getActualValue($entry['ubercode']),
                'elite_code' => $this->getActualValue($entry['ultracode']),
                'inventory_width' => $this->getActualValue($entry['invwidth']),
                'inventory_height' => $this->getActualValue($entry['invheight']),
                'inventory_image' => $this->getActualValue($entry['invfile']),
                'unique_image' => $this->getActualValue($entry['uniqueinvfile']),
                'set_image' => $this->getActualValue($entry['setinvfile']),
                'has_sockets' => $this->getActualValue($entry['hasinv'], true),
                'socket_count'  => $this->getActualValue($entry['gemsockets']) ?? 0,
                'socket_apply_type' => $this->getActualValue($entry['gemapplytype']),
                'is_unique_only' => $this->getActualValue($entry['unique'], true),
                'skip_name' => $this->getActualValue($entry['SkipName'], true),
                'category' => BaseItem::CATEGORY_WEAPON,
            ];

            $attributes = new ItemAttributes($raw['category'], [
                'damage' => [
                    'one_handed' => [
                        'min' => $this->getActualValue($entry['mindam']),
                        'max' => $this->getActualValue($entry['maxdam']),
                    ],
                    'two_handed' => [
                        'min' => $this->getActualValue($entry['2handmindam']),
                        'max' => $this->getActualValue($entry['2handmaxdam']),
                    ],
                    'throwing' => [
                        'min' => $this->getActualValue($entry['minmisdam']),
                        'max' => $this->getActualValue($entry['maxmisdam']),
                    ],
                ],
                'required_attributes' => [
                    'strength' => $this->getActualValue($entry['reqstr']),
                    'dexterity' => $this->getActualValue($entry['reqdex']),
                    'level' => $this->getActualValue($entry['levelreq']),
                ],
                'bonuses' => [
                    'strength' => $this->getActualValue($entry['StrBonus']),
                    'dexterity' => $this->getActualValue($entry['DexBonus']),
                ],
                'speed' => $this->getActualValue($entry['speed']),
                'range' => $this->getActualValue($entry['rangeadder']),
                'is_two_handed' => $this->getActualValue($entry['2handed'], true),
                'is_one_or_two_handed' => $this->getActualValue($entry['1or2handed'], true),
            ]);

            // Translate the name
            $raw['name'] = $this->getTranslatedValue($raw['name_code']);

            // Add the attributes
            $raw['attributes'] = $attributes;

            $item = new BaseItem();
            $item->fill($raw);
            $item->save();

            $created++;
        }

        $this->command->info(sprintf('Created %d weapon records.', $created));
    }
}
