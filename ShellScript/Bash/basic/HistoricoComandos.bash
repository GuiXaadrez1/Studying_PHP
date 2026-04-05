# history -> basicamente é um comando que mostra todos os últimos comandos que usamos

# Ele tem um numero do registro de comandos que podemos usar para reutilizar, basta usar:

# !codComandListing -> exemplo: !277

# também é possível executar o último comando solicitado com base em um nome de comando...
# exemplo: !clear -> ele percorre a lista de comandos de trás para frente e executa o ultímo comando encontrado.

# Podemos executar o ultimo comando passando:  !!

# podemos juntar history + tail para listar os ultimos n comandos que definirmos em tail
# exemplo: history | tail -5

# podemos fazer o seguinter... stdin | stdout write stdin/stdout/stderr (arquivo.txt) 

# O pipe (|) conecta esse stdout diretamente no stdin do tail.

# 1. Ativa o recurso de histórico dentro do script
set -o history

# 2. Define onde o Bash busca o aquivo de histórico
ARQUIVO_LOG="saida_history.txt"

# 3. Lê o conteúdo do arquivo de histórico para a memória da sessão atual
history -r

# pega os ultimos cinco comandos e salve no arquivo.txt
history | tail -5 > saida_history.txt 2>&1
echo "Log gerado com sucesso em $ARQUIVO_LOG"

#  [FONTE]    |   [DESTINO]
#  history    |   tail -5

#  (stdout)  ---> (stdin)

# > saida_history.txt: Redireciona o STDOUT (saída padrão) para o arquivo (usamos a sobrescrita para isso)

# 2>&1: Redireciona o STDERR (erros) para onde o STDOUT está apontando naquele momento

#0: stdin (entrada)
#1: stdout (saída padrão)
#2: stderr (saída de erro)

# podemos escrever o comando acima assim: history | tail -5 &> saida_history.txt

# a diferença é que esse $> indica (pegue tudo "sucesso e erro") e injete no arquivo.txt

