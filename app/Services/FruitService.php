<?php

namespace App\Services;

use App\Models\Fruit;
use Illuminate\Support\Facades\Http;

class FruitService
{
    public function getFruitsFromDb(): object
    {
        return Fruit::with('children')->whereNull('parent_id')->get();
    }

    public function updateFruitFromJson(): void
    {
        $url = 'https://dev.shepherds-mountain.appoly.io/fruit.json';

        try {
            $response = Http::get($url);

            if ($response->failed()) {
                return;
            } else {
                $fruits = $response['menu_items'];

                foreach ($fruits as $fruit) {
                    $this->saveFruit($fruit);
                }
            }
        } catch (\Exception $exception) {
            print_r($exception->getCode());

            return;
        }
    }

    private function saveFruit($fruit, $parentId = null)
    {
        // Create a unique ID for the fruit
        $uniqueId = $fruit['label'] . '-' . $parentId;

        // Save the current fruit
        $newFruit = Fruit::updateOrCreate(
            ['label' => $fruit['label'], 'parent_id' => $parentId, 'unique_id' => $uniqueId],
        );

        // Recursively save children
        if (isset($fruit['children']) && is_array($fruit['children'])) {
            foreach ($fruit['children'] as $child) {
                $this->saveFruit($child, $newFruit->id);
            }
        }
    }
}
