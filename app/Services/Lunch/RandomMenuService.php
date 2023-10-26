<?php

declare(strict_types=1);

namespace App\Services\Lunch;

use App\Models\Lunch\Category;
use App\Models\Lunch\Dish;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class RandomMenuService
 * @package App\Services\Lunch
 */
class RandomMenuService
{
    private const LIMIT = 5;

    /**
     * @var Collection $categories
     */
    private Collection $categories;

    /**
     * @var Category|null $category
     */
    private ?Category $category = null;

    /**
     * @var array $menu
     */
    private array $menu = [];

    /**
     * @return array
     */
    public function getRandomMenu(): array
    {
        $this->prepareMenu();

        return $this->menu;
    }

    /**
     * @return void
     */
    private function prepareMenu(): void
    {
        $this->loadCategories();

        foreach ($this->categories as $category) {
            $this->category = $category;

            $this->getMealsForCategory();
        }
    }

    /**
     * @return void
     */
    private function loadCategories(): void
    {
        $this->categories = Category::query()
            ->where('is_active', true)
            ->get();
    }

    /**
     * @return void
     */
    private function getMealsForCategory(): void
    {
        $this->menu[$this->category->id] = [];

        $this->getNewMealsForCategory();

        if (count($this->menu[$this->category->id]) < self::LIMIT) {
            $this->getFavoriteMealsForCategory();
        }

        if (count($this->menu[$this->category->id]) < self::LIMIT) {
            $this->fillMealsToLimit();
        }
    }

    /**
     * @return void
     */
    private function getNewMealsForCategory(): void
    {
        /**
         * @var Dish[] $dishes
         */
        $dishes = Dish::query()
            ->where([
                'category_id' => $this->category->id,
                'is_active' => true,
                'is_ordered' => false,
            ])
            ->inRandomOrder()
            ->limit(self::LIMIT)
            ->get();
        foreach ($dishes as $dish) {
            $this->menu[$this->category->id][] = $dish->name . ' (новий)';
        }
    }

    /**
     * @return void
     */
    private function getFavoriteMealsForCategory(): void
    {
        /**
         * @var Dish[] $dishes
         */
        $dishes = Dish::query()
            ->where([
                'category_id' => $this->category->id,
                'is_active' => true,
                'is_favorite' => true,
            ])
            ->inRandomOrder()
            ->limit(self::LIMIT - count($this->menu[$this->category->id]))
            ->get();
        foreach ($dishes as $dish) {
            $this->menu[$this->category->id][] = $dish->name;
        }
    }

    /**
     * @param int $i
     * @return void
     */
    private function fillMealsToLimit(int $i = 0): void
    {
        $this->menu[$this->category->id][] = $this->menu[$this->category->id][$i];

        if (count($this->menu[$this->category->id]) < self::LIMIT) {
            $this->fillMealsToLimit($i + 1);
        }
    }
}
