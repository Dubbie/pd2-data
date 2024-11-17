<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class ItemController extends Controller
{
    public function baseItems()
    {
        return Inertia::render('Item/Base/Index');
    }
}
