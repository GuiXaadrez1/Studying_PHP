<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

use App\Constantes\Tables;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    # Definindo uma variável para específicar qual tabela é:
    protected $table = Tables::USERS;

    // Deixando modificações de dados explícita (É um forma de deixar a manutenção mais fácil)
    // porém quebra o conceito de MODEL do Laravel que é mais dinâmico
    public const CREATED_AT = 'created_at';
    public const UPDATED_AT = 'updated_at';
    //public const DELETED_AT = 'deleted_at';
    public const NAME = "name";
    public const EMAIL = "email";
    public const USERNAME = "username";
    public const EMAIL_VERIFIED_AT = "email_verified_at";
    public const PASSWORD = "password";
    public const BIO = "bio";
    public const PHOTO = "photo";
    public const REMEMBER_TOKEN = "remember_token";

    /**
     * The attributes that are mass assignable.
     * O atributos que podem ser atribuídos em massa, bsicamente 
     * sao os campos que podem ser preenchidos via array
     * @var list<string>
     */
    protected $fillable = [
        self::NAME,
        self::EMAIL,
        self::USERNAME,
        self::EMAIL_VERIFIED_AT,
        self::PASSWORD,
        self::BIO,
        self::PHOTO,
        self::REMEMBER_TOKEN,
        self::CREATED_AT,
        self::UPDATED_AT,
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }


    /*
        Essa funcao é bastante especial quando se trata do Laravel

        Quando você faz {{ Auth::user()->first_name }}, o PHP tenta procurar uma
        propriedade pública chamada $first_name no objeto User. Como essa propriedade
        não existe (ela não é uma coluna real na sua tabela users), o PHP dispara
        o método mágico __get() do Laravel, que está definido dentro da classe pai Model.

        O Laravel então inicia uma busca interna:

            Ele checa se existe o valor no array de atributos do banco ($attributes).

            Se não encontrar, ele procura por um método seguindo o padrão: get + NomeDoAtributoEmCamelCase + Attribute.

            Ele encontra seu método getFirstNameAttribute e o executa automaticamente.

        De Snake Case para Pascal Case
        
        O Laravel faz a conversão automática da nomenclatura:

            No Blade/Código: first_name (snake_case).

            No Model: FirstName (PascalCase).

            O Sufixo: Attribute.
        
        Exemplos de como descrever sua variavel: 

            Pascal Case ou Upper Camel Case -> PalavraPalavra (geralmente usamos para Classes)
            Camel Case ou Lower Camel Case -> palavraPalavra (nomes de funções, metodos, propriedades e variáveis)
            Snake_Case -> palavra_palavra (usado mais em variáveis, nome de tabelas, arquivos Json)
            Kebab Case -> palavra-palavra (usado em URLs e CSS)
    */
    public function getFirstNameAttribute(){
        
        // obtendo o primeiro caracter
        // lembrando que explode, transforma strings em array
        // cada array representa um conjunto de caracteres
        $firstName = explode(' ',$this->name);
        
        // transforma todos os caracteres em minúsculas
        $firstName = strtolower($firstName[0]);

        //dd($firstName);

        // colocando o primeiro caracter da string em Maiúscula
        return  ucfirst($firstName);
    }
}
