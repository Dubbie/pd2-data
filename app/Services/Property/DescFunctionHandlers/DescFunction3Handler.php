<?php

namespace App\Services\Property\DescFunctionHandlers;

use App\Services\Property\D2Stat;
use App\Services\Property\D2StatKeys;

class DescFunction3Handler implements DescFunctionHandlerInterface
{
    // +[value]% [string1]
    public function handle(D2Stat $d2stat): string
    {
        $min = $d2stat->values[D2StatKeys::MIN];
        $isPositive = is_numeric($min) && $min > 0;
        $value = $d2stat->stat->description->value;
        $string1 = $isPositive ? $d2stat->stat->description->positive : $d2stat->stat->description->negative;

        $template = "+[value]% [string1]";
        switch ($value) {
            case 0:
                // Handle exception for item_mindamage_percent
                if ($d2stat->stat->name === 'item_mindamage_percent') {
                    $string1 = 'Enhanced Damage';
                    break;
                }

                $template = "[string1]";
                break;
            case 2:
                $template = "[string1] +[value]%";
                break;
            default:
                break;
        }

        $template = str_replace('[string1]', $string1, $template);

        // Replace value with stat's name
        $template = str_replace('[value]', '@' . $d2stat->stat->name . '@', $template);

        return $template;
    }
}
