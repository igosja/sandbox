<?php

declare(strict_types=1);

namespace App\Http\Resources\Lunch;

use App\Http\Resources\AbstractResource;

/**
 * Class DishResource
 * @package App\Http\Resources\Lunch
 */
class DishResource extends AbstractResource
{
    /**
     * @var array $fields
     */
    protected array $fields = [
        'id',
        'category_id',
        'created_at',
        'is_active',
        'is_favorite',
        'is_ordered',
        'name',
        'updated_at',
    ];

    /**
     * @var array $extraFields
     */
    protected array $extraFields = [
        'category',
    ];
}
