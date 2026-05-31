# ============================================================
# Aula 5 — ESTRUTURAS DE CONTROLE E REPETIÇÃO NO POWERSHELL
# ============================================================

# ============================================================
# IF / ELSEIF / ELSE — estrutura de decisão
# ============================================================
# executa blocos de código com base em condições booleanas
# equivalente ao if/elseif/else do PHP e Python
# IMPORTANTE: no PowerShell os operadores de comparação são -eq, -gt, -lt etc.
# nunca use == ou != como no PHP/Python — não funcionam para comparação lógica

Write-Host "======= IF / ELSEIF / ELSE ======="
$idade = 20

if ($idade -lt 18) {
    Write-Host "Menor de idade"
} elseif ($idade -eq 18) {
    Write-Host "Tem exatamente 18 anos"
} else {
    Write-Host "Maior de idade"   # executa pois $idade = 20
}

# ============================================================
# SWITCH — estrutura de múltipla escolha
# ============================================================
# avalia uma expressão contra múltiplos casos
# equivalente ao switch do PHP e C# e ao match do Python
# VANTAGEM sobre o if/else: mais legível quando há muitos casos
# IMPORTANTE: o PowerShell executa TODOS os casos que correspondem
#             use break para interromper após o primeiro caso correspondente

Write-Host "======= SWITCH ======="
$diaSemana = "Segunda"

switch ($diaSemana) {
    "Segunda"  { Write-Host "Início da semana!"; break }
    "Sexta"    { Write-Host "Quase fim de semana!"; break }
    "Sábado"   { Write-Host "Fim de semana!"; break }
    "Domingo"  { Write-Host "Fim de semana!"; break }
    default    { Write-Host "Dia comum de semana" }  # executado se nenhum caso corresponder
}

# switch também funciona com -wildcard (curinga) e -regex (expressão regular)
Write-Host "--- Switch com Wildcard ---"
$linguagem = "PowerShell"

switch -wildcard ($linguagem) {
    "Power*"  { Write-Host "É uma linguagem Power!"; break }
    "Py*"     { Write-Host "É Python!"; break }
    default   { Write-Host "Outra linguagem" }
}

# ============================================================
# FOR — loop com contador
# ============================================================
# executa um bloco de código um número determinado de vezes
# equivalente ao for do PHP, Python e C#
# estrutura: for (inicialização; condição; incremento)

Write-Host "======= FOR ======="
for ($i = 0; $i -lt 5; $i++) {
    Write-Host "Iteração: $i"   # imprime 0, 1, 2, 3, 4
}

# ============================================================
# FOREACH — loop de coleção
# ============================================================
# itera sobre cada elemento de um array ou coleção
# equivalente ao foreach do PHP ou for...in do Python
# VANTAGEM: mais legível que o for quando não precisa do índice

Write-Host "======= FOREACH ======="
$linguagens = @("PowerShell", "Bash", "Python", "C#")

foreach ($linguagem in $linguagens) {
    Write-Host "Linguagem: $linguagem"
}

# foreach também funciona via Pipeline com ForEach-Object
# útil para encadear com outros cmdlets
Write-Host "--- ForEach-Object via Pipeline ---"
$linguagens | ForEach-Object {
    Write-Host "Via pipeline: $_"   # $_ é a variável automática que representa o elemento atual
}

# ============================================================
# WHILE — loop com condição de entrada
# ============================================================
# executa enquanto a condição for $true
# a condição é verificada ANTES de cada iteração
# equivalente ao while do PHP e Python
# CUIDADO: se a condição nunca se tornar $false, o loop é infinito

Write-Host "======= WHILE ======="
$contador = 0

while ($contador -lt 5) {
    Write-Host "While contador: $contador"
    $contador++   # incrementa para evitar loop infinito
}

# ============================================================
# DO WHILE — loop com condição de saída
# ============================================================
# executa o bloco pelo menos UMA vez, depois verifica a condição
# diferente do while que verifica ANTES — o do/while verifica DEPOIS
# equivalente ao do/while do PHP e C#

Write-Host "======= DO WHILE ======="
$contador = 0

do {
    Write-Host "Do While contador: $contador"
    $contador++
} while ($contador -lt 5)

# ============================================================
# DO UNTIL — loop até que a condição seja verdadeira
# ============================================================
# executa o bloco até que a condição se torne $true
# é o INVERSO do do/while — roda enquanto a condição for $false
# não existe equivalente direto no PHP/Python — é exclusivo do PowerShell

Write-Host "======= DO UNTIL ======="
$contador = 0

do {
    Write-Host "Do Until contador: $contador"
    $contador++
} until ($contador -ge 5)   # para quando $contador for maior ou igual a 5

# ============================================================
# BREAK E CONTINUE — controle de fluxo dentro de loops
# ============================================================
# break    -> interrompe o loop imediatamente e sai dele
# continue -> pula para a próxima iteração sem executar o restante do bloco
# equivalente ao break/continue do PHP e Python

Write-Host "======= BREAK E CONTINUE ======="
for ($i = 0; $i -lt 10; $i++) {
    if ($i -eq 3) { continue }   # pula o número 3
    if ($i -eq 7) { break }      # para no número 7
    Write-Host "Número: $i"      # imprime 0, 1, 2, 4, 5, 6
}

# ============================================================
# TRY / CATCH / FINALLY — tratamento de erros
# ============================================================
# captura erros em tempo de execução sem travar o script
# equivalente ao try/catch/finally do PHP e C#
# IMPORTANTE: por padrão o PowerShell não lança exceções em todos os erros
#             use $ErrorActionPreference = "Stop" para forçar o comportamento

Write-Host "======= TRY / CATCH / FINALLY ======="
$ErrorActionPreference = "Stop"   # força todos os erros a lançarem exceção capturável

try {
    $resultado = 10 / 0           # operação inválida — lança exceção
    Write-Host "Resultado: $resultado"
} catch {
    Write-Host "Erro capturado: $($_.Exception.Message)"   # $_ representa o objeto de erro
} finally {
    Write-Host "Finally sempre executa — independente de erro ou sucesso"
}

# ============================================================
# FUNÇÕES — blocos de código reutilizáveis
# ============================================================
# encapsulam lógica para reutilização — equivalente às functions do PHP e def do Python
# no PowerShell funções são declaradas com a keyword function
# parâmetros são declarados com param() ou diretamente na assinatura

Write-Host "======= FUNÇÕES ======="

# função simples sem parâmetros
function Saudacao {
    Write-Host "Olá, PowerShell!"
}
Saudacao   # invocação da função

# função com parâmetros tipados
# [string] e [int] garantem que os tipos corretos sejam passados
function SaudacaoComNome {
    param(
        [string]$nome,   # parâmetro do tipo string
        [int]$idade      # parâmetro do tipo inteiro
    )
    Write-Host "Olá, $nome! Você tem $idade anos."
}
SaudacaoComNome -nome "PowerShell" -idade 7   # passagem de parâmetros por nome

# função com retorno de valor
# return devolve o valor para quem chamou a função — igual ao return do PHP e Python
function Somar {
    param([int]$a, [int]$b)
    return $a + $b
}
$resultado = Somar -a 10 -b 5
Write-Host "Resultado da soma: $resultado"