<?php

declare(strict_types=1);

namespace App\Console\Commands;

use App\Models\PersonalAccessToken;

/**
 * Class PruneExpired
 * @package App\Console\Commands
 */
class PruneExpired extends \Laravel\Sanctum\Console\Commands\PruneExpired
{
    /**
     * @return int
     */
    public function handle(): int
    {
        /**
         * @var PersonalAccessToken $model
         */
        $model = PersonalAccessToken::class;

        /**
         * @var int $hours
         */
        $hours = $this->option('hours');

        $this->components->task(
            'Pruning tokens with expired expires_at timestamps',
            fn() => $model::where('expires_at', '<', now()->subHours($hours)->unix())->delete()
        );

        if ($expiration = config('sanctum.expiration')) {
            $this->components->task(
                'Pruning tokens with expired expiration value based on configuration file',
                fn() => $model::where(
                    'created_at',
                    '<',
                    now()->subMinutes($expiration + ($hours * 60))->unix()
                )->delete()
            );
        } else {
            $this->components->warn('Expiration value not specified in configuration file.');
        }

        $this->components->info("Tokens expired for more than [$hours hours] pruned successfully.");

        return 0;
    }
}
