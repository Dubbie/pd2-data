<?php

namespace App\Http\Controllers;

use App\Models\BaseItem;
use App\Models\UniqueItem;
use App\Services\Property\PropertyDescriptorManager;
use Inertia\Inertia;

class ItemController extends Controller
{
    protected PropertyDescriptorManager $manager;

    public function __construct(PropertyDescriptorManager $manager)
    {
        $this->manager = $manager;
    }

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
        $modifiers = $this->manager->processItem($item->baseItem, $item->propertyDescriptors);

        return Inertia::render('Item/Unique/Show', [
            'item' => $item,
            'modifiers' => $modifiers,
        ]);
    }
}
