<?php

use App\Models\LaborKomputer;
use App\Models\User;
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
        Schema::create('assignment_user', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class,'user_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->foreignIdFor(LaborKomputer::class, 'labor_komputer_id')->constrained('labor_komputer')->onUpdate('cascade')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assignment_user');
    }
};
