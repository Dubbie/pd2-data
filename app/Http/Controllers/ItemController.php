<?php

namespace App\Http\Controllers;

use App\Models\BaseItem;
use Inertia\Inertia;

class ItemController extends Controller
{
    public function baseItems()
    {
        return Inertia::render('Item/Base/Index');
    }

    public function showBaseItem(BaseItem $item)
    {
        return Inertia::render('Item/Base/Show', [
            'item' => $item
        ]);
    }
}
