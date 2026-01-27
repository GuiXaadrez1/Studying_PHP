<?php


// Service é uma camada ao qual é realizado a regra de negócio específica de alguma 
// funcionalidade, geralmente realizamos toda a lógica de programação nela
// deixando o fluxo e o orquestramento a ser utilizado pela Controller.

namespace App\Service;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

// Importante revisar e estudar isso aqui depois
// php artisan .. link para criar o link simbolico do arquivo no storege do Laravel
// Lembrando que é o próprio Laravel que gerencia isso

class ImageUploadService
{
    private string $disk;

    public function __construct(string $disk = 'public')
    {
        // pasta ao qual por padrao irá conter as imagens
        $this->disk = $disk;
    }

    // funcao de upload de arquivos
    // primeiro é o arquivo a ser enviado pelo usuario o segundo é o diretório a ser salvo
    public function upload($file, string $directory): string
    {
        // pega extensao do arquivo
        $extension = $file->getClientOriginalExtension();

        // gera uma espécie de id e concatena com a extensao
        $filename = Str::uuid()->toString() . '.' . $extension;

        // salva a pasta no repositorio public que fica no storege do Laravel por segurança.
        $path = $file->storeAs($directory, $filename, $this->disk);

        // retorna o nome do arquivo que foi gerado e concatenado com o uuid
        return $filename;
    }

    public function delete(string $filename, string $directory): bool
    {
        $path = sprintf('%s/%s', $directory, $filename);

        if (Storage::disk($this->disk)->exists($path)) {
            return Storage::disk($this->disk)->delete($path);
        }

        return false;
    }
}

?>