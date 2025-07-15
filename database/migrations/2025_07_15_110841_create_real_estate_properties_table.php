<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('real_estate_properties', function (Blueprint $table) {
            $table->id();
            $table->string('name', 128);
            $table->enum('real_estate_type', [
                'house', 'land', 'department', 'commercial_ground'
            ]);
            $table->string('street', 128);
            $table->string('external_number', 12);
            $table->string('internal_number', 32)->nullable();
            $table->string('neighborhood', 128);
            $table->string('city', 64);
            $table->string('country', 2);
            $table->integer('rooms');
            $table->decimal('bathrooms', 4, 1);
            $table->string('comments', 128)->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('real_estate_properties');
    }
};

