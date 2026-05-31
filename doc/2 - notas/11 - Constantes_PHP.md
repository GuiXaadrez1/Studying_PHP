# Introdução

Este documento tem como objetivo demonstrar e conceituar o que é constante utilizando PHP e como utilizar.

## 📌 O que é uma constante em PHP?

o PHP, uma constante é um identificador (nome) para um valor imutável durante toda a execução do script.
Diferentemente de uma variável, uma constante não pode ser alterada depois de definida.

✅ Características principais:

- O valor é fixo após a definição.

- É acessível globalmente por padrão.

- Segue convenções de nomenclatura UPPER_CASE (boa prática, não obrigatório).

- Pode ser definida com define() ou com a palavra-chave const.

##  Por que usar constantes?

- Configuração fixa: URLs, caminhos de diretórios, chaves de API.

- Melhor leitura: Substitui valores mágicos no código ("magic numbers").

- Segurança: Evita sobrescrita acidental.

- Desempenho: PHP otimiza constantes em tempo de compilação.

## Como declarar uma constante

### 1️⃣ Usando define()

Sintaxe:

```php
<?php
    define('NOME_DA_CONSTANTE', valor [, bool $case_insensitive = false]);
?>
```

NOME_DA_CONSTANTE: Identificador da constante (string).

valor: Valor atribuído.

case_insensitive: (obsoleto desde PHP 7.3.0) Permite acesso insensível a maiúsculas/minúsculas.

Observações: Para chamar uma constante, basta dar um echo e chamar o nome que você deu para a constante

Exemplo prático:

```php
<?php
   define('SITE_URL', 'https://www.meusite.com');
    define('TAXA_CONVERSAO', 0.85);

    echo "Acesse: " . SITE_URL . "\n";
    echo "Taxa: " . TAXA_CONVERSAO . "\n";
?>
```

### 2️⃣ Usando const

Regras:

    Só pode ser usada no escopo de script ou dentro de classes.

    Não aceita expressões dinâmicas como chamadas de função (até PHP 5.6).

Exemplo prático:

```php
<?php
    const VERSAO = '1.0.0';

    echo "Versão atual: " . VERSAO;
?>
```

## Constantes em classes
Dentro de classes, const cria constantes de classe, acessadas com self:: ou Classe::.

```php
<?php
    class Config {
        const DATABASE = 'meubanco';
        const VERSAO_API = 'v2';
    }

    echo Config::DATABASE; // "meubanco"
?>
```

Diferente de atributos static, constantes não podem ser sobrescritas em subclasses (herança).

## ⚠️ Boas práticas

- Nomeie constantes em UPPER_SNAKE_CASE (MAX_SIZE, API_KEY).

- Agrupe por contexto lógico (Config::, Env::).

- Evite duplicar nomes.

- Para valores muito dinâmicos, use variáveis ou define condicionalmente

## 🧩 Diferença define x const

| Aspecto              | `define`             | `const`                      |
| -------------------- | -------------------- | ---------------------------- |
| Contexto             | Qualquer lugar       | Somente escopo global/classe |
| Execução             | Runtime              | Em tempo de compilação       |
| Expressões dinâmicas | Aceita desde PHP 5.6 | Não permite                  |
| Visibilidade         | Global               | Global ou em classe          |

## 🔍 Verificando se existe

Para evitar redeclaração, use defined():

```php
<?php

    if (!defined('APP_PATH')) {
        define('APP_PATH', '/var/www/app');
    }

?>
```

## Exemplo prático! 

```php
<?php

    // Configuração geral
    define('APP_NAME', 'Minha Aplicação');
    define('APP_ENV', 'production');

    // Constantes em classe
    class DatabaseConfig {
        const HOST = 'localhost';
        const USER = 'root';
        const PASS = 'secret';
    }

    // Uso
    echo "Aplicação: " . APP_NAME . "\n";
    echo "Ambiente: " . APP_ENV . "\n";
    echo "DB Host: " . DatabaseConfig::HOST . "\n";

?>
```

## RESUMO

- Use constantes para qualquer valor que não deve variar durante a execução.

- define() é flexível para scripts gerais.

- const é recomendado em classes, namespaces e código moderno.

- Melhora clareza, manutenção e segurança do código.