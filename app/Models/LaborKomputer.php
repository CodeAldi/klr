<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class LaborKomputer extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $table = 'labor_komputer';

    /**
     * Get all of the assignment for the LaborKomputer
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function assignment(): HasMany
    {
        return $this->hasMany(AssignmentUser::class);
    }
}
