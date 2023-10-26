<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    private const TABLE = 'lunch_categories';

    /**
     * @return void
     */
    public function up(): void
    {
        Schema::create(
            self::TABLE,
            function (Blueprint $table) {
                $table->id();
                $table->unsignedInteger('created_at');
                $table->boolean('is_active')->default(false);
                $table->string('name')->unique();
                $table->unsignedInteger('updated_at');
            }
        );
    }

    /**
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists(self::TABLE);
    }
};
