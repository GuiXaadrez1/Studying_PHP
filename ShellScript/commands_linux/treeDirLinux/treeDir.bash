# Aqui vamos aprender um pouco sobre a árvore de diretórios do Linux!

# É uma árvore de diretório invertida onde a raiz fica encima e os ramos são as folhas...

# \ -> é o root (diretório raiz)
# esse diretório é responsável por:

$ROOT
echo $(cd "/"; pwd)

# $SHELL (variável de ambiente/sistema) -> Retorna o Diretório: /bin/bash
# esse diretório é responsável por:

echo (cd "$SHELL";pwd)

# $HOME (variável de ambiente/sistema) -> Retorna o Diretório: /bin/bash
# esse diretório é responsável por: é a pasta de usuário!

# pwd -> retorna o caminho atual que o usuário se encontra!