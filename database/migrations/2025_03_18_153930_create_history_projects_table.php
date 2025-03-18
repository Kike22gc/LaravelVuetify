<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\User;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('history_projects', function (Blueprint $table) {
            $table->integer('project_id')->id();
            $table->string('project_name');
            $table->string('project_client_name');
            $table->date('project_start_date')->nullable();
            $table->date('project_target_date')->nullable();
            $table->date('project_end_date')->nullable();
            $table->foreignIdFor(User::class);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('history_projects');
    }
};
