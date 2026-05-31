# ============================================================
# Aula 4 — OPERADORES DO POWERSHELL
# ============================================================

# ============================================================
# OPERADORES ARITMÉTICOS
# ============================================================
# realizam cálculos matemáticos entre valores numéricos
# funcionam igual ao Bash e linguagens como PHP e Python

$a = 10
$b = 3

Write-Host "======= OPERADORES ARITMÉTICOS ======="
Write-Host "Adição:          $($a + $b)"   # 13 — soma
Write-Host "Subtração:       $($a - $b)"   # 7  — subtração
Write-Host "Multiplicação:   $($a * $b)"   # 30 — multiplicação
Write-Host "Divisão:         $($a / $b)"   # 3.333... — divisão real, retorna [double]
Write-Host "Módulo/Resto:    $($a % $b)"   # 1  — resto da divisão inteira, igual ao % do PHP e Python

# ============================================================
# OPERADORES DE COMPARAÇÃO
# ============================================================
# retornam sempre um valor booleano: $true ou $false
# diferente do Bash que usa -eq, -ne etc. em qualquer contexto
# no PowerShell esses operadores são usados tanto em scripts quanto em condicionais

Write-Host "======= OPERADORES DE COMPARAÇÃO ======="
Write-Host "-eq  (igual):              $(10 -eq 10)"   # $true  — equal
Write-Host "-ne  (diferente):          $(10 -ne 5)"    # $true  — not equal
Write-Host "-gt  (maior que):          $(10 -gt 5)"    # $true  — greater than
Write-Host "-lt  (menor que):          $(10 -lt 5)"    # $false — less than
Write-Host "-ge  (maior ou igual):     $(10 -ge 10)"   # $true  — greater or equal
Write-Host "-le  (menor ou igual):     $(5  -le 10)"   # $true  — less or equal
Write-Host "-like (curinga *):         $("PowerShell" -like "Power*")"  # $true — equivalente ao LIKE do SQL
Write-Host "-match (regex):            $("PowerShell" -match "^Power")" # $true — comparação com expressão regular

# ============================================================
# OPERADORES LÓGICOS
# ============================================================
# combinam expressões booleanas — equivalente ao && || ! do Bash e PHP

Write-Host "======= OPERADORES LÓGICOS ======="
Write-Host "-and (E lógico):           $($true -and $false)"  # $false — ambos precisam ser $true
Write-Host "-or  (OU lógico):          $($true -or  $false)"  # $true  — basta um ser $true
Write-Host "-not (NÃO lógico):         $(-not $true)"         # $false — inverte o booleano
Write-Host "-xor (OU exclusivo):       $($true -xor $true)"   # $false — $true apenas quando são diferentes

# ============================================================
# OPERADORES DE REDIRECIONAMENTO
# ============================================================
# redirecionam o stdout/stderr para arquivos — muito usado no Bash com > e >>
# no PowerShell o comportamento é o mesmo, mas com suporte a streams numerados do .NET

Write-Host "======= OPERADORES DE REDIRECIONAMENTO ======="
# > redireciona o stdout para um arquivo, SOBRESCREVENDO o conteúdo existente
"Sobrescrevendo o arquivo" > .\output.txt

# >> redireciona o stdout para um arquivo, ACRESCENTANDO ao conteúdo existente
"Acrescentando nova linha" >> .\output.txt

# 2> redireciona o stream de ERRO (stderr) para um arquivo
# equivalente ao 2> do Bash
Get-Item .\arquivoInexistente.txt 2> .\erros.txt

# *> redireciona TODOS os streams (stdout + stderr) para um arquivo
Get-Item .\arquivoInexistente.txt *> .\tudo.txt

Write-Host "Redirecionamentos gravados nos arquivos output.txt, erros.txt e tudo.txt"

# ============================================================
# OPERADORES SPLIT E JOIN
# ============================================================
# -split divide uma string em um array com base em um delimitador
# -join  une os elementos de um array em uma string com um separador
# equivalente ao explode()/implode() do PHP ou split()/join() do Python

Write-Host "======= OPERADORES SPLIT E JOIN ======="
$frase = "PowerShell é muito poderoso"
$palavras = $frase -split " "                        # divide pelo espaço — retorna um array
Write-Host "Split: $palavras | Tipo: $($palavras.GetType().Name)"
Write-Host "Elemento 0: $($palavras[0])"             # acesso por índice

$unido = $palavras -join "-"                         # une os elementos com hífen como separador
Write-Host "Join: $unido"

# ============================================================
# OPERADORES DE TIPO
# ============================================================
# inspecionam ou convertem o tipo de um objeto em tempo de execução

Write-Host "======= OPERADORES DE TIPO ======="
$numero = 42

# -is verifica se o objeto é de um tipo específico — retorna $true ou $false
Write-Host "-is  [int]:    $($numero -is [int])"     # $true
Write-Host "-is  [string]: $($numero -is [string])"  # $false

# -isnot é o inverso do -is
Write-Host "-isnot [string]: $($numero -isnot [string])" # $true

