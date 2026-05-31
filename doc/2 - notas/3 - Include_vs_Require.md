# Introdução
Este arquivo.md tem como objetivo principal descorrer sobre as intruções Include e Require
São duas instruções fundamentais para o entendimento do PHP.

## Contexto

    Tanto include quanto require são usados para inserir contéudo de um arquivo
    PHP dentro de outro. Isso é muiito usado para cabeçalhos, rodapés, menus,
    conexões com banco de dados e etc...

    Resumindo: No PHP, `include` e `require` são construções usadas para **inserir arquivos PHP externos** 
    no script atual. Ambos permitem modularizar o código, separando lógica, templates, rotas, configurações e mais.

## Diferenças:

| Comando  | Para que serve                                                          | O que acontece se não encontrar o arquivo | Fluxo de execução                 |
|----------|---------------------------------------------------------------------------|-------------------------------------------|------------------------------------|
| `include` | Insere o conteúdo de um arquivo PHP no ponto chamado.                    | Emite um *warning* (E_WARNING).           | O script **continua** executando.  |
| `require` | Insere o conteúdo de um arquivo PHP essencial para o script funcionar.   | Emite um *fatal error* (E_COMPILE_ERROR). | O script **é interrompido**.       |


## Exemplos:

| Comando  | Exemplo de uso                               | Descrição do exemplo                                                |
|----------|----------------------------------------------|----------------------------------------------------------------------|
| `include` | `<?php include 'header.php'; ?>`             | Insere o arquivo `header.php` no ponto onde for chamado. Se não existir, exibe um *warning* e continua o script. |
| `require` | `<?php require 'config.php'; ?>`             | Insere o arquivo `config.php`. Se não existir, gera erro fatal e interrompe o script. |
| `include_once` | `<?php include_once 'functions.php'; ?>` | Insere o arquivo apenas **uma vez**, mesmo se chamado várias vezes — evita redefinir funções/classes. |
| `require_once` | `<?php require_once 'db.php'; ?>`         | Insere o arquivo **uma única vez** e interrompe tudo se não existir — combina a segurança do `require` com o controle de múltiplas inclusões. |

## Aprofundamento

É muito importante entender esse conceito para Arquitetura PHP modular, especialmente em padrões como MVC ou DAO.

### Contexto: include e require

Tanto include quanto require são instruções de inclusão de arquivos no PHP.
Eles servem para inserir o conteúdo de outro arquivo PHP dentro do arquivo atual, no ponto exato onde a instrução é executada.

💡 Em termos práticos, é como se o conteúdo do arquivo incluído fosse copiado e colado no local da instrução.

### Diferença principal entre include e require

| Instrução | O que faz                     | Comportamento em erro                                                                               |
| --------- | ----------------------------- | --------------------------------------------------------------------------------------------------- |
| `include` | Inclui o arquivo especificado | **Emite um aviso (Warning)** se o arquivo não for encontrado e o script **continua executando**     |
| `require` | Inclui o arquivo especificado | **Emite um erro fatal (Fatal Error)** se o arquivo não for encontrado e o script **é interrompido** |

## Quando usar include, include_once, require, require_once


### include — usar para arquivos não essenciais

💡 Quando usar:

Use include quando o arquivo é opcional ou não crítico para a execução do sistema.

🔸 Exemplo de uso típico:

- Templates ou partes visuais (header, footer, menus)

- Componentes reutilizáveis de interface

- Blocos opcionais de configuração ou idioma

### require — usar para arquivos essenciais ao funcionamento

💡 Quando usar:

Use require para incluir arquivos que devem obrigatoriamente existir
para o código funcionar corretamente.

🔸 Exemplo de uso típico:

- Configuração de banco de dados

- Classe principal do framework

- Autoload de classes

- Arquivo de funções básicas

Exemplo:

```php
<?php
    // A aplicação não deve rodar sem esse arquivo
    require 'config/database.php';

    // Usa a conexão
    $conn = conectarBanco();
?>
```

📌 Comportamento:

- Se o arquivo não for encontrado → erro fatal (Fatal Error).

- O PHP para a execução imediatamente.

- Ideal para partes críticas do sistem

### ♻️ 3. include_once — usar para arquivos opcionais, mas que não podem ser duplicados

💡 Quando usar:

Use include_once para evitar redeclarações de funções ou classes em arquivos opcionais.

🔸 Exemplo:

```php
    include_once 'helpers.php';
    include_once 'helpers.php'; // Ignorado na segunda vez

    echo formataData('2025-10-26');
```

📌 Comportamento:

- Só inclui o arquivo uma única vez durante a execução.

- Continua o script se o arquivo não existir.

- Ideal para funções auxiliares ou módulos opcionais.

### 🔐 4. require_once — usar para arquivos obrigatórios e únicos

💡 Quando usar:

Use require_once para arquivos essenciais, mas que não devem ser incluídos mais de uma vez.

🔸 Exemplo:

```php
<?php
    require_once 'config.php';
    require_once 'autoload.php';
    require_once 'config.php'; // Ignorado (já incluso)

    $usuario = new Usuario();
?>
```

📌 Comportamento:

- Garante que o arquivo será incluído apenas uma vez.

- Se não existir, gera erro fatal.

- É a forma mais segura para dependências obrigatórias.


