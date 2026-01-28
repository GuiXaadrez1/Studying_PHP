<?php

namespace App\Models;

use App\Models\Vendedor;
use App\Models\Produtos;

use Illuminate\Database\Eloquent\Model;

class Venda extends Model
{
       protected $table = 'venda';

    protected $primaryKey = 'idvenda';

    protected $keyType = 'int';

    public $incrementing = true;

    public $timestamps = false;

    protected $fillable =[
        'preco',
        'qtd',
    ];

    protected $casts = [
        'dthinsert' => 'datetime',
        'dthdelete' => 'datetime',
        'statusdelete' => 'boolean',
    ];


    public function vendedores()
    {
        return $this->belongsTo(
            Vendedor::class,
            'idvendedor',
            'idvendedor',
        );
    }

    public function produtos()
    {
        return $this->belongsTo(Produtos::class, 'idproduto', 'idproduto');
    }
}
