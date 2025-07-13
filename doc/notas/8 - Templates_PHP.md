# Introdução

Esse arquivo.md visa explicar como podemos trabalhar com html e php usando templates

## O que são Templates?

Templates são arquivos responsáveis apenas por apresentar dados, separados da lógica PHP. Assim, o PHP cuida de cálculos, controle e regras de negócio, enquanto o template mostra o resultado.

## Por que usar Templates?

🔒 Segurança: Evita lógica misturada com HTML.

🧩 Organização: Código MVC (Model-View-Controller).

🔍 Manutenção: Fácil localizar bugs.

♻️ Reuso: Páginas podem herdar layouts prontos.

## Conceito de strict_types + Templates

A tipagem estrita (declare(strict_types=1)) fica nos arquivos PHP de controle.

O HTML é gerado nos templates, sem precisar abrir <?php no meio.

Assim, o declare nunca conflita com HTML, porque o template não executa PHP diretamente.

## Twig — Engine Independente

▶️ 4.1 Como Funciona

Sintaxe simples: {{ variavel }} imprime conteúdo.

Estruturas: {% if %} ... {% endif %}, {% for %} para loops.

Herança: Um layout.twig pode ser base para várias páginas.

▶️ 4.2 Exemplo Básico Twig

Arquivo: templates/ola.twig

``` html
<!DOCTYPE html>
<html>
<head><title>Olá Twig</title></head>
<body>
  <h1>Olá {{ nome }}</h1>
  {% if idade >= 18 %}
    <p>Você é maior de idade.</p>
  {% else %}
    <p>Você é menor de idade.</p>
  {% endif %}
</body>
</html>
```

Arquivo PHP Controller:
```php
<?php
declare(strict_types=1);
require_once 'vendor/autoload.php';

$loader = new \Twig\Loader\FilesystemLoader('templates');
$twig = new \Twig\Environment($loader);

echo $twig->render('ola.twig', [
    'nome' => 'Morty',
    'idade' => 16
]);
```

## Blade — Engine Oficial do Laravel

▶️ 5.1 Como Funciona

Sintaxe: {{ $variavel }} imprime.

Estruturas: @if, @foreach.

Herança de layouts com @extends e @section.

▶️ 5.2 Exemplo Básico Blade

Arquivo: resources/views/bemvindo.blade.php

```php
@extends('layouts.app')

@section('content')
  <h1>Olá, {{ $nome }}</h1>
  @if($idade >= 18)
    <p>Maior de idade</p>
  @else
    <p>Menor de idade</p>
  @endif
@endsection
```

Controller Laravel:

```php
<?php
    public function show() {
    return view('bemvindo', [
        'nome' => 'Morty',
        'idade' => 20
    ]);
    }
?>
```

Layout Base: resources/views/layouts/app.blade.php

``html
<!DOCTYPE html>
<html>
<head>
  <title>Meu Site</title>
</head>
<body>
  @yield('content')
</body>
</html>
```

## Vantagens Diretas

Separação completa: Nenhum PHP "misturado" no HTML.

Controle total: strict_types fica isolado no PHP.

Layouts reaproveitáveis: Uma base .twig ou .blade.php para dezenas de páginas.

## Quando usar cada um

- Twig: PHP puro, Symfony ou frameworks independentes.

- Blade: Laravel.

## Conclusão

Templates tornam seu projeto limpo, seguro e pronto para crescer. Combine declare(strict_types=1) nos controladores com Twig ou Blade para ter um sistema profissional e sem conflitos de tipagem.