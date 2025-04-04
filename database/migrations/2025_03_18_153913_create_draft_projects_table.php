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
        Schema::create('projects_draft', function (Blueprint $table) {
            $table->increments('project_id')->id();
            $table->string('project_name');
            $table->string('project_description');
            $table->string('project_client_name');
            $table->date('project_start_date')->nullable();
            $table->date('project_target_date')->nullable();
            $table->date('project_end_date')->nullable();
            $table->string('project_state');
            $table->foreignIdFor(User::class);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects_draft');
    }
};
