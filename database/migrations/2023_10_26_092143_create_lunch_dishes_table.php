<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    private const TABLE = 'lunch_dishes';

    /**
     * @return void
     */
    public function up(): void
    {
        Schema::create(
            self::TABLE,
            static function (Blueprint $table) {
                $table->id();
                $table->bigInteger('category_id')->unsigned();
                $table->unsignedInteger('created_at');
                $table->boolean('is_active')->default(false);
                $table->boolean('is_favorite')->default(false);
                $table->boolean('is_ordered')->default(false);
                $table->string('name')->unique();
                $table->unsignedInteger('updated_at');
            }
        );

        Schema::table(
            self::TABLE,
            static function (Blueprint $table) {
                $table->foreign('category_id')->references('id')->on('lunch_categories');
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
