<?php

namespace App\Models;

use App\Models\Admin;
use App\Models\Produtos;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    protected $table = 'categoria';

    protected $primaryKey = 'idcategoria';

    protected $keyType = 'int';

    public $incrementing = true;

    public $timestamps = false;

    protected $fillable = [
        'nome'
    ];

    protected $casts = [
        'dthinsert' => 'datetime',
        'dthdelete' => 'datetime',
        'statusdelete' => 'boolean',
    ];

    public function administrador()
    {
        return $this->belongsTo(
            Admin::class,
            'idadmin',
            'idadmin'
        );
    }

    public function produtos(){
        
        return $this->hasMany(
            Produtos::class,
            'idcategoria', // fk na tabela produtos
            'idcategoria' // pk local
        );
    }
}   
