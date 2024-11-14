<?php

namespace Database\Seeders;

use App\Models\Stat;

class StatSeeder extends FromFileSeeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Stat::query()->delete();

        $entries = $this->readFile('app/ItemStatCost.txt');

        $this->createEntries($entries);
    }

    private function createEntries(array $entries)
    {
        $created = 0;
        foreach ($entries as $entry) {
            $raw = [
                'name' => $this->getActualValue($entry['Stat']),
                'id' => $this->getActualValue($entry['ID']),
                'val_shift' => $this->getActualValue($entry['ValShift']),
                'f_min' => $this->getActualValue($entry['fMin']) === 1,
                'min_accr' => $this->getActualValue($entry['MinAccr']),
                'is_direct' => $this->getActualValue($entry['direct']) === 1,
                'max_stat' => $this->getActualValue($entry['maxstat'])
            ];

            $stat = Stat::create($raw);

            $rawDesc = [
                'priority' => $this->getActualValue($entry['descpriority']) ?? 0,
                'function' => $this->getActualValue($entry['descfunc']),
                'value' => $this->getActualValue($entry['descval']) ?? 1,
                'positive_code' => $this->getActualValue($entry['descstrpos']),
                'negative_code' => $this->getActualValue($entry['descstrneg']),
                'extra_code' => $this->getActualValue($entry['descstr2']),
                'group' => $this->getActualValue($entry['dgrp']),
                'group_function' => $this->getActualValue($entry['dgrpfunc']),
                'group_value' => $this->getActualValue($entry['dgrpval']),
                'group_positive_code' => $this->getActualValue($entry['dgrpstrpos']),
                'group_negative_code' => $this->getActualValue($entry['dgrpstrneg']),
                'group_extra_code' => $this->getActualValue($entry['dgrpstr2']),
            ];

            // Translate stuff
            $rawDesc['positive'] = $this->getTranslatedValue($rawDesc['positive_code']);
            $rawDesc['negative'] = $this->getTranslatedValue($rawDesc['negative_code']);
            $rawDesc['extra'] = $this->getTranslatedValue($rawDesc['extra_code']);
            $rawDesc['group_positive'] = $this->getTranslatedValue($rawDesc['group_positive_code']);
            $rawDesc['group_negative'] = $this->getTranslatedValue($rawDesc['group_negative_code']);
            $rawDesc['group_extra'] = $this->getTranslatedValue($rawDesc['group_extra_code']);

            if ($rawDesc['function']) {
                $stat->description()->create($rawDesc);
            }


            $created++;
        }

        $this->command->info(sprintf('Created %d stat records.', $created));
    }
}
