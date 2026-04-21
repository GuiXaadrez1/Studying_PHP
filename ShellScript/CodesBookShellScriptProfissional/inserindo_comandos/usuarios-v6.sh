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
# Versão 6: Adicionando opçõe -r, --reverse, -u, --uppercase, leitura de múltiplas opções (loop)
# 
#
# Autor: Guilherme Henrique - Data: 2024-04-21

# Colocando flags (chaves)...

ordenar=0 # A sáida deverá ser ordenada? 
inverter=0 # A sáida deverá ser invertida?
maiusculas=0 # A sáida deverá ser em maiúsculo?

# basename "$0" -> é um comando que retorna apenas o nome do arquivo do script, sem o caminho completo.
MENSAGEM_USO="
Uso: $(basename "$0") [-h, --help | -V, --version | -s, --sort | -r, --reverse | -u, --uppercase]\n\n[-h ou --help] -> mostra saida de ajuda;\n\n[-V ou --version] -> mostra a versão do script e sai do programa;\n\n[-s ou --sort] -> ordena a listagem alfabéticamente;\n\n[-r ou --reverse] -> inverte a ordem da listagem;\n\n[-u ou --uppercase] -> mostra os elementos da listagem em maiúsculas.
"

# Colocando Constantes - são variáveis que não devem ser alteradas durante a execução do script.
ROOT_TO_ETC="/etc"

# A partir daqui o código não deve ser modificado por usuários comuns

while test -n "$1";do
    case "$1" in
        -h | --help) 
            echo -e "\nEste script mostra os logins e nomes de usuários do sistema.\nLendo os dados do arquivo /etc/passwd."
            echo -e "$MENSAGEM_USO"
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

        -r | --reverse)
            inverter=1
            ;;

        -u | --uppercase)
            maiusculas=1
            ;;
        *) 
            # -n é um operador de teste que verifica se a string fornecida não está vazia.
            if test -n "$1";then

                printf "Opção inválida: $1"
                exit 1 
            fi
            ;;
    esac 

    # shift é um comando especial que usamos para fazer a filha dos argumentos 
    # passados pelo usuário como parâmetro na inicialização do script andar...

    # basicamente, se não fosse o shift teriamos sempre o primiero argumento 
    # sendo executado!
    
    # com shift temos:
        
        # O conteúdo do argumento $1 é descartado (ele "cai" da esteira). 
        # os argumentos $2 -> $1, 3$ -> $2 e sucessivamente até não restar mais nem um!
    
    shift # puxa o próximo argumento e executa. caso atenda a condição do while

done

# lembrando que $(...) é uma substituição de comando, ou seja, o comando dentro dos parênteses é executado e seu resultado é atribuído à variável move.
move=$(cd $ROOT_TO_ETC; pwd) 

printf "Movendo-se para o diretório: $move\n\n"

lista=$(cut -d : -f 1,5 $ROOT_TO_ETC/passwd)

# Ordena a listagem (se necessário)
if test "$ordenar" -eq 1; then
    lista=$(echo "$lista" | sort)
fi  

# Inverte a listagem (see necessário) 
if test "$inverter" -eq 1; then
    lista=$(echo "$lista" | tac)
fi

if test "$maiusculas" -eq 1; then
    lista=$(echo "$lista" | tr a-z A-Z)
fi 

echo "$lista" | tr : \\t

# APROFUNDAMENTO SOBRE O COMANDO tac

# tac -> é um comando que serve para concatenar e exibir arquivos na ordem inversa
# Ele lê a entrada e imprime as linhas começando pela última e terminando na primeira.

# Sintaxe Básica:
    # tac [opções] [arquivo...]

# Parâmetros do comando tac:

# -b, --before -> é usado para anexar o separador antes do conteúdo, em vez de depois.
    # Por padrão, o tac entende que a quebra de linha está no fim. 
    # Com -b, ele altera essa lógica de prioridade.

# -r, --regex -> é usado para interpretar o separador como uma expressão regular (regex).
    # Isso permite que você defina padrões complexos de onde o "corte" da linha deve 
    # acontecer para a inversão.

# -s, --separator -> é usado para definir um separador personalizado em vez da nova linha (\n).

# Diferença fundamental: sort -r vs tac

    # sort -r: Analisa o conteúdo e faz uma reordenação lógica (Z até A).

    # tac: Não analisa o conteúdo das letras; 
    # ele apenas inverte fisicamente a ordem das linhas, 
    # não importa o que esteja escrito nelas.