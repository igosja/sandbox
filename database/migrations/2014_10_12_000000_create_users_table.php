<?php

declare(strict_types=1);

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * @return void
     */
    public function up(): void
    {
        Schema::create(
            app(User::class)->getTable(),
            function (Blueprint $table) {
                $table->id();
                $table->unsignedInteger('created_at');
                $table->string('login')->unique();
                $table->string('password');
                $table->rememberToken();
                $table->unsignedInteger('updated_at');
            }
        );

        User::create([
            'login' => 'igosja',
            'password' => Hash::make('gfhjkm'),
        ]);
    }

    /**
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists(app(User::class)->getTable());
    }
};
