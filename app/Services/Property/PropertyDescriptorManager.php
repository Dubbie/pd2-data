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
        $modifiers = [];

        foreach ($descriptors as $descriptor) {
            $processor = new PropertyDescriptorProcessor($descriptor, $this->statProcessor);
            $processedStats = $processor->process();

            $groupingHandler = new StatGroupingHandler();
            $groupedStats = $groupingHandler->group($processedStats);

            foreach ($groupedStats as $statGroup) {
                $modifiers[] = $statGroup;
            }
        }

        return $modifiers;
    }
}
