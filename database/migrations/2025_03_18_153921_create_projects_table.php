<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\User;
use App\Models\Clients;
use App\Models\ClientContact;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->integer('project_id')->id();
            $table->string('project_name');
            $table->string('project_description');
            $table->foreignIdFor(Clients::class);
            $table->foreignIdFor(ClientContact::class);
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
        Schema::dropIfExists('projects');
    }
};
