<?php

declare(strict_types=1);

namespace App\Models;

use Laravel\Sanctum\PersonalAccessToken as SanctumPersonalAccessToken;

/**
 * Class PersonalAccessToken
 * @package App\Models
 *
 * @property int id
 * @property string abilities
 * @property int created_at
 * @property int expires_at
 * @property int last_used_at
 * @property string name
 * @property string token
 * @property string tokenable_type
 * @property int tokenable_id
 * @property int updated_at
 */
class PersonalAccessToken extends SanctumPersonalAccessToken
{
    /**
     * @var string $dateFormat
     */
    protected $dateFormat = 'U';
}
