<?php

namespace App\Services\Property;

use App\Models\BaseItem;
use Illuminate\Database\Eloquent\Collection;

class PropertyDescriptorManager
{
    protected PropertyStatProcessor $statProcessor;

    public function __construct(PropertyStatProcessor $propertyStatProcessor)
    {
        $this->statProcessor = $propertyStatProcessor;
    }

    public function processItem(BaseItem $baseItem, Collection $descriptors)
    {
        $d2stats = [];

        foreach ($descriptors as $descriptor) {
            $processor = new PropertyDescriptorProcessor($descriptor, $this->statProcessor);
            $processedStats = $processor->process();

            foreach ($processedStats as $d2stat) {
                if ($d2stat) {
                    $d2stats[] = $d2stat;
                }
            }
        }

        $modifiers = [];

        $groupingHandler = new StatGroupingHandler();
        $groupedStats = $groupingHandler->group($d2stats);

        foreach ($groupedStats as $statGroup) {
            $modifiers[] = $statGroup;
        }

        return $modifiers;
    }
}
