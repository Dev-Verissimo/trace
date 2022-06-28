<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EquipDespacho extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = "equi_solicitados_despacho";
    protected $fillable = [
        "despacho_id",
        "unidade_id"
    ];

    public function despacho()
    {
        return $this->belongsTo(Despacho::class, 'despacho_id');
    }

    public function unidade()
    {
        return $this->belongsTo(Unidade::class);
    }
    public function uni()
    {
        return $this->hasMany(Unidade::class);
    }
}
