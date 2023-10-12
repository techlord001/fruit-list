<?php

namespace App\Http\Controllers;

use App\Models\Fruit;
use App\Services\FruitService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class FruitController extends Controller
{
    protected $fruitService;

    public function __construct(FruitService $fruitService)
    {
        $this->fruitService = $fruitService;
    }

    public function index()
    {
        $fruits = Cache::remember('fruits', 60, function () {
            return $this->fruitService->getFruitsFromDb();
        });

        if ($fruits->isEmpty()) {
            $this->fruitService->updateFruitFromJson();
            Cache::put('fruits', $this->fruitService->getFruitsFromDb(), 60);
        }

        $fruits = $fruits->sortBy('label');

        return view('fruits.index', compact('fruits'));
    }

    public function edit($id)
    {
        $fruit = Fruit::findOrFail($id);
        return view('fruits.edit', compact('fruit'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'label' => 'required|string|max:255',
        ]);

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
}
