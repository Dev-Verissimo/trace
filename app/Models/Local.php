<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Local extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'locais';
    protected $fillable = [
        'nome',
        'descricao',
        'endereco',
        'tipo',
        'status',
        'status_auto'
    ];
}

