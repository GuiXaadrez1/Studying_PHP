# Namespace (espaço de nome)

## Introdução

Em sistemas de software complexos e modulares, é comum que nomes de classes, funções e constantes entrem em conflito quando diferentes módulos utilizam identificadores idênticos.
Para resolver esse problema e permitir organização lógica e semântica do código, a linguagem PHP introduziu o conceito de namespace a partir da versão 5.3.

O namespace (ou espaço de nomes) funciona como uma estrutura hierárquica de agrupamento lógico, que define um contexto isolado de identificação para classes, interfaces, funções e constantes.
Em outras palavras, um namespace atua como um pacote (package) — um "sistema de endereçamento" para identificar de forma única elementos dentro de um projeto.

## Fundamentação Conceitual

Em termos conceituais, um namespace é um escopo de nomes qualificado, semelhante ao conceito de módulo em outras linguagens como Java, C# ou Python.

Matematicamente, podemos representá-lo como uma função de mapeamento:

```bash
Identificador global = NomeNamespace + NomeElemento
```
Por exemplo:

- App\Models\User

- MyCompany\Utils\Logger

- Library\Database\Connection

Cada elemento dentro de um namespace é identificado de forma única por seu Fully Qualified Name (FQN) — o nome completamente qualificado.

### Sintaxe Formal

A declaração de um namespace em PHP é feita com a palavra-chave namespace, e deve ser a primeira instrução do arquivo PHP (logo após a tag <?php).

```php
<?php
namespace App\Models;

class Usuario {
    public function exibir() {
        echo "Classe Usuario do namespace App\\Models";
    }
}
```

Observações sintáticas:

- O namespace é sempre declarado no topo do arquivo.

- O nome do namespace segue a convenção CamelCase e normalmente reflete a estrutura de diretórios.

- É possível declarar múltiplos namespaces em um mesmo arquivo, mas isso é desencorajado por boas práticas de engenharia de software.

## mportando Namespaces com use (Ponto de atenção)

Para utilizar uma classe, função ou constante definida em outro namespace, utiliza-se a instrução use. Ela importa o caminho completo, permitindo o uso de nomes curtos dentro do arquivo atual.

```php
<?php

# definindo namespace para o diretório controller 
namespace App\Controllers; 

// "importando a class Usuario da nossa Model"
use App\Models\Usuario;

// criando a nossa classe controller
class UsuarioController {

    // definidno um método
    public function mostrar() {

        // materializando um novo objeto da class User da Model
        $usuario = new Usuario();

        // acessando método exibir
        $usuario->exibir();
    }
}
```

- Aqui, use App\Models\Usuario; importa o caminho completo.

- A classe Usuario é acessada diretamente, sem precisar escrever new \App\Models\Usuario().

## Fully Qualified Name (FQN)

O Fully Qualified Name é o caminho absoluto de um elemento, começando com uma barra invertida (\).

```php
$usuario = new \App\Models\Usuario();
```

Esse formato é útil quando você precisa acessar uma classe sem usar use, garantindo que o PHP interprete o nome completo a partir da raiz do namespace

## Estrutura Hierárquica

Namespaces podem ser aninhados, criando uma hierarquia de pacotes.
Essa estrutura é útil em projetos grandes, facilitando a modularização.

Exemplo:

```php
<?php
namespace Empresa\Sistema\Modulo;

class Relatorio {
    public function gerar() {
        echo "Gerando relatório do módulo...";
    }
}
```
Esse código define a classe Relatorio dentro do namespace:

```bash
Empresa\Sistema\Modulo
```

O FQN será:

```bash
\Empresa\Sistema\Modulo\Relatorio
```

## Alias de Namespaces

É possível criar apelidos (alias) para namespaces longos utilizando a palavra-chave as.

EXEMPLO:

```php
use Empresa\Sistema\Modulo\Relatorio as RelatorioModulo;

$relatorio = new RelatorioModulo();
$relatorio->gerar();
```

Isso é especialmente útil quando:

- Há nomes de classes iguais em namespaces diferentes.

- Os namespaces são longos e repetitivos.

## Namespace Global

