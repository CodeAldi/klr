<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AssignmentUser extends Model
{
    use HasFactory;
    protected $table = 'assignment_user';
    protected $guarded = ['id'];

    /**
     * Get the user that owns the AssignmentUser
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    /**
     * Get the labkom that owns the AssignmentUser
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function labkom(): BelongsTo
    {
        return $this->belongsTo(LaborKomputer::class,'labor_komputer_id');
    }
}
