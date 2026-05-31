# ============================================================
# Aula 6 — BREAK, CONTINUE, RÓTULOS, CONSTANTES E ASPAS
# ============================================================

# ============================================================
# BREAK — interrompe o loop imediatamente
# ============================================================
# ao encontrar o break, o PowerShell sai do loop e continua o script
# equivalente ao break do PHP e Python
# CUIDADO: o break só interrompe o loop mais interno por padrão

Write-Host "======= BREAK ======="
for ($i = 0; $i -lt 10; $i++) {
    if ($i -eq 5) {
        Write-Host "Break acionado no $i — saindo do loop!"
        break   # interrompe o loop quando $i chegar em 5
    }
    Write-Host "Iteração: $i"   # imprime 0, 1, 2, 3, 4
}
Write-Host "Script continua após o break"

# ============================================================
# CONTINUE — pula para a próxima iteração
# ============================================================
# ao encontrar o continue, o PowerShell ignora o restante do bloco
# e vai direto para a próxima iteração do loop
# equivalente ao continue do PHP e Python

Write-Host "======= CONTINUE ======="
for ($i = 0; $i -lt 10; $i++) {
    if ($i % 2 -eq 0) {
        continue   # pula os números pares — vai direto para o próximo $i
    }
    Write-Host "Número ímpar: $i"   # imprime apenas 1, 3, 5, 7, 9
}

# ============================================================
# RÓTULOS (LABELS) — controlam qual loop o break/continue afeta
# ============================================================
# por padrão, break e continue afetam apenas o loop mais interno
# com rótulos, você pode controlar loops externos diretamente
# SINTAXE: :nomeDoRotulo antes do loop, break nomeDoRotulo para sair dele
# não existe equivalente direto no PHP — no Python usa-se flags manuais

Write-Host "======= RÓTULOS COM BREAK ======="
# sem rótulo — o break só sai do loop interno (foreach interno)
for ($i = 1; $i -le 3; $i++) {
    foreach ($letra in @("A","B","C")) {
        if ($letra -eq "B") {
            Write-Host "Break sem rótulo — sai só do foreach"
            break   # sai apenas do foreach, o for externo continua
        }
        Write-Host "For $i | Letra $letra"
    }
}

Write-Host "---"

# com rótulo — o break sai do loop que tem o rótulo (for externo)
:loopexterno for ($i = 1; $i -le 3; $i++) {
    foreach ($letra in @("A","B","C")) {
        if ($letra -eq "B") {
            Write-Host "Break com rótulo — sai do for externo inteiro!"
            break loopexterno   # sai do for externo, encerrando tudo
        }
        Write-Host "For $i | Letra $letra"
    }
}

Write-Host "======= RÓTULOS COM CONTINUE ======="
# continue com rótulo pula para a próxima iteração do loop rotulado
:loopPrincipal for ($i = 1; $i -le 3; $i++) {
    foreach ($letra in @("A","B","C")) {
        if ($letra -eq "B") {
            Write-Host "Continue com rótulo — pula para próxima iteração do for externo"
            continue loopPrincipal   # pula para o próximo $i do for externo
        }
        Write-Host "For $i | Letra $letra"
    }
}

# ============================================================
# CONSTANTES — valores imutáveis em tempo de execução
# ============================================================
# no PowerShell, constantes são criadas com Set-Variable -Option Constant
# diferente de variáveis normais, constantes NÃO podem ser alteradas ou deletadas
# equivalente ao const do PHP e C# ou ao SCREAMING_SNAKE_CASE do Python por convenção
# IMPORTANTE: tentar reatribuir uma constante lança erro em tempo de execução

Write-Host "======= CONSTANTES ======="

# declarando uma constante — após criada, não pode ser alterada
Set-Variable -Name PI -Value 3.14159 -Option Constant
Write-Host "Valor de PI: $PI"

# tentando alterar a constante — vai lançar erro
try {
    $ErrorActionPreference = "Stop"
    Set-Variable -Name PI -Value 999   # erro! constante não pode ser alterada
} catch {
    Write-Host "Erro ao tentar alterar constante: $($_.Exception.Message)"
}

