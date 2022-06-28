<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Unidade extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = "unidades";
    protected $fillable = [
        'status',
        'tag',
        'equipamento_id',
        'local_id',
        'lote',
        'referencia',
        'numeronf',
        'valor',
        'data_validade',
        'data_fabricacao',
        'data_compra',
        'data_primeiro_uso',
        'data_ultima_inspecao',
        'data_proxima_inspecao',
        'id_user_ultima_inspecao',
    ];

    public function equipamento()
    {
        return $this->belongsTo(Equipamento::class, 'equipamento_id');
    }

    public function local()
    {
        return $this->belongsTo(Local::class, 'local_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user_ultima_inspecao');
    }

    public function inspecao()
    {
        return $this->hasMany(Inspecao::class);
    }

    public function setValorAttribute($value)
    {
        if (empty($value)) {
            $this->attributes['valor'] = null;
        } else {
            $this->attributes['valor'] = floatval($this->convertStringToDouble($value));
        }
    }

    public function getStatusStringAttribute()
    {
        $valor = $this->status;
        if ($valor == 1){
            return 'Aprovado';
        }elseif($valor == 2){
            return 'Reprovado';
        }elseif($valor == 2){
            return'Retirados de Uso';
        }else{
            return 'Em transito';
        }

    }

    public function getValorAttribute($value)
    {
        return number_format($value, 2, ',', '.');
    }

    public function getDiasDiffAttribute(){
        $dateStart = new \DateTime(date('Y-m-d', strtotime(date('Y-m-d'))));
        $dateNow   = new \DateTime(date('Y-m-d', strtotime($this->data_proxima_inspecao)));

        $dateDiff = $dateStart->diff($dateNow);

        return $dateDiff->days;
    }
    public function getTotalDiasDiffAttribute(){
        $dateStart = new \DateTime(date('Y-m-d', strtotime($this->data_ultima_inspecao)));
        $dateNow   = new \DateTime(date('Y-m-d', strtotime($this->data_proxima_inspecao)));

        $dateDiff = $dateStart->diff($dateNow);

        return $dateDiff->days;
    }


    private function convertStringToDouble($param)
    {
        if (empty($param)) {
            return null;
        }

        return str_replace(',', '.', str_replace('.', '', $param));
    }



}
