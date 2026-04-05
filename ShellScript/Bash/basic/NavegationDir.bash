# Aqui iremos aprender um pouco sobre manipulacao de diretórios

# \ -> é a pasta raiz ou root (c) do linux

# ~ -> representa o seguinte caminho: root\home\user 
# no caso do wsl ->  retorna isso -> bash: /c/Users/FABIA: Is a directory

# cd -> é o comando usado para mudar de diretório

# podemos colocar espaço + .. -> para descer uma casa
# podemos colocar o nome do subdiretório para nos movermos até lá
# podemos  colcoar o baminho absoluto ou relativo para mudar de endereço do diretório

# Faça um código puxando o diretório atual e depois usar os conceitos descrito acima


# usando substituição de comando (command substitution).
dirBase=$(pwd)

echo "O endereço atual do servidor é: $dirBase"

sleep 2

# exibe a pasta pessoal... usuário do sistema
# ~ não é comando, nem função.
# Ele é apenas um atalho de expansão de caminho (tilde expansion)

# echo$(~) $ forma errada de executar

echo "Path user:" ~ # forma certa de executar 

# agora vou descer dois caminhos (no linux a barra é invertida!)
echo "Path: "$(cd ../..; pwd)

# Neste caso, o cd acontece apenas dentro de um "subshell". 
# Você verá o caminho lá de cima no terminal, 
# mas continuará na mesma pasta de antes.

# Agora eu vou mostrar a pasta raiz (root)
echo "Path Root: "$(cd /;pwd)

# Podemos literalmente nos navegar usando a variável de ambiente $HOME
echo "Path Home:" $HOME

# Agora vou mostrar a pasta downloads

echo "Path Downloads: "$(cd ~/Downloads)