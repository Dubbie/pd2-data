<?php

namespace App\Services\Property;

class StatGroupingHandler
{
    private const GROUPS = [];

    public function group(array $processedStats)
    {
        $groups = [];
        $standalone = [];
        $modifiers = [];

        foreach ($processedStats as $d2stat) {
            if ($this->isGrouped($d2stat->stat->name)) {
                $groups[$this->getGroupKey($d2stat->stat->name)][] = $d2stat;
            } else {
                $standalone[] = $d2stat;
            }
        }

        // Handle groups
        // foreach ($groups as $groupName => $d2stats) {
        //   $modifiers[] = new D2Modifier($groupName, $d2stats, ,self::GROUPS[$groupName]['vars']);
        // }

        // Handle standalone
        foreach ($standalone as $d2stat) {
            $modifiers[] = new D2Modifier($d2stat->stat->name, [$d2stat], $d2stat->stat->description->priority);
        }

        // Order them
        usort($modifiers, function ($a, $b) {
            return $a->priority < $b->priority;
        });

        return $modifiers;
    }

    /**
     * Checks if the stat name belongs to a predefined group.
     *
     * @param string $statName
     * @return bool
     */
    protected function isGrouped($statName)
    {
        // Iterate over all groups to see if the stat name matches
        foreach (self::GROUPS as $group => $groupData) {
            if (in_array($statName, $groupData['stats'])) {
                return true;
            }
        }

        return false;
    }


    /**
     * Gets the group key for the given stat name.
     *
     * @param string $statName
     * @return string|null
     */
    protected function getGroupKey($statName)
    {
        // Iterate over groups to find the matching stat name and return the group key
        foreach (self::GROUPS as $group => $groupData) {
            if (in_array($statName, $groupData['stats'])) {
                return $group;
            }
        }

        // Return null if no group is found (this shouldn't happen if logic is correct)
        return null;
    }
}
