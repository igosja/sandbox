<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class AbstractModel
 * @package App\Models
 */
class AbstractModel extends Model
{
    /**
     * @var string $dateFormat
     */
    protected $dateFormat = 'U';
}
