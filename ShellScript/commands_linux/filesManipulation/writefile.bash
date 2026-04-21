# Vamos ler um arquivo com o comando cat e jogar para um arquivo.txt 
# e jogar no atual diretório deste script

# 1. Pega o diretório atual
currentDir=$(pwd)

# 2. Pega o caminho absoluto do arquivo alvo (sem mudar de pasta)
# O 'readlink -f' resolve o caminho ../ para um caminho completo

targetFile=$(readlink -f ../basic/FirstCode.bash)

echo "dir base: $currentDir" 
sleep 1

# 3. Corrigindo o nome da variável (targetFile)
echo "file target: $targetFile"

# 4. Lendo o conteúdo e jogando para um arquivo no diretório atual
# &1: Indica que o destino é o "descritor 1" (o arquivo txt), 
# e não um arquivo chamado literalmente "1".

cat "$targetFile" > arquivo_copiado.txt 2>&1

echo "Conteúdo copiado com sucesso para arquivo_copiado.txt"


