<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Equipamento extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = "equipamentos";
    protected $fillable = [
        'categoria_id',
        'fabricante_id',
        'nome',
        'descricao',
        'imagem',
        'modelo',
        'fornecedor'
        ];



    public function categoria()
    {
        return $this->belongsTo(Categoria::class, 'categoria_id');
    }
    public function fabricante()
    {
        return $this->belongsTo(Fabricante::class, 'fabricante_id');
    }

    public function arquivo()
    {
        return $this->hasMany(ArquivoEquipamento::class, 'equipamento_id');
    }

    public function unidade()
    {
        return $this->hasMany(Unidade::class, 'equipamento_id');
    }
    public function getUrlImgAttribute()
    {
        if ($this->imagem ==null){
            return null;
        }
        return "../uploads/" . $this->imagem;
    }
}
