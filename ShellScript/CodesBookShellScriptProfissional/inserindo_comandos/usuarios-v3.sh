#!/bin/bash
# usuarios-v1.sh
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
#
# Autor: Guilherme Henrique - Data: 2024-06-01

# Colocando flags...

MENSAGEM_USO="
Uso: $(basename "$0") [-h | -V]\n-h mostra esta mensagem de ajuda e sai do programa.\n-V mostra a versão do script e sai do programa.
"

# o | dentro do colchetes indica que o usuário pode usar tanto -h quanto -V, 
# e ambos são opções válidas para o script.
# lembrando que a utilização dos comandos são opcionais
# pois estão entre colchetes.

# Colocando Constantes - são variáveis que não devem ser alteradas durante a execução do script.
ROOT_TO_ETC="/etc"

# A partir daqui o código não deve ser modificado por usuários comuns

# tratamento das opções de linha de comando usando case
case "$1" in
    -h) 
        # ) indica o início de um bloco de código para a opção -h
        echo -e "$MENSAGEM_USO"
        echo -e "Este script mostra os logins e nomes de usuários do sistema.\nLendo os dados do arquivo /etc/passwd."
        exit 0
        # ;; é usado para indicar o fim de um bloco de código dentro do case
        ;; 
    -V)
        version=$(grep "Versão 3" "$0" | grep -v "grep" | cut -d ":" -f 1 | cut -c 3-)
        printf "$version\n"
        exit 0
        ;;
    *) 
        # * é um curinga que indica que qualquer outra opção que não seja -h ou -V é considerada inválida
        if test -n "$1";then

            # esse parâmetro -n serve para validar se a variável não esta vazia!

            printf "Opção inválida: $1"
            exit 1 # quando exit = 1 indica que o programa terminou com um erro, ou seja, o usuário digitou uma opção inválida.
        fi
        ;;
esac # esac indica o fim do bloco de código do case

move=$(cd $ROOT_TO_ETC; pwd) 

cut -d : -f 1,5 $move/passwd

