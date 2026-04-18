#!/bin/bash

#
#
# seq.sh - Emulação do comando seq (Sequence) do Linux em Bash
#
# O comando seq recebe dois numéros e mostra na saída padrão todos os números
# existentes entre eles, inclusive. Essa sequÊncia está pronta para ser usada pelo comando
# FOR. Caso o número inicial , é urilizando o valor 1

o=+ # valor que a operação pode ser feita. Pode ser incremental ou decremental + ou - 
a=1 #  valor inicial padrão

z=${1:-1} # z rescebe o valor que o usuário passa ou entao rescebe por padrao o valor 1

echo $z

#########################################################################################
#
#
# ${ ... }: As chaves indicam uma Expansão de Parâmetro. 
# Elas dizem ao Shell para avaliar o que está lá dentro de uma forma especial, 
# em vez de apenas ler o texto literalmente.
#
# 1: Este é o Parâmetro Posicional $1. Ele representa o primeiro argumento que 
# você digita logo após o nome do script no terminal.
# Exemplo: Se você rodar ./meu_script.sh 50, o $1 vale 50.
#
# :- Este é o operador "Valor Padrão". Ele testa se a variável à esquerda (1) 
# está vazia ou não definida.
#
# 1 (o último): Este é o valor que será usado caso o teste anterior falhe
# (ou seja, se $1 estiver vazio).
#
#    Imagine que o nome do seu arquivo é teste.sh:
#
#    Cenário A: Você passa um valor
#       
#    bash teste.sh 99
#    
#    O Shell vê que $1 é 99.
#
#    A variável z recebe o valor 99.
#
#    Cenário B: Você não passa nada
#  
#    bash teste.sh
#    
#   O Shell vê que $1 está vazio.
#
#    O operador :- entra em ação e usa o reserva.
#
#    A variável z recebe o valor 1.
#
########################################################################################


###########################################################################################
# Ele verifica se o segundo argumento ($2) existe e não é uma string vazia. 
# Se houver algo em $2, o script executa o bloco entre chaves, atribuindo $1 à variável a 
# e $2 à variável z.
##########################################################################################

[   "$2"    ] && { # Em Shell Script, os colchetes [ ] são, na verdade, um comando (também chamado de test).
    a=$1    # && (O Operador "E" Lógico)
    z=$2    # { ... } (O Bloco de Comandos) As chaves servem para agrupar múltiplos comandos para que o Shell os trate como uma unidade única em relação ao operador &&.
}



[   $a -gt $z   ] && o=- # -gt: É a abreviação de "Greater Than" (maior que). 
                    # No Shell, usamos essas siglas para comparar números, 
                    # em vez do símbolo >.


# TABELA DE OPERADORES

# -gt -> Greater Than -> Maior que
# -ge -> Greater or Equal -> Maior ou igual
# -lt -> Less Then -> Menor que
# -le -> Less or Equal -> Menor ou igual
# -eq -> Equal -> Igual
# -ne -> Not Equal -> Diferente 


###############################################################################################
# Aqui nete laço de repetilção While "Enquanto", fazemos o teste... se verdadeiro
# entra dentro da conficao do loop se falso exibimos o resultado.
###############################################################################################

while [ $a -ne $z   ]; do # O ponto e vírgula no Shell serve para separar comandos na mesma linha.
    echo $a

    # O eval serve para executar uma linha de comando que foi montada dinamicamente
    # como uma string.

    eval "a=\$((a $o 1))"

    # neste caso estamos usando o eval para atrbibuir um novo valor
    # para variavel, esse novo valor é processando com uma Expansão Aritmética
    # do Shell Script...

    # ATENÇÃO!
    
    # ${variável}: Expansão de Parâmetros (Parameter Expansion)
        
        # Este é o nome técnico. "Parâmetro" é como o Shell chama as variáveis e os argumentos de entrada ($1, $2, etc.).

        # O que faz: Atua sobre o valor de algo que já existe na memória.

        # Por que as chaves? Elas servem para delimitar o nome do parâmetro ou para aplicar modificadores (como o :- que vimos, que se chama tecnicamente Default Value Expansion).

        # Exemplo: ${nome} ou ${1:-padrão}.
    
    # $(comando): Substituição de Comando (Command Substitution)
        
        # O que faz: O Shell cria um "subshell" (uma instância filha), 
        # executa o comando lá dentro, pega tudo o que esse comando imprimiu no 
        # "Standard Output" (a tela) e coloca de volta na linha de comando original.

        # Exemplo: pasta_atual=$(pwd).

    # Expansão Aritmética (Arithmetic Expansion)

        # Este é o modo "calculadora" do Shell.
        # O que faz: Avalia uma expressão matemática e retorna o resultado numérico.
        
        # Diferença crucial: Dentro de $(( )), você não precisa usar o $ para chamar as 
        # variáveis (embora possa). Você pode escrever $((a + b)) em vez de $(($a + $b)).

        # Exemplo: resultado=$((10 * 5)).

done

echo $a