# -as tenta converter o objeto para o tipo especificado
# se a conversão falhar, retorna $null ao invés de lançar erro (diferente do cast direto [tipo])
$convertido = $numero -as [string]
Write-Host "-as [string]: $convertido | Tipo: $($convertido.GetType().Name)"

# ============================================================
# OPERADORES UNÁRIOS
# ============================================================
# operam sobre uma única variável — incremento e decremento igual ao C# e PHP

Write-Host "======= OPERADORES UNÁRIOS ======="
$x = 5
$x++    # incrementa 1 — equivalente a $x = $x + 1
Write-Host "Após ++: $x"   # 6

$x--    # decrementa 1 — equivalente a $x = $x - 1
Write-Host "Após --: $x"   # 5

$x += 3 # incrementa pelo valor informado
Write-Host "Após += 3: $x" # 8

$x -= 2 # decrementa pelo valor informado
Write-Host "Após -= 2: $x" # 6

$x *= 2 # multiplica e atribui
Write-Host "Após *= 2: $x" # 12

$x /= 3 # divide e atribui
Write-Host "Após /= 3: $x" # 4

# ============================================================
# OPERADORES ESPECIAIS
# ============================================================

Write-Host "======= OPERADOR DE CHAMADA & ======="
# & (operador de chamada) executa um comando, script ou bloco de código armazenado em uma variável
# equivalente ao call do Batch ou ao eval do Bash
$cmd = "Get-Date"
& $cmd   # executa o cmdlet Get-Date armazenado na variável $cmd

Write-Host "======= OPERADOR DE REFERÊNCIA . (PONTO) ======="
# . acessa propriedades e métodos de instância de um objeto
# equivalente ao . do Python e Java
$texto = "PowerShell"
Write-Host "Propriedade: $($texto.Length)"      # acessa a propriedade Length
Write-Host "Método:      $($texto.ToUpper())"   # invoca o método ToUpper()

Write-Host "======= OPERADOR DE ORIGEM DE PONTO (DOT SOURCING) ======="
# . seguido de um caminho de script carrega o conteúdo do script no escopo ATUAL
# diferente de chamar o script normalmente, que executa em um escopo filho (sub-shell)
# equivalente ao source ou . do Bash
# . .\outroScript.ps1  <- carrega as variáveis e funções do script no escopo atual

Write-Host "======= OPERADOR DE MEMBRO ESTÁTICO :: E ::new() ======="
# :: acessa membros estáticos de uma classe .NET sem precisar instanciar um objeto
# ::new() é o construtor estático — instancia um objeto da classe diretamente
# equivalente ao :: do PHP para membros estáticos
$lista = [System.Collections.Generic.List[string]]::new()  # instancia uma List<string> do .NET
$lista.Add("PowerShell")
$lista.Add("Bash")
Write-Host "Lista criada com ::new(): $($lista[0]), $($lista[1]) | Tipo: $($lista.GetType().Name)"

Write-Host "======= OPERADOR DE INTERVALO .. ======="
# .. gera uma sequência numérica entre dois valores — equivalente ao range() do Python
# muito útil para loops e fatiamento de arrays
$intervalo = 1..10
Write-Host "Intervalo 1..10: $intervalo"
Write-Host "Tipo: $($intervalo.GetType().Name)"

Write-Host "======= OPERADOR DE FORMATAÇÃO -f ======="
# -f formata uma string usando placeholders indexados {0} {1} {2}
# equivalente ao [string]::Format() do .NET ou ao printf() do Bash
# mais limpo e legível que concatenação direta
$nome  = "PowerShell"
$versao = 7
$resultado = "linguagem: {0} | versão: {1}" -f $nome, $versao
Write-Host $resultado

Write-Host "======= OPERADOR DE SUBEXPRESSÃO \$() ======="
# $() força a avaliação de uma expressão dentro de uma string ou contexto
# sem ele, o PowerShell interpreta o conteúdo como texto literal
# equivalente à Substituição de Comando $() do Bash
$data = "Hoje é: $(Get-Date)"
Write-Host $data

Write-Host "======= OPERADOR DE SUBEXPRESSÃO DE MATRIZ @() ======="
# @() constrói um array a partir de uma expressão ou lista de valores
# garante que o resultado sempre seja um array, mesmo que retorne apenas 1 elemento
# equivalente ao [] do Python ou array() do PHP
$array = @(1, 2, 3, 4, 5)
Write-Host "Array @(): $array | Tipo: $($array.GetType().Name) | FullName: $($array.GetType().FullName)"

Write-Host "======= OPERADOR VÍRGULA , ======="
# , separa elementos para construir um array — é o operador de construção implícita de matriz
# @() usa , internamente — mas a vírgula sozinha também cria arrays fora do @()
# ATENÇÃO: vírgula antes de um valor único cria um array com 1 elemento (array aninhado)
$matrizVirgula = 1, 2, 3
Write-Host "Matriz com vírgula: $matrizVirgula | Tipo: $($matrizVirgula.GetType().Name)"

$aninhado = ,@(1,2,3)   # vírgula antes do array cria um array de arrays (matriz aninhada)
Write-Host "Array aninhado: $($aninhado[0]) | Tipo: $($aninhado.GetType().Name)"