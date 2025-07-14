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
