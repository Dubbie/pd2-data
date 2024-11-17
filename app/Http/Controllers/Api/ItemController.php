<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\BaseItem;
use App\Models\UniqueItem;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    public function index(Request $request)
    {
        $data = $request->validate([
            'category' => 'nullable',
            'query'
        ]);

        $query = BaseItem::query();

        if (isset($data['query'])) {
            $query = $query->where('name', 'like', '%' . $data['query'] . '%');
        }

        return response()->json($query->get());
    }

    public function uniqueIndex(Request $request)
    {
        $data = $request->validate([
            'category' => 'nullable',
            'query'
        ]);

        $query = UniqueItem::query();

        if (isset($data['query'])) {
            $query = $query->where('name', 'like', '%' . $data['query'] . '%');
        }

        return response()->json($query->get());
    }
}
