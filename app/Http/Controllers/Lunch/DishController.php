<?php

declare(strict_types=1);

namespace App\Http\Controllers\Lunch;

use App\Http\Controllers\AbstractController;
use App\Http\Requests\Lunch\Dish\IndexRequest;
use App\Http\Requests\Lunch\Dish\UpdateRequest;
use App\Http\Resources\Lunch\DishResource;
use App\Models\Lunch\Category;
use App\Models\Lunch\Dish;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

/**
 * Class DishController
 * @package App\Http\Controllers\Lunch
 */
class DishController extends AbstractController
{
    /**
     * @return AnonymousResourceCollection
     */
    public function index(IndexRequest $request): AnonymousResourceCollection
    {
        $sortingField = 'id';
        $sortingOrder = 'desc';
        $sorting = $request->validated('sorting');
        if ($sorting) {
            if ('-' != $sorting[0]) {
                $sortingOrder = 'asc';
            } else {
                $sorting = substr($sorting, 1);
            }
            $sortingField = $sorting;
        }


        $dishes = Dish::orderBy('is_ordered', 'asc')
            ->orderBy($sortingField, $sortingOrder)
            ->where('is_active', true)
            ->whereIn('category_id', Category::select('id')->where('is_active', true));
        if ($request->validated('filters.id')) {
            $dishes = $dishes->where('id', $request->validated('filters.id'));
        }
        if ($request->validated('filters.name')) {
            $dishes = $dishes->where('name', 'like', '%' . $request->validated('filters.name') . '%');
        }
        $dishes = $dishes->paginate();

        return DishResource::collection($dishes);
    }

    /**
     * @param Dish $dish
     * @return DishResource
     */
    public function show(Dish $dish): DishResource
    {
        return new DishResource($dish);
    }

    /**
     * @param UpdateRequest $request
     * @param Dish $dish
     * @return DishResource
     */
    public function update(UpdateRequest $request, Dish $dish): DishResource
    {
        $dish->update($request->validated());
        return new DishResource($dish);
    }
}
