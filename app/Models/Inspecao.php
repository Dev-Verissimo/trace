<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Inspecao extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = "inspecoes";
    protected $fillable = [
        'observacao',
        'data_inspecao',
        'status',
        'imagem',
        'tipo',
        'user_id',
        'local_id',
        'unidade_id',
        'local_anterior_id',
        'depacho_id'
        ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function local()
    {
        return $this->belongsTo(Local::class, 'local_id');
    }
    public function unidade()
    {
        return $this->belongsTo(Unidade::class, 'unidade_id');
    }

    public function localAnterior()
    {
        return $this->belongsTo(Local::class, 'local_anterior_id');
    }
    public function despacho()
    {
        return $this->belongsTo(Despacho::class, 'depacho_id');
    }

    public function getStatusInspecaoAttribute()
    {
        $valor = $this->status;
        if ($valor == 1){
            return 'Aprovado';
        }
        if ($valor == 2){
            return 'Reprovado';
        }else{
             return'Retirados de Uso';
        }
    }

}
