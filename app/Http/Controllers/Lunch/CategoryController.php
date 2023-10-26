<?php

declare(strict_types=1);

namespace App\Http\Controllers\Lunch;

use App\Http\Controllers\AbstractController;
use App\Http\Requests\Lunch\Category\IndexRequest;
use App\Http\Requests\Lunch\Category\UpdateRequest;
use App\Models\Lunch\Category;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class CategoryController
 * @package App\Http\Controllers\Lunch
 */
class CategoryController extends AbstractController
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


        $categories = Category::orderBy($sortingField, $sortingOrder);
        if ($request->validated('filters.id')) {
            $categories = $categories->where('id', (int)$request->validated('filters.id'));
        }
        if ($request->validated('filters.name')) {
            $categories = $categories->where('name', 'like', '%' . $request->validated('filters.name') . '%');
        }
        $categories = $categories->paginate();

        return JsonResource::collection($categories);
    }

    /**
     * @param Category $category
     * @return JsonResource
     */
    public function show(Category $category): JsonResource
    {
        return new JsonResource($category);
    }

    /**
     * @param UpdateRequest $request
     * @param Category $category
     * @return JsonResource
     */
    public function update(UpdateRequest $request, Category $category): JsonResource
    {
        $category->update($request->validated());
        return new JsonResource($category);
    }
}
