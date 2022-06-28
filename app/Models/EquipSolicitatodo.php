<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EquipSolicitatodo extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'equip_solicitados';
    protected $fillable = [
        'solicitacao_id',
        'equipamento_id',
        'nome',
        'quantidade'
    ];

    public function equipamento()
    {
        return $this->belongsTo(Equipamento::class, 'equipamento_id');
    }

    public function solicitacao()
    {
        return $this->belongsTo(Solicitacao::class, 'solicitacao_id');
    }
}