# READONLY — parecido com Constant, mas pode ser deletado com Remove-Variable -Force
Set-Variable -Name VERSAO -Value "1.0.0" -Option ReadOnly
Write-Host "Versão: $VERSAO"

# diferença entre Constant e ReadOnly:
# Constant  -> não pode ser alterada NEM deletada durante a sessão
# ReadOnly  -> não pode ser alterada, mas PODE ser deletada com -Force

# ============================================================
# DIFERENÇA ENTRE ASPAS SIMPLES E ASPAS DUPLAS
# ============================================================
# interpolação = a linguagem lê a string e SUBSTITUI automaticamente
# o nome da variável pelo seu valor antes de exibir na tela
# equivalente ao comportamento do Bash e PHP

$nome   = "PowerShell"
$versao = "7.0"
$idade  = 7

# ============================================================
# ASPAS DUPLAS "" — INTERPOLAÇÃO ATIVA
# ============================================================
# a linguagem lê a string e SUBSTITUI automaticamente
# o nome da variável pelo seu valor antes de exibir na tela
# equivalente às aspas duplas do PHP e Bash

Write-Host "======= ASPAS DUPLAS — interpolação ATIVA ======="

# sem interpolação — concatenação manual com +
# verboso, menos legível, mais suscetível a erros
$semInterpolacao = "Olá, " + $nome + "! Versão: " + $versao + " | Idade: " + $idade + " anos."
Write-Host "Sem interpolação: $semInterpolacao"

# com interpolação — a linguagem preenche os campos automaticamente
# mais limpo, mais legível, menos código
$comInterpolacao = "Olá, $nome! Versão: $versao | Idade: $idade anos."
Write-Host "Com interpolação: $comInterpolacao"

# interpolação com expressão $() — avalia e substitui o RESULTADO da expressão
# pense como um campo dinâmico que calcula antes de preencher
$comExpressao = "2 + 2 = $(2 + 2) | Nome em maiúsculo: $($nome.ToUpper())"
Write-Host "Com expressão: $comExpressao"

# ============================================================
# ASPAS SIMPLES '' — INTERPOLAÇÃO INATIVA
# ============================================================
# a linguagem trata tudo como texto LITERAL
# nenhuma variável é substituída — o $ é impresso como caractere comum
# equivalente às aspas simples do PHP e Bash
# use quando quiser exibir o texto exatamente como está escrito

Write-Host "======= ASPAS SIMPLES — interpolação INATIVA ======="

$semExpansao = 'Olá, $nome! Versão: $versao | Idade: $idade anos.'
Write-Host "Sem expansão: $semExpansao"    # imprime literalmente: Olá, $nome! Versão: $versao...

$semExpressao = '2 + 2 = $(2 + 2) | Nome em maiúsculo: $($nome.ToUpper())'
Write-Host "Sem expressão: $semExpressao"  # imprime literalmente: 2 + 2 = $(2 + 2)...

# ============================================================
# COMPARAÇÃO LADO A LADO
# ============================================================

Write-Host "======= COMPARAÇÃO LADO A LADO ======="
Write-Host "Duplas  -> Olá, $nome!"    # interpola  → Olá, PowerShell!
Write-Host 'Simples -> Olá, $nome!'    # literal    → Olá, $nome!

# ============================================================
# HERE-STRING — string multilinha
# ============================================================
# @" "@ -> aspas duplas — interpola variáveis
# @' '@ -> aspas simples — texto literal sem interpolação
# muito útil para JSON, XML, SQL ou qualquer texto com múltiplas linhas

Write-Host "======= HERE-STRING ======="

$hereStringDuplas = @"
Nome:    $nome
Versão:  $versao
Tipo:    Here-String com aspas duplas — interpola variáveis
"@
Write-Host $hereStringDuplas

$hereStringSimples = @'
Nome:    $nome
Versão:  $versao
Tipo:    Here-String com aspas simples — texto literal sem interpolação
'@
Write-Host $hereStringSimples

# ============================================================
# REGRA PRÁTICA
# ============================================================
# use aspas DUPLAS   → quando precisar que as variáveis sejam substituídas pelo valor
# use aspas SIMPLES  → quando quiser o texto exatamente como escrito, sem substituição