<?php

namespace App\Http\Controllers;

use App\Models\Property;
use Inertia\Inertia;

class PropertyController extends Controller
{
    public function index()
    {
        return Inertia::render('Property/Index', [
            'properties' => Property::all()
        ]);
    }
}
