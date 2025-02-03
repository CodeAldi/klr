<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pemakaian extends Model
{
    use HasFactory;
    protected $table = 'pemakaian';
    protected $guarded = ['id'];

    /**
     * Get the user that owns the Pemakaian
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    /**
     * Get the labor that owns the Pemakaian
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function labor(): BelongsTo
    {
        return $this->belongsTo(LaborKomputer::class, 'labor_komputer_id');
    }
    /**
     * Get the komputer that owns the Pemakaian
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function komputer(): BelongsTo
    {
        return $this->belongsTo(Komputer::class, 'komputer_id');
    }
}
