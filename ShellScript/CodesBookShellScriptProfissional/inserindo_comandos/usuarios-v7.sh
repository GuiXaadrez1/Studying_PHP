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
# Versão 7: Refatorando o código para que fique mais legível
#           adicionadas opções -d e --delemiter 
#
# Autor: Guilherme Henrique - Data: 2024-04-21


# COLOCANDO FLAGS(CHAVES) - DITAM O PERCUSO DO SCRIPT

ordenar=0 # A sáida deverá ser ordenada? 
inverter=0 # A sáida deverá ser invertida?
maiusculas=0 # A sáida deverá ser em maiúsculo?
delim='\t' # a sáida padrão é TAB

# COLOCANDO CONSTANTES - VARIÁVEIS QUE NÃO DEVEM SER ALTERADAS DURANTE A EXECUÇÃO DO SCRIPT.

# basename "$0" -> é um comando que retorna apenas o nome do arquivo do script, sem o caminho completo.

MENSAGEM_USO="
Uso: $(basename "$0") [-h, --help | -V, --version | -s, --sort | -r, --reverse | -u, --uppercase | -d ou --delemiter]\n\n[-h ou --help] -> mostra saida de ajuda;\n\n[-V ou --version] -> mostra a versão do script e sai do programa;\n\n[-s ou --sort] -> ordena a listagem alfabéticamente;\n\n[-r ou --reverse] -> inverte a ordem da listagem;\n\n[-u ou --uppercase] -> mostra os elementos da listagem em maiúsculas;\n\n[-d ou --delemiter] -> indica qual é o caracter delemitador no stdout(saida_padrão).
"

# definindo nome da pasta que vamos nos alocar independentemente de onde tivermos 
ROOT_TO_ETC="/etc"

# APARTIR DAQUI O CÓDIGO NÃO PODE SER MODIFICADO POR USUÁRIOS COMUNS (LEIGOS)

# ; é um separador no shellscript... útilo para indicar continuidade
while test -n "$1";do
    
    case "$1" in
        
        # Opções que ligam/desligam chaves
        
         # | -> operador lógico ou
        -s | --sort) ordenar=1 ;; # ;; indica o fim da primeira condicação
        -r | --reverse) inverter=1 ;;
        -u | --uppercase) maiusculas=1 ;;
        
        -d | --delemiter)

            shift # puxa o próximo argumento e executa. caso atenda a condição do while

            # perceba que o delim rescebe um valor direto do prompt dado pelo usuário
            # exemplo: ./usuarios-v5.sh -d ,

            # com esse shift mais manual, o comando -d é discartado salvando
            # na variável (flag) delim a virgula escrita pelo usuário

            delim="$1"

            if test -z "$delim";then

                # O operador -z é o oposto do -n 
                # Enquanto o -n (nonzero) verifica se a variável tem conteúdo o -z (zero) 
                # verifica se a variável está vazia.
                
                echo -e "Faltou o argumento para a opção -d"
                
                exit 1
            
            fi # fim se
        ;;

        -h | --help) 
            echo -e "\nEste script mostra os logins e nomes de usuários do sistema.\nLendo os dados do arquivo /etc/passwd."
            echo -e "$MENSAGEM_USO"
            exit 0
            # vou deixar o echo -e para fins didáticos, pois ele permite quebra de linha com \n
        ;; 

        -V | --version)

            version=$(grep "Versão [0-9]" "$0" | tail -1 | cut -d ":" -f 1 | tr -d "\\# ")
            
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
        
        *) 
            # * é um curinga que indica que qualquer outra opção 
            # que não seja as qeu estão no código são considerada inválida.

            # -n é um operador de teste que verifica se a string fornecida pelo usuário 
            # como argumento no primeiro prâmetro não está vazia.
            # exemplo: ./usuarios-v7 - | .usuarios-v7 -v
            # vão cair nesta condição!

            if test -n "$1";then

                printf "Opção inválida: $1"
                exit 1 
            fi

            # Para fins didáticos vou deixar como funcionar a passagem de argumentos
            # como parâmetros no terminal pelo usuário de forma resumida:

            #      $0       $1 $2 $3 $4 $5
            # ./usuarios-v7 -s -u -r -d ,

        ;;
    
    esac # fim case

    shift 
done

move=$(cd $ROOT_TO_ETC; pwd) 

printf "Movendo-se para o diretório: $move\n\n"

# realiza a listagem de usuários logados
lista=$(cut -d : -f 1,5 $move/passwd)

# tirando aqule monte de if da sexta versao

# Ordena, inverte ou converte para maiúsculas (se necessário)
test "$ordenar" -eq 1 && lista=$(echo "$lista" | sort)
test "$inverter" -eq 1 && lista=$(echo "$lista" | tac)
test "$maiusculas" -eq 1 && lista=$(echo "$lista" | tr a-z A-Z)

echo "$lista" | tr : "$delim"
