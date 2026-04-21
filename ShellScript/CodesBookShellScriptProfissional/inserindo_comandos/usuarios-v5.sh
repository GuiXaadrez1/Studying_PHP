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
# Versão 5: Adicionando opções -s e --sort para ordenação alfabética dos usuários
#
# 
#
# Autor: Guilherme Henrique - Data: 2024-04-21

# Colocando flags (chaves)...

ordenar=0 # A sáida deverá ser ordenada? 

# basename "$0" -> é um comando que retorna apenas o nome do arquivo do script, sem o caminho completo.
MENSAGEM_USO="
Uso: $(basename "$0") [-h, --help | -V, --version | -s, --sort]\n\n[-h ou --help] mostra saida de ajuda;\n[-V ou --version] mostra a versão do script e sai do programa;\n[-s ou --sort] ordena a listagem alfabéticamente.
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
        # o tr é um comando linux para substituir ou deletar caracteres, nesse caso o -d é para deletar os espaços em branco.
        
        # Ou poodemos fazer assim:

            # version=$(grep "Versão [0-9]" "$0" | tail -1 | sed 's/^# //' | cut -d ":" -f 1)
        
            # sed 's/^# //' -> é um comando que serve para substituir o início de uma linha que
            # começa com # por nada, ou seja, remove o # do início da linha.

        printf "$version\n"
        
        exit 0
        ;;
    
    -s | --sort)
        ordenar=1
        ;;
    *) 
        # -n é um operador de teste que verifica se a string fornecida não está vazia.
        if test -n "$1";then

            printf "Opção inválida: $1"
            exit 1 
        fi
        ;;
esac 

# lembrando que $(...) é uma substituição de comando, ou seja, o comando dentro dos parênteses é executado e seu resultado é atribuído à variável move.
move=$(cd $ROOT_TO_ETC; pwd) 

printf "Movendo para o diretório: $move\n\n"

lista=$(cut -d : -f 1,5 $ROOT_TO_ETC/passwd)

# Ordena a listagem (se necessário)
if test "$ordenar" -eq 1; then
    lista=$(echo "$lista" | sort)
fi  

echo "$lista" | tr : \\t


# A PROFUNDAMENTO SOBRE O COMANDO: tr 

# tr -> é um comando que serve para substituir ou deletar caracteres. 
# Ele lê a entrada padrão e substitui ou deleta os caracteres especificados.

# No caso do comando tr : \\t, ele está substituindo os dois pontos (:) por tabulações (\t) 
# na saída do comando echo "$lista".

# tubulações \t são na verdade o comando TAB 

# Sintaxe básica do comando tr:
    # tr [opções] conjunto1 [conjunto2]

# o conjunto1 é o conjunto de caracteres que você deseja substituir ou deletar
# e o conjunto2 é o conjunto de caracteres que você deseja usar para a substituição.

# Parâmetros do comando tr:

# -d -> é usado para deletar caracteres. 
    # Por exemplo, tr -d 'a' vai deletar todas as letras 'a' da entrada.

# -s -> é usado para substituir sequências de caracteres repetidos por um único caractere. 
    # Por exemplo, tr -s ' ' vai substituir múltiplos espaços por um único espaço.

# -c -> é usado para complementar o conjunto de caracteres. 
    # Por exemplo, tr -c 'a-z' ' ' 
    # vai substituir todos os caracteres que não são letras minúsculas por espaços.


# A PROFUNDAMENTO SOBRE O COMANDO: sort

# sort -> é um comando que serve para ordenar linhas de texto. 
# Ele lê a entrada padrão e ordena as linhas de acordo com critérios específicos.

# Sintaxe básica do comando sort:
    # sort [opções] [arquivo ou stdout de outro comando com pipelines]

# Parâmetros do comando sort:

# -n -> é usado para ordenar numericamente. 
    # Por exemplo, sort -n vai ordenar os números em ordem crescente.

# -r -> é usado para ordenar em ordem reversa. 
    # Por exemplo, sort -r vai ordenar as linhas em ordem decrescente.

# -k -> é usado para especificar a chave de ordenação. 
    # Por exemplo, sort -k 2 vai ordenar as linhas com base na segunda coluna.

# -u -> é usado para eliminar linhas duplicadas. 
    # Por exemplo, sort -u vai ordenar as linhas e eliminar as duplicatas.