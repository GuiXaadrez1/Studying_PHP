<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\Admin;
use App\Models\Vendedor;
use App\Models\Categoria;

use Illuminate\Database\Eloquent\Relations\HasMany;

class Produtos extends Model
{
    // nome da tabela

    protected $table = 'produto';

    // chave primária
    protected $primaryKey = 'idproduto';

    // tipo de chave primária
    protected $keyType = "int";

    // indicando se é auto-increment/serial ou genereted alwyas as primary key
    public $incrementing = true;

    // Laravel NÃO vai procurar created_at / updated_at
    public $timestamps = false;

    protected $fillable = [
        'nome',
        'qtd',
        'preco',
    ];

    protected $casts = [
        'dthinsert' => 'datetime',
        'dthdelete' => 'datetime',
        'statusdelete' => 'boolean',
    ];
    
    public function administrador()
    {
        return $this->belongsTo(Admin::class, 'idadmin', 'idadmin');
    }

    public function categorias()
    {
        return $this->belongsTo(Categoria::class, 'idcategoria', 'idcategoria');
    }

    public function vendedores()
    {
        return $this->belongsTo(Vendedor::class, 'idvendedor', 'idvendedor');
    }

    public function vendas()
    {
        return $this->hasMany(Venda::class, 'idproduto', 'idproduto');
    }
}
