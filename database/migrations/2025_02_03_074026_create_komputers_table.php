<?php

use App\Models\LaborKomputer;
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
        Schema::create('komputer', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->foreignIdFor(LaborKomputer::class,'labor_komputer_id')->constrained('labor_komputer')->onUpdate('cascade')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('komputer');
    }
};
