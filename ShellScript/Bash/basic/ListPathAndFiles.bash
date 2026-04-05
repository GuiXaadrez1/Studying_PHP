#!/bin/bash

# Vamos nos aprofundar sobre listagem de contéudo de diretórios... 

# COMANDOS:

# ls -> exibe todos os diretórios, sub diretórios, elementos do diretório atual

# ls -i  -> exibe o numero de identificação

# ls *.sql -> aqui estamos usando o coringa para listar todos arquivos de extensao .sql

# ls -a -> exibe também os arquivos ocultos (com linux) -> eles começar com . no inicío do nome do arquivo 
# no geral esses arquivos são importantes do sistema operacional ou outros...

# ls -l -> exibe permissoes dos arquivos (exibe as strings de permissao no inicio)

# ls -1 -> exibe tudo em uma única coluna


# criando um arquivo de log para aprendermos sobre string de permissoes

touch BashBash.sh 

ls  -a -l > strings_permissions.txt >&1

# Dando pemissao de execucao para um grupo de usuario e para o usuario!
chmod u=rwx BashBash.sh
chmod g=rwx BashBash.sh

