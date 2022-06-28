<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Solicitacao extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'solicitacoes';
    protected $fillable = [
        'status',
        'data_criacao',
        'data_devolucao',
        'itens',
        'descricao',
        'local_id',
        'user_id',
    ];
    public function local()
    {
        return $this->belongsTo(Local::class, 'local_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function solicitacao()
    {
        return $this->hasMany(EquipSolicitatodo::class, 'solicitacao_id');
    }
    public function equipamentos()
    {
        return $this->hasMany(EquipSolicitatodo::class , 'solicitacao_id');
    }


}
