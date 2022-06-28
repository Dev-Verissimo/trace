<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ArquivoEquipamento extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'equipamento_arquivos';
    protected $fillable = [
        'nome',
        'descricao',
        'path_arquivo',
        'equipamento_id',
    ];

    public function equipamento()
    {
        return $this->belongsTo(Equipamento::class, 'equipamento_id');
    }

    public function getArquivoDownAttribute()
    {
        return "../uploads/" . $this->path_arquivo;
    }
}
