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

    public function edit($id)
    {
        $fruit = Fruit::findOrFail($id);
        return view('fruits.edit', compact('fruit'));
    }

    public function update(Request $request, $id)
    {
        $fruit = Fruit::findOrFail($id);
        $fruit->update($request->all());
        return redirect()->route('fruits.index');
    }

    public function destroy($id)
    {
        $fruit = Fruit::findOrFail($id);
        $fruit->delete();
        return redirect()->route('fruits.index');
    }

    public function updateFruitFromJson(): void
    {
        $fruits = Http::get('https://dev.shepherds-mountain.appoly.io/fruit.json')['menu_items'];

        foreach ($fruits as $fruit) {
            $this->saveFruit($fruit);
        }
    }

    private function saveFruit($fruit, $parentId = null)
    {
        // Save the current fruit
        $newFruit = Fruit::updateOrCreate(
            ['label' => $fruit['label'], 'parent_id' => $parentId],
        );

        // Recursively save children
        if (isset($fruit['children']) && is_array($fruit['children'])) {
            foreach ($fruit['children'] as $child) {
                $this->saveFruit($child, $newFruit->id);
            }
        }
    }
}
