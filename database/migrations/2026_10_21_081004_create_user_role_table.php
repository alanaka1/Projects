<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('user_role', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('role_id');
 
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('role_id')->references('id')->on('roles');
            // $table->timestamps();
        });

        DB::table('user_role')->insert(
            array([
                'user_id'       => 1,
                'role_id'       => 1,
                // 'created_at'    => now(),
                // 'updated_at'    => now(),
            ],[
                'user_id'   => 2,
                'role_id'   => 2,
            ],[
                'user_id'   => 2,
                'role_id'   => 4,
            ]),
        );
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_role');
    }
};
