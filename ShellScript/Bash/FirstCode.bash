#!/bin/bash

# COMANDOS INICIAS PARA APRENDER

# ls -> lista elementos do diretório atual
# pwd -> obtem o diretório atual
# clear -> limpa as informações exibida pelo terminal 
# reset -> reseta o terminal 

# REGRAS DE OURO PARA CRIAR VARIÁVEIS NO BASH

# 1 - Sem espaços no "=": NOME="Guto" funciona. NOME = "Guto" vai dar erro.

# 2 - Definição vs. Uso: Você define sem o cifrão (VAR=10) e usa/chama com o cifrão (echo $VAR).

# ATRIBUINDO COMANDOS A VARIÁVEIS

# 1 - A forma moderna (Recomendada): VAR=$(comando)

# 2 - A forma antiga (Crase): VAR=comando``


# 1. Criando uma variável de texto simples

mensagem="Iniciando o script de gerenciamento..."
echo "$mensagem"

# 2. Capturando a saída do comando 'pwd'

# Se você usar exb=$pwd, o Bash vai procurar uma variável chamada 'pwd' (que está vazia)
# Usamos $(comando) para executar e guardar o resultado
diretorio_atual=$(pwd)

# 3. Exibindo o resultado
echo "O endereço atual do servidor é: $diretorio_atual"

# 4. Pausa dramática antes de limpar (opcional)
sleep 3

# 5. Limpando o terminal
clear
echo "Terminal limpo e script finalizado!"