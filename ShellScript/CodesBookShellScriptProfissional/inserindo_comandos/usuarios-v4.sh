#!/bin/bash
# usurios.sh
#
# Vamos aprender a colocar opções de linha de comando em nossos scripts.
#
# OBJETIVO PRINCIPAL DO PROGRAMA SHELLSCRIPT:
#
# Mosta os logins e nomes de usuários do sistema
# Obs.: Lê dados do arquivo /etc/passwd
# 
#
# VERSÕES:
#
# Versão 1: Mostra usuários e nomes separados por TAB ou (:)
# Versão 2: Adicionando suporte ao comando -h e -V
# Versão 3: Refatorando para usar case
# Versão 4: Arrumando bug quando não tem opções, basename no nome do programa, 
#           -V extraido diretamente dos cabeçalhos,
#           adicionando as opções alternativas --help e --version
#
# Autor: Guilherme Henrique - Data: 2024-04-01

# Colocando flags...

MENSAGEM_USO="
Uso: $(basename "$0") [-h | -V]\n-h mostra saida de ajuda.\n-V mostra a versão do script e sai do programa.
"

# Colocando Constantes - são variáveis que não devem ser alteradas durante a execução do script.
ROOT_TO_ETC="/etc"

# A partir daqui o código não deve ser modificado por usuários comuns

# tratamento das opções de linha de comando usando case
case "$1" in
    -h | --help) 
        echo -e "$MENSAGEM_USO"
        echo -e "Este script mostra os logins e nomes de usuários do sistema.\nLendo os dados do arquivo /etc/passwd."
        exit 0

        # vou deixar o echo -e para fins didáticos
        ;; 
    -V | --version)

        version=$(grep "Versão [0-9]" "$0" | tail -1 | cut -d ":" -f 1 | tr -d \#)
        
        # resumindo agora com esse novo comando de version
        # o comando grep procura a linha que começa com "Versão " no próprio script,
        # o tail -1 pega apenas a primeira linha encontrada,
        # o cut -d ":" -f 1 pega a parte antes dos dois pontos,
        # e o tr -d remove os espaços em branco, deixando apenas a versão do script

        # Ou poodemos fazer assim:

            # version=$(grep "Versão [0-9]" "$0" | tail -1 | sed 's/^# //' | cut -d ":" -f 1)
        
            # sed 's/^# //' -> é um comando que serve para substituir o início de uma linha que
            # começa com # por nada, ou seja, remove o # do início da linha.

        printf "$version\n"
        
        exit 0
        ;;
    *) 
        if test -n "$1";then

            printf "Opção inválida: $1"
            exit 1 
        fi
        ;;
esac 

move=$(cd $ROOT_TO_ETC; pwd) 

cut -d ":" -f 1,5 $move/passwd

