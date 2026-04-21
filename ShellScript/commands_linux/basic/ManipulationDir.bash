# Agora vamos aprender alguns comandos de manipulacao diretorio


# dirname + variavel ou caminho absoluto/relativo de um file -> retorna o caminho/nome do diretório onde aquele arquivo está

pathFile="ShellScript/Bash/basic/ManipulationDir.bash"
echo $(dirname "$pathFile") # ShellScript/Bash/basic

# lembrando que no terminal podemos escrever: dirname caminho_arquivo
# sem precisar vincular em uma variável ou algo do tipo... Mas como estamos treinando
# ShellScript, é necessário realizar esse procedimento

# basename + variavel ou caminho absoluto/relativo de um path -> Retorna o ultim nome completo do ultimo nome ou arquivo passado no caminho específicado
pathFile="ShellScript/Bash/basic/ManipulationDir.Bash"
echo $(basename "$pathFile") # ManipulationDir.Bash