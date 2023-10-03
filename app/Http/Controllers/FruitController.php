<?php

namespace App\Http\Controllers;

use App\Models\Fruit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class FruitController extends Controller
{
    public function index()
    {
        $fruits = Fruit::with('children')->whereNull('parent_id')->get();

        if ($fruits->isEmpty()) {
            $this->updateFruitFromJson();
            $fruits = Fruit::with('children')->whereNull('parent_id')->get();
        }

        return view('fruits.index', compact('fruits'));
    }

    public function updateFruitFromJson(): void
    {
        $fruits = Http::get('https://dev.shepherds-mountain.appoly.io/fruit.json')['menu_items'];

        foreach ($fruits as $fruit) {
            $this->saveFruit($fruit);
        }
    }

    private function saveFruit($data, $parentId = null)
    {
        // Save the current fruit
        $fruit = Fruit::updateOrCreate(
            ['label' => $data['label'], 'parent_id' => $parentId],
        );

        // Recursively save children
        if (isset($data['children']) && is_array($data['children'])) {
            foreach ($data['children'] as $child) {
                $this->saveFruit($child, $fruit->id);
            }
        }
    }
}
