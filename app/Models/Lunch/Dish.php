<?php

declare(strict_types=1);

namespace App\Models\Lunch;

use App\Models\AbstractModel;

/**
 * Class Dish
 * @package App\Models\Lunch
 *
 * @property int id
 * @property int category_id
 * @property int created_at
 * @property bool is_active
 * @property bool is_favorite
 * @property bool is_ordered
 * @property string name
 * @property int updated_at
 */
class Dish extends AbstractModel
{
    /**
     * @var string $table
     */
    protected $table = 'lunch_dishes';

    /**
     * @var string[] $fillable
     */
    protected $fillable = [
        'category_id',
        'is_favorite',
        'is_ordered',
        'name',
    ];
}
