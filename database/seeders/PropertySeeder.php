<?php

namespace Database\Seeders;

use App\Models\Property;
use App\Models\Stat;

class PropertySeeder extends FromFileSeeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Property::query()->delete();

        $entries = $this->readFile('app/Properties.txt');

        $this->createEntries($entries);
    }

    private function createEntries(array $entries)
    {
        $created = 0;
        foreach ($entries as $entry) {
            $raw = [
                'code' => $this->getActualValue($entry['code']),
                'is_done' => $this->getActualValue($entry['*done'], true)
            ];

            $property = Property::create($raw);

            // Create the property stats
            for ($i = 1; $i <= Property::MAX_STATS; $i++) {
                if (!$this->getActualValue($entry["func$i"])) {
                    continue;
                }

                $rawPropertyStat = [
                    'set_stat' => $this->getActualValue($entry["set$i"]),
                    'value' => $this->getActualValue($entry["val$i"]),
                    'function' => $this->getActualValue($entry["func$i"]),
                    'stat_name' => $this->getActualValue($entry["stat$i"]),
                ];

                // Check if stat exists, if not, skip it
                if ($rawPropertyStat['stat_name'] !== null && !Stat::find($rawPropertyStat['stat_name'])) {
                    $this->command->info("Stat " . $rawPropertyStat['stat_name'] . " not found, skipping.");
                    continue;
                }

                $property->propertyStats()->create($rawPropertyStat);
            }

            $created++;
        }

        $this->command->info(sprintf('Created %d property records.', $created));
    }
}
