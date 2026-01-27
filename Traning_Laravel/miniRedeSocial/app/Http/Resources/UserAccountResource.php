<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;


/*

    Aqui basicamente vamos filtrar campos de dados Retornados pelo nosso Banco de dados
    Neste caso Repository...
    E retornar esses campos filtrados para a nossa API

*/

class UserAccountResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * basicamente transforma o nosso Resourc eem um array
     * com o dados filtrados
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {

        $photo = '';

        if ($this->photo == null) {
            $photo = asset('assets/img/user_profile.png');
        } else {
            $dir = env('USER_DIR_PROFILE_UPLOAD');

            $photo =  "/storage/{$dir}{$this->photo}";
        }

        return [
            'name' => $request->name,
            'bio' => $request->bio,
            'photo'=>$request->photo,   
        ];
    }
}
