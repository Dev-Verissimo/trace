<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Despacho extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'despachos';
    protected $fillable = [
        'localDestino_id',
        'userRequest_id',
        'userSend_id',
        'solicitacao_id',
        'mensagem',
        'status'
    ];

    public function local()
    {
        return $this->belongsTo(Local::class, 'localDestino_id');
    }
    public function userRequest()
    {
        return $this->belongsTo(User::class, 'userRequest_id');
    }
    public function userSend()
    {
        return $this->belongsTo(User::class, 'userSend_id');
    }
    public function solicitacao()
    {
        return $this->belongsTo(Solicitacao::class, 'solicitacao_id');
    }

    public function equi_despachos()
    {
        return $this->hasMany(EquipDespacho::class);
    }

   /* public function equipamentosDespacho()
    {
        return $this->hasMany()
    }*/
}
