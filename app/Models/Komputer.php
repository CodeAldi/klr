<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Komputer extends Model
{
    use HasFactory;
    protected $table = 'komputer';
    protected $guarded = ['id'];
    
    /**
     * Get the labor that owns the Komputer
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function labor(): BelongsTo
    {
        return $this->belongsTo(LaborKomputer::class, 'labor_komputer_id');
    }
}
