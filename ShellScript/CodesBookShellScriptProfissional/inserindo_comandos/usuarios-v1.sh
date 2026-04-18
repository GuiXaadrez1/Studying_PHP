#!/bin/bash
# usuarios-v1.sh
#
# Vamos aprender a colocar opções de linha de comando em nossos scripts.
#
# Mosta os logins e nomes de usuários do sistema
# Obs.: Lê dados do arquivo /etc/passwd
# 
# O diretório /etc - contém arquivos de configuração do sistema, e o arquivo passwd é um 
# dos mais importantes, pois armazena informações sobre os usuários do sistema, como seus
# logins, senhas (geralmente criptografadas), IDs de usuário (UIDs), IDs de grupo (GIDs), 
# diretórios home e shells de login. 
# 
# Autor: Guilherme Henrique - Data: 2024-06-01

ROOT_TO_ETC="/etc"

# lemnrando que $(...) é chamado de substituição de comando, e é usado para executar um comando e capturar sua saída.

move=$(cd $ROOT_TO_ETC; pwd)         # O comando cd é usado para mudar o diretório atual. 
                                    # O comando pwd (print working directory) exibe o caminho do diretório atual.
                                    # A combinação de cd e pwd é uma maneira comum de obter o caminho absoluto de um diretório específico.
                                    # através de um subshell (o que é indicado pelos parênteses), o comando cd $ROOT_TO_ETC é executado para mudar para o diretório /etc, e em seguida, pwd é executado para obter o caminho absoluto do diretório /etc.
                                    # O resultado é armazenado na variável move.

# echo "O caminho absoluto do diretório /etc é: $move"

cut -d : -f 1,5 $move/passwd 

# cut - é um comando do Linux usado para extrair seções de cada linha de um arquivo ou 
# entrada de texto.

# Parametros do cut:
# -d : - Especifica o delimitador que separa os campos. No caso do arquivo /etc/passwd, os campos são separados por dois pontos (:).
# -f 1,5 - Especifica (campos/coluna) quais campos devem ser extraídos. O número 1 indica o primeiro campo (o login do usuário) e o 5 indica a quinta coluna 
# -c - Especifica quais caracteres devem ser extraídos. Por exemplo, -c 1-5 extrairia os primeiros cinco caracteres de cada linha.