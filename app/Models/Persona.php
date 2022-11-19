<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Persona extends Model
{
    use HasFactory;

    protected $fillable = [
        'tipo_documento_id', 'numero_documento', 'nombres', 'apellido_paterno',' apellido_materno',
        'sexo_id', 'direccion', 'telefono'
    ];

    public function apellidos_nombres() :Attribute
    {
        return Attribute::make(
            get: fn($value,$attributes) => strtoupper($attributes['apellido_paterno'])." ".
                                            strtoupper($attributes['apellido_materno'])." ".
                                            strtoupper($attributes['nombres']),
            set: fn($value) => $value,

        );
    }
    /**
     * Get the sexo that owns the Persona
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function sexo(): BelongsTo
    {
        return $this->belongsTo(Sexo::class);
    }

    /**
     * Get the tipo_documento that owns the Persona
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function tipo_documento(): BelongsTo
    {
        return $this->belongsTo(TipoDocumento::class);
    }

    /**
     * Get the user associated with the Persona
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function user(): HasOne
    {
        return $this->hasOne(User::class);
    }

    /**
     * Get the participante associated with the Persona
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function participante(): HasOne
    {
        return $this->hasOne(Participante::class);
    }
}
