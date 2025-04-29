<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\User;
use App\Models\Clients;
use App\Models\ClientContact;
use App\Models\Companies;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('history_projects', function (Blueprint $table) {
            $table->increments('project_id')->id();
            $table->string('project_name');
            $table->string('project_description');
            $table->foreignIdFor(Companies::class);
            $table->foreignIdFor(Clients::class);
            $table->foreignIdFor(ClientContact::class);
            $table->dateTime('project_start_date')->nullable();
            $table->dateTime('project_target_date')->nullable();
            $table->dateTime('project_end_date')->nullable();
            $table->json('project_tasks');
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
        Schema::dropIfExists('history_projects');
    }
};