Quando um arquivo PHP não declara nenhum namespace, suas classes e funções pertencem ao namespace global (vazio).

Exemplo:

```php
<?php
class Produto {
    public function exibir() {
        echo "Classe no namespace global";
    }
}
```

Ao importar de dentro de outro namespace, deve-se usar o prefixo \:

```php
<?php
namespace App;

$produto = new \Produto();
$produto->exibir();
```

## Namespaces e Autoloading (PSR-4)

A PSR-4 (PHP Standards Recommendation) é o padrão oficial para autoload de classes via namespaces, amplamente utilizado em frameworks como Laravel, Symfony e Composer.

Segundo a PSR-4:

    O namespace deve refletir a estrutura de diretórios do projeto.

Exemplo de Estrutura PSR-4:

```bash
src/
│
├── Controllers/
│   └── UsuarioController.php
├── Models/
│   └── Usuario.php
└── Services/
    └── UsuarioService.php
```

### Arquivo Usuario.php

```php
<?php
namespace App\Models;

class Usuario {}

```

### Arquivo composer.json

```json
"autoload": {
    "psr-4": {
        "App\\": "src/" # veja que criamos um apelido que leva para o caminho src/
    }
}
```
Assim, o Composer consegue localizar automaticamente as classes pelo namespace.

### Comparação Analógica

| Linguagem  | Estrutura Equivalente | Exemplo                            |
| ---------- | --------------------- | ---------------------------------- |
| **PHP**    | `namespace`           | `namespace App\Models;`            |
| **Java**   | `package`             | `package com.company.models;`      |
| **C#**     | `namespace`           | `namespace Company.Models { ... }` |
| **Python** | `módulo/pacote`       | `import models.user`               |

Portanto, o namespace em PHP cumpre o mesmo papel semântico de um “pacote lógico de código”, agrupando classes que têm um domínio funcional comum.

## Boas Práticas de Engenharia

- Um namespace por arquivo — facilita o autoload e a manutenção.

- Refletir o diretório físico — coerência com PSR-4.

- Evitar nomes genéricos — use nomes de domínio e módulo.

- Usar alias para evitar ambiguidade — especialmente em sistemas modulares.

- Nunca usar namespaces com letras minúsculas misturadas — siga convenção PascalCase.

## Exemplo Completo

### Estrutura de diretórios:

```bash
src/
├── Controllers/
│   └── UsuarioController.php
└── Models/
    └── Usuario.php
```

#### Arquivo src/Models/Usuario.php:

```php
<?php
namespace App\Models;

class Usuario {
    public function exibir() {
        echo "Usuário exibido a partir do namespace App\\Models";
    }
}
```

### src/Controllers/UsuarioController.php:

```php
<?php
namespace App\Controllers; # criando um pacote para essa Contollers

use App\Models\Usuario; # importando a class Usuario

class UsuarioController {
    public function mostrarUsuario() {
        $usuario = new Usuario();
        $usuario->exibir();
    }
}
```

### Arquivo principal index.php:

```php
<?php
# outra forma de importar, só que é todas as propriedades do arquivo autoload.php
require 'vendor/autoload.php'; 

# importando a classe que definimos em Controllers
use App\Controllers\UsuarioController;

$controller = new UsuarioController();
$controller->mostrarUsuario();
```

## Conclusão

O uso de namespaces em PHP é uma prática fundamental de modularização e encapsulamento lógico.

Eles fornecem:

- Isolamento de contexto entre módulos;

- Clareza estrutural do código-fonte;

- Compatibilidade com o padrão PSR-4 e autoloading do Composer.

Em síntese, o namespace é o mecanismo de organização semântica da POO em PHP, promovendo escalabilidade e padronização em aplicações modernas.

## Referências

PHP Manual — Namespaces
https://www.php.net/manual/en/language.namespaces.php

PHP-FIG — PSR-4: Autoloader Standard
https://www.php-fig.org/psr/psr-4/

Fowler, M. Patterns of Enterprise Application Architecture. Addison-Wesley, 2002.

Gamma, E. et al. Design Patterns: Elements of Reusable Object-Oriented Software. Addison-Wesley, 1994.