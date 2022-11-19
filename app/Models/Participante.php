<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Participante extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'id', 'persona_id', 'deleted_at'
    ];
    /**
     * Get the persona that owns the Participante
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function persona(): BelongsTo
    {
        return $this->belongsTo(Persona::class);
    }
}
