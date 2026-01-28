<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\Produtos;
use App\Models\Categoria;
use App\Models\Vendedor;

class Admin extends Model
{

    // Esses atributos definidos desta maneira, serve para trabalhar com
    // banco de dados já criados 

    // É para adaptar o Eloquent à estrutura do banco existente,
    // não para o banco se adaptar ao Laravel.

    // nome da tabela
    protected $table = "administrador";

    // Chave primária real
    protected $primaryKey = 'idadmin';

    //Tipo da chave primária    
    protected $keyType = 'int';

    // indicando se é auto-increment/serial ou genereted alwyas as primary key
    public $incrementing = true;

    // Laravel NÃO vai procurar created_at / updated_at
    public $timestamps = false;
    
    // Campos da tabela que podem ser preenchidos em massa!
    /*protected $fillable = [
        'idadmin',
        'idadminfk',
        'codadmin',
        'nome',
        'email',
        'senha',
        'dthinsert',
        'dthdelete',
        'statusdelete',
    ];*/

    // Por questões de segurança
    // definimos apenas os método que podem ser modificados em massa
    // os que nao podem, deve ser modificados diretamente e explícitamente...
    // exemplo:
    /*
        $admin->senha = Hash::make($novaSenha);
        $admin->save()
    */
    // o $fillable só é usando quando se é passado um array inteiro para a Model
    // exemplo: $model->update($request->all()); ou Model::create($request->all());

    protected $fillable = [
        'codadmin',
        'nome',
        'email',
    ];

    // 7️⃣ (Opcional) Cast de tipos
    protected $casts = [
        'dthinsert' => 'datetime',
        'dthdelete' => 'datetime',
        'statusdelete' => 'boolean',
    ];
    
    // realizando relacionamento recursivo
    public function administrador(){
        
        // Um administrador pode ter vários administradores... 
        // neste caso, podemos mapear quem cadastrou quem.

        return $this->hasMany(
            self::class,
            'idadminfk',   // FK na tabela
            'idadmin'      // PK local
        );
    }

    // superior é apenas para definir relacionamento recursivo (unário)...
    public function superior()
    {
        // aqui diz: pertence á...
        return $this->belongsTo(
            self::class,
            'idadminfk',
            'idadmin'
        );
    }

    public function produtos(){
        return $this->hasMany(Produtos::class,'idadmin','idadmin');
    }

    public function categoria(){
        return $this->hasMany(Categoria::class,'idadmin','idadmin');
    }

    public function vedendores(){
        return $this->hasMany(Vendedor::class,'idadmin','idadmin');
    }

}
