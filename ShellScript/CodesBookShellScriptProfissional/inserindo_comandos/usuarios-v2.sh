#!/bin/bash
# usuarios-v1.sh
#
# Vamos aprender a colocar opções de linha de comando em nossos scripts.
#
# Objetivo Principal:
#
# Mosta os logins e nomes de usuários do sistema
# Obs.: Lê dados do arquivo /etc/passwd
# 
# Explicação Rápida sobre as posições de variáveis captadas ao usuario digitar na linha de comando:
#
# $0 - representa o nome do script em execução. Ele é usado para referenciar o próprio script
# $1, $2, $3, ... - representam os argumentos passados para o script. 
# O número após o cifrão indica a posição do argumento. 
# Por exemplo, $1 é o primeiro argumento, $2 é o segundo, e assim por diante.
#
# exemplo completo: cut -d : -f 1,5 $move/passwd
#
# cut = $0
# -d = $1
# : = $2
# -f = $3
# 1,5 = $4
# $move/passwd = $5
#
# Versão 1: Mostra usuários e nomes separados por TAB ou (:)
# Versão 2: Adicionando suporte ao comando -h e -V
#
# Autor: Guilherme Henrique - Data: 2024-06-01


# Colocando nossas flags que podem ser tanto numeros, booleans ou strings
#  podem ser usadas para controlar o comportamento do script
# como por exemplo, para mostrar uma mensagem de ajuda ou para definir um valor específico.

MENSAGEM_USO="
Uso: $0 [-h]\n-h mostra esta mensagem de ajuda e sai do programa.
"

# o [-h] em colchetes indica que é opcional usar o comando -h, não vai impactar
# durante a execução do código, mas se o usuário quiser usar, ele pode usar para mostrar a mensagem de ajuda e sair do programa.

# Constantes - são variáveis que não devem ser alteradas durante a execução do script.
ROOT_TO_ETC="/etc"


# A partir daqui o código não deve ser modificado por usuários comuns

if test "$1" = "-h"; then

    # test é um comando que equivale ao colchetes para testa o valor de algo...
    # a linha de código acima se equivale ao:
    # if [ "$1" = "-h" ]; then
    # lembre-se que -eq é usado para comparar números, e = é usado para comparar strings

    echo -e "$MENSAGEM_USO"
    echo -e "Este script mostra os logins e nomes de usuários do sistema.\nLendo os dados do arquivo /etc/passwd."

    # o parâmetro -e no echo é um jeito clássico de colocar quebra de linha
    # ele ativa o modo (enable interpretation of backslash escapes). 
    # o que o echo puro nao faz

    # podemos usar Strings de Aspas Fortes $'...texto...' ao invés de: echo -e
    # é um sintaxe especial do Bash que já interpreta as sequências de escape automaticamante

    # por fim podemos usar o comando printf que já faz automaticamente a quebra de linha ao colocar \n
    # exemplo: printf "Linha1\nLinha\nLinha3"

    exit 0 # sai do programa

elif test "$1" = "-V"; then
    
    # --- EXPLICAÇÃO DA CADEIA DE COMANDOS (PIPELINE) ---
    #
    # 1. Primeiro grep:
    #    O 'grep' é um buscador de padrões. O "$0" é uma variável especial que representa o 
    #    nome do próprio script. Aqui, dizemos ao grep para ler o nosso código-fonte.
    #
    # 2. grep -v "grep":
    #    O parâmetro '-v' inverte a busca (filtra para excluir). Como a palavra "Chave" 
    #    aparece nesta própria linha de comando, o segundo grep remove a linha do comando 
    #    e deixa apenas a linha do comentário original lá do topo do arquivo.
    #
    # 3. cut -d ":" -f 1:
    #    O 'cut' aqui usa o delimitador (-d) de dois-pontos. O '-f 1' seleciona o primeiro 
    #    campo, ou seja, tudo o que vem antes do ":"
    #
    # 4. cut -c 3-:
    #    Após limpar o final da linha, este segundo 'cut' limpa o início. Ele pega do 
    #    caractere 3 em diante, removendo o caractere de comentário (#) e o espaço inicial.
    #
    # 5. O Pipe (|):
    #    Conecta a saída de um comando à entrada do próximo, criando uma linha de montagem.

    version=$(grep "Versão 2" "$0" | grep -v "grep" | cut -d ":" -f 1 | cut -c 3-)
    
    printf "$version\n"

    exit 0
fi

# perceba que o código esta crescendo muito com ifs 
# na versao tres vamos usar case para organizar melhor!

move=$(cd $ROOT_TO_ETC; pwd) 

cut -d : -f 1,5 $move/passwd 

