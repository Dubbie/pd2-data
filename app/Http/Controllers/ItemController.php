<?php

namespace App\Http\Controllers;

use App\Models\BaseItem;
use App\Models\UniqueItem;
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

    public function uniqueItems()
    {
        return Inertia::render('Item/Unique/Index');
    }

    public function showUniqueItem(UniqueItem $item)
    {
        return Inertia::render('Item/Unique/Show', [
            'item' => $item
        ]);
    }
}
