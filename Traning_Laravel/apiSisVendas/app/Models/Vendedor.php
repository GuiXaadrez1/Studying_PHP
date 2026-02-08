<?php

namespace App\Models;

use App\Models\Admin;
use App\Models\Venda;

use Laravel\Sanctum\HasApiTokens;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

use Illuminate\Database\Eloquent\Model;

class Vendedor extends Model
{
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

    public function administrador()
    {
        return $this->belongsTo(Admin::class, 'idadmin', 'idadmin');
    }

    public function vendas()
    {
        return $this->hasMany(Venda::class, 'idvendedor', 'idvendedor');
    }
}
