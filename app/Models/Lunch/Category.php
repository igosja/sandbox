<?php

declare(strict_types=1);

namespace App\Models\Lunch;

use App\Models\AbstractModel;

/**
 * Class Category
 * @package App\Models\Lunch
 *
 * @property int id
 * @property int created_at
 * @property bool is_active
 * @property string name
 * @property int updated_at
 */
class Category extends AbstractModel
{
    /**
     * @var string $table
     */
    protected $table = 'lunch_categories';

    /**
     * @var string[] $fillable
     */
    protected $fillable = [
        'is_active',
        'name',
    ];
}