## Tabela comparativa: 

| Situação                                              | Comando Ideal  | Motivo                        |
| ----------------------------------------------------- | -------------- | ----------------------------- |
| Arquivo crítico (ex: configuração, banco, autoload)   | `require_once` | Evita falhas e duplicações    |
| Arquivo crítico, mas sem risco de inclusão dupla      | `require`      | Interrompe execução se faltar |
| Arquivo opcional (ex: footer, banner)                 | `include`      | Permite continuar o script    |
| Arquivo opcional, mas deve ser incluído uma única vez | `include_once` | Evita redefinições e warnings |

## ⚙️ Exemplo arquitetural (MVC)

Imagine um projeto MVC típico:

### Projeto:

```bash
/app
 ├── config/
 │    └── config.php
 ├── controllers/
 │    └── UsuarioController.php
 ├── models/
 │    └── Usuario.php
 ├── views/
 │    ├── header.php
 │    ├── footer.php
 │    └── usuario.php
 └── index.php
```

### Index.php:

```php
<?php
    require_once 'config/config.php'; // Essencial
    require_once 'controllers/UsuarioController.php'; // Essencial

    include 'views/header.php'; // Opcional (layout)
    include 'views/usuario.php'; // Opcional (página)
    include 'views/footer.php'; // Opcional (rodapé)
?>
```

➡️ Aqui temos o uso ideal:

- require_once: para partes estruturais e obrigatórias.

- include: para partes de layout, que podem ser omitidas sem quebrar o app.

## EXEMPLO DE USO COMPLETO DO REQUIRE/REQUIRE_ONCE

💡 Cenário:

- Você tem um sistema que precisa de uma conexão com o banco de dados para qualquer operação funcionar.

- Sem essa conexão, nada deve rodar.

- Por isso, é obrigatório usar require (ou require_once).

### Estrutura: 

```bash
/meusistema
 ├── config/
 │    └── conexao.php
 ├── app/
 │    └── usuario.php
 └── index.php
```

config/concexap.php

```php
<?php
// Arquivo essencial — define a conexão com o banco
$host = 'localhost';
$user = 'root';
$pass = '';
$db   = 'empresa';

try {
    $conn = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erro ao conectar ao banco: " . $e->getMessage());
}
?>
```

app/usuario.php
```php
<?php
// Arquivo com uma função que depende da conexão
function listarUsuarios($conn)
{
    $sql = "SELECT nome, email FROM usuarios";
    $stmt = $conn->query($sql);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>
```

index.php

```php
<?php
// O sistema não pode rodar sem essa conexão
require 'config/conexao.php'; 
require 'app/usuario.php';

$usuarios = listarUsuarios($conn);

foreach ($usuarios as $usuario) {
    echo "Nome: {$usuario['nome']} | Email: {$usuario['email']} <br>";
}
?>
```

## EXEMPLO DE USO COMPLETO DE INCLUDE/INCLUDE_ONCE

💡 Cenário:

- Você tem um site que usa componentes visuais reutilizáveis, como cabeçalho, menu e rodapé.

- Se um desses arquivos não existir, o site ainda pode ser exibido parcialmente.

- Logo, include é a escolha certa.

### Estrutura

```bash
/meusite
 ├── includes/
 │    ├── cabecalho.php
 │    ├── menu.php
 │    └── rodape.php
 └── index.php
```

**includes/cabecalho.php**

```php
<?php
    echo "<header style='background:#222; color:#fff; padding:10px;'>";
    echo "<h1>Meu Site Profissional</h1>";
    echo "</header>";
?>
```

**includes/menu.php**

```php
<?php
    echo "<nav style='background:#eee; padding:10px;'>";
    echo "<a href='#'>Home</a> | ";
    echo "<a href='#'>Serviços</a> | ";
    echo "<a href='#'>Contato</a>";
    echo "</nav>";
?>
```

**includes/rodape.php**

```php
<?php
    echo "<footer style='background:#222; color:#fff; padding:10px; text-align:center;'>";
    echo "&copy; " . date('Y') . " - Todos os direitos reservados.";
    echo "</footer>";
?>
```

**index.php**

```php
<?php
// Arquivos visuais, não críticos:
include 'includes/cabecalho.php';
include 'includes/menu.php';

echo "<main style='padding:20px;'>";
echo "<h2>Bem-vindo!</h2>";
echo "<p>Este é o conteúdo principal do site.</p>";
echo "</main>";

include 'includes/rodape.php';
?>
```

### 🧩 Explicação

Se menu.php faltar, o PHP apenas emite um Warning, mas o restante da página será carregado normalmente.

Isso é o comportamento esperado, porque menus e cabeçalhos não quebram o sistema, apenas o layout.

### ✅ Uso ideal do include:

arquivos opcionais ou de apresentação, como partes de layout, blocos visuais, anúncios, menus, footers, etc.

## Conclusão

| Situação                                               | Exemplo prático                        | Melhor escolha             |
| ------------------------------------------------------ | -------------------------------------- | -------------------------- |
| Conexão com o banco, configurações, funções essenciais | `config/conexao.php`                   | `require` / `require_once` |
| Templates, HTML modular, partes visuais                | `includes/cabecalho.php`, `rodape.php` | `include` / `include_once` |
