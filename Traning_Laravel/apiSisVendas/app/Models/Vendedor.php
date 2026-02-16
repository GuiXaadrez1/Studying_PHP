<?php

namespace App\Models;

use App\Models\Admin;
use App\Models\Venda;

use Laravel\Sanctum\HasApiTokens;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class Vendedor extends Authenticatable
{

    use HasApiTokens,Notifiable;

    // Protegendo guard na model para o sanctum identificar
    protected $guard = 'vendedor';

    protected $table = 'vendedor';

    protected $primaryKey = 'idvendedor';

    protected $keyType = 'int';

    public $incrementing = true;

    public $timestamps = false;

    protected $fillable =[
        'codfun',
        'nome',
        'email',
    ];

    protected $casts = [
        'dthinsert' => 'datetime',
        'dthdelete' => 'datetime',
        'statusdelete' => 'boolean',
    ];

     /**
     * Sobrescreve o método para o Sanctum saber qual valor 
     * salvar em 'tokenable_id'
     */
    // 1. Garante que o Sanctum pegue o valor correto para tokenable_id
    public function getKey()
    {
        return $this-> idvendedor;
    }

    // 2. Garante que o Eloquent saiba o nome da PK
    public function getKeyName()
    {
        return 'idvendedor';
    }

    public function getKeyType()
    {
        // Garante que o Laravel trate o ID como inteiro na hora de montar a query SQL
        return 'int';
    }

    // Se o seu banco for muito antigo e não aceitar datas no formato do Laravel 10/11
    protected $dateFormat = 'Y-m-d H:i:s';

    // Obtendo a senha do vendedor para o sanctum comparar com a senha digitada no login
    public function getAuthPassword()
    {
        return $this->codfun;
    }

    public function administrador()
    {
        return $this->belongsTo(Admin::class, 'idadmin', 'idadmin');
    }

    public function vendas()
    {
        return $this->hasMany(Venda::class, 'idvendedor', 'idvendedor');
    }
}
