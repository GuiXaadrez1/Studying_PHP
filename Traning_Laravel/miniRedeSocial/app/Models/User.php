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



    public function getFirstNameAttribute(){
        
        // obtendo o primeiro caracter
        // lembrando que explode, transforma strings em array
        // cada array representa um conjunto de caracteres
        $firstName = explode(' ',$this->name[0]);
        
        // transforma todos os caracteres em minúsculas
        $firstName = strtolower($firstName[0]);

        // colocando o primeiro caracter da string em Maiúscula
        return  ucfirst($firstName);
    }
}
