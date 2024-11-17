<?php

namespace App\Services\Property\DescFunctionHandlers;

use App\Services\Property\D2Stat;
use App\Services\Property\D2StatKeys;
use Exception;

class DescFunction15Handler implements DescFunctionHandlerInterface
{
    // [chance]% to case [slvl] [skill] on [event]
    public function handle(D2Stat $d2stat): string
    {
        $chanceToProc = $d2stat->values[D2StatKeys::CHANCE_TO_PROC];
        $skillLevel = $d2stat->values[D2StatKeys::SKILL_LEVEL];
        $skillId = $d2stat->values[D2StatKeys::SKILL_ID];

        $value = $d2stat->stat->description->value;

        $template = "[value]% [string1]";
        switch ($value) {
            case 0:
                $template = "[string1]";
                break;
            default:
                throw new Exception("Desc Func 15 with value 1,2 not implemented.");
                break;
        }

        $string1 = $d2stat->stat->description->positive;
        $template = str_replace('[string1]', $string1, $template);

        // Replace value with stat's name
        $template = str_replace('[value]', '@' . $d2stat->stat->name . '@', $template);

        return $template;
    }
}
