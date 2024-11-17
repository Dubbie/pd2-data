<?php

namespace App\Http\Controllers;

use App\Models\Stat;
use Inertia\Inertia;

class StatController extends Controller
{
    public function index()
    {
        return Inertia::render('Stat/Index', [
            'stats' => Stat::all()
        ]);
    }
}
