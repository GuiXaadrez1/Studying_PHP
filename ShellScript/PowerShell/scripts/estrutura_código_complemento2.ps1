# ============================================================
# Aula 7 — SUFIXOS, VARIÁVEIS, CMDLETS, STRINGS, WRITE-HOST, REGEX E ESCAPE
# ============================================================

# ============================================================
# SUFIXOS DE MULTIPLICADORES — representação de tamanhos numéricos
# ============================================================
# o PowerShell permite usar sufixos para representar valores grandes de forma legível
# muito útil para trabalhar com tamanhos de arquivos, memória e disco
# equivalente às constantes KB, MB, GB do C#

Write-Host "======= SUFIXOS DE MULTIPLICADORES ======="

$kb = 1KB    # 1 Kilobyte  = 1024 bytes
$mb = 1MB    # 1 Megabyte  = 1024 * 1024 bytes
$gb = 1GB    # 1 Gigabyte  = 1024 * 1024 * 1024 bytes
$tb = 1TB    # 1 Terabyte  = 1024 * 1024 * 1024 * 1024 bytes
$pb = 1PB    # 1 Petabyte  = 1024 * 1024 * 1024 * 1024 * 1024 bytes

Write-Host "1KB = $kb bytes"
Write-Host "1MB = $mb bytes"
Write-Host "1GB = $gb bytes"
Write-Host "1TB = $tb bytes"
Write-Host "1PB = $pb bytes"

# uso prático — verificando tamanho de arquivo em MB
$arquivo     = Get-Item .\aula7.ps1
$tamanhoEmMB = $arquivo.Length / 1MB
Write-Host "Tamanho do arquivo: $tamanhoEmMB MB"

# ============================================================
# VARIÁVEIS — declaração, tipos e escopos
# ============================================================
# no PowerShell toda variável começa com $ (cifrão)
# a tipagem é dinâmica — o PowerShell infere o tipo automaticamente
# mas você pode forçar um tipo usando [typecode] antes da variável

Write-Host "======= VARIÁVEIS ======="

# declaração simples — PowerShell infere o tipo automaticamente
$nome      = "PowerShell"    # inferido como [string]
$idade     = 7               # inferido como [int]
$preco     = 9.99            # inferido como [double]
$ativo     = $true           # inferido como [bool]

Write-Host "Nome:  $nome  | Tipo: $($nome.GetType().Name)"
Write-Host "Idade: $idade | Tipo: $($idade.GetType().Name)"
Write-Host "Preço: $preco | Tipo: $($preco.GetType().Name)"
Write-Host "Ativo: $ativo | Tipo: $($ativo.GetType().Name)"

# declaração tipada — força o tipo explicitamente
# lança erro em tempo de execução se o valor não for compatível com o tipo
[string]  $linguagem = "PowerShell"
[int]     $versao    = 7
[double]  $pi        = 3.14159
[bool]    $ligado    = $false

Write-Host "Linguagem: $linguagem | Tipo: $($linguagem.GetType().Name)"
Write-Host "Versão:    $versao    | Tipo: $($versao.GetType().Name)"

# variáveis especiais nativas do PowerShell
Write-Host "--- Variáveis Automáticas ---"
Write-Host "Versão do PowerShell: $($PSVersionTable.PSVersion)"   # versão atual do PowerShell
Write-Host "Diretório atual:      $PWD"                           # diretório de trabalho atual
Write-Host "Último erro:          $($Error[0])"                   # último erro ocorrido na sessão
Write-Host "PID do processo:      $PID"                           # ID do processo atual

# ============================================================
# ARMAZENANDO CMDLETS EM VARIÁVEIS
# ============================================================
# no PowerShell, o retorno de qualquer cmdlet é um OBJETO .NET
# esse objeto pode ser armazenado diretamente em uma variável
# diferente do Bash onde $() captura apenas texto — aqui capturamos o OBJETO completo
# isso permite acessar propriedades e métodos do resultado depois

Write-Host "======= CMDLETS DENTRO DE VARIÁVEIS ======="

# armazenando o retorno de Get-Date — retorna um objeto [datetime]
$dataAtual = Get-Date
Write-Host "Data atual:  $dataAtual"
Write-Host "Só o ano:    $($dataAtual.Year)"    # acessa a propriedade Year do objeto [datetime]
Write-Host "Só o mês:    $($dataAtual.Month)"   # acessa a propriedade Month do objeto [datetime]
Write-Host "Só o dia:    $($dataAtual.Day)"     # acessa a propriedade Day do objeto [datetime]

# armazenando o retorno de Get-Process — retorna um array de objetos [Process]
$processos = Get-Process
Write-Host "Total de processos rodando: $($processos.Count)"
Write-Host "Primeiro processo: $($processos[0].Name)"   # acessa o primeiro processo pelo índice

# armazenando o retorno de Get-Item — retorna um objeto [FileInfo]
$arquivo = Get-Item .\aula7.ps1
Write-Host "Nome do arquivo:  $($arquivo.Name)"
Write-Host "Tamanho em bytes: $($arquivo.Length)"
Write-Host "Última alteração: $($arquivo.LastWriteTime)"

# ============================================================
# STRING MULTILINHA
# ============================================================
# existem três formas de criar strings multilinhas no PowerShell

Write-Host "======= STRING MULTILINHA ======="

# FORMA 1 — concatenação com `n (caractere de escape de nova linha)
# útil para strings curtas com poucas quebras de linha
$multiLinha1 = "Linha 1`nLinha 2`nLinha 3"
Write-Host "Forma 1:`n$multiLinha1"

# FORMA 2 — string quebrada com acento grave ` (line continuation)
# o acento grave ` no final da linha indica que a string continua na próxima linha
# IMPORTANTE: não pode haver nenhum caractere após o ` — nem espaço
$multiLinha2 = "Linha 1 " + `
               "Linha 2 " + `
               "Linha 3"
Write-Host "Forma 2: $multiLinha2"

# FORMA 3 — Here-String @" "@ (recomendada para textos longos)
# preserva quebras de linha, tabulações e indentação exatamente como escrito
# as aspas de fechamento @" devem estar sempre no início da linha sem espaços
$multiLinha3 = @"
Linha 1
Linha 2
Linha 3 com variável interpolada: $nome
"@
Write-Host "Forma 3:`n$multiLinha3"

# Here-String com aspas simples — sem interpolação
$multiLinha4 = @'
Linha 1
Linha 2
Linha 3 sem interpolação: $nome
'@
Write-Host "Forma 4:`n$multiLinha4"

# ============================================================
# WRITE-HOST — exibição de saída no stdout
# ============================================================
# Write-Host é o cmdlet nativo para exibir texto na tela
# diferente do echo (alias de Write-Output), o Write-Host envia direto para o console
# e NÃO injeta o valor no pipeline — ou seja, outros cmdlets não capturam sua saída
# equivalente ao printf() do C e echo do Bash com mais controle de formatação

Write-Host "======= WRITE-HOST COM DETALHES ======="

# exibição simples
Write-Host "Texto simples"

# -ForegroundColor — define a cor do texto
# cores disponíveis: Black, DarkBlue, DarkGreen, DarkCyan, DarkRed, DarkMagenta,
#                    DarkYellow, Gray, DarkGray, Blue, Green, Cyan, Red, Magenta, Yellow, White
Write-Host "Texto em verde"     -ForegroundColor Green
Write-Host "Texto em vermelho"  -ForegroundColor Red
Write-Host "Texto em amarelo"   -ForegroundColor Yellow
Write-Host "Texto em ciano"     -ForegroundColor Cyan

# -BackgroundColor — define a cor do fundo
Write-Host "Fundo vermelho"     -BackgroundColor Red   -ForegroundColor White
Write-Host "Fundo verde"        -BackgroundColor Green -ForegroundColor Black

# -NoNewline — não quebra a linha após o texto
# equivalente ao echo -n do Bash ou print() sem \n do Python
Write-Host "Texto sem quebra "  -NoNewline
Write-Host "— continua na mesma linha"

# -Separator — define o separador entre múltiplos valores passados ao Write-Host
# equivalente ao sep= do print() do Python
Write-Host "PowerShell", "Bash", "Python" -Separator " | "   # PowerShell | Bash | Python

# Write-Host vs echo vs Write-Output
# echo / Write-Output → injeta no pipeline, pode ser capturado por outros cmdlets
# Write-Host          → vai direto ao console, NÃO pode ser capturado pelo pipeline
$capturado = Write-Output "Capturado pelo pipeline"   # funciona — $capturado recebe o valor
$naoCapturado = Write-Host "Não capturado"            # Write-Host imprime na tela, $naoCapturado fica $null
Write-Host "Capturado: $capturado"
Write-Host "Não capturado: $naoCapturado"             # imprime vazio

# ============================================================
# REGEX — expressões regulares
# ============================================================
# regex é uma sequência de caracteres que define um padrão de busca em strings
# no PowerShell, regex é suportado nativamente pelos operadores -match e -replace
# equivalente ao preg_match() e preg_replace() do PHP

Write-Host "======= REGEX ======="

$email = "usuario@dominio.com"
$cpf   = "123.456.789-09"
$texto = "PowerShell versão 7.3.1 foi lançado"

# -match — verifica se a string corresponde ao padrão regex
# retorna $true ou $false e popula a variável automática $Matches com os grupos capturados
if ($email -match "^[\w.-]+@[\w.-]+\.\w+$") {
    Write-Host "Email válido: $email"
}

# $Matches — variável automática populada após um -match com sucesso
# $Matches[0] contém o match completo
# $Matches[1], [2]... contêm os grupos de captura ()
if ($texto -match "versão (\d+\.\d+\.\d+)") {
    Write-Host "Versão encontrada: $($Matches[1])"   # captura o grupo (d+.d+.d+)
}

# -replace — substitui partes da string que correspondem ao padrão regex
# equivalente ao preg_replace() do PHP
$textoLimpo = $cpf -replace "[\.\-]", ""   # remove pontos e hífens do CPF
Write-Host "CPF sem formatação: $textoLimpo"   # 12345678909

# -split com regex — divide a string usando um padrão como delimitador
$partes = "um1dois2tres3quatro" -split "\d"   # divide nos dígitos
Write-Host "Split com regex: $partes"

# Select-String — equivalente ao grep do Bash, busca padrão em strings ou arquivos
$resultado = "PowerShell é poderoso" | Select-String -Pattern "poder\w+"
Write-Host "Select-String: $($resultado.Matches.Value)"   # poderoso

# ============================================================
# CARACTERES DE ESCAPE — acento grave ` (backtick)
# ============================================================
# no PowerShell o caractere de escape é o acento grave ` (backtick)
# diferente do Bash que usa \ (barra invertida) como escape
# IMPORTANTE: o escape só funciona dentro de ASPAS DUPLAS

Write-Host "======= CARACTERES DE ESCAPE ======="

Write-Host "`n — nova linha:"
Write-Host "Linha 1`nLinha 2"           # `n — quebra de linha (new line)

Write-Host "`t — tabulação:"
Write-Host "Coluna1`tColuna2`tColuna3"  # `t — tabulação horizontal (tab)

Write-Host "`r — retorno de carro:"
Write-Host "Texto`rSobrescrito"         # `r — carriage return (volta o cursor para o início da linha)

Write-Host "`` — acento grave literal:"
Write-Host "Acento grave: ``"           # `` — escapa o próprio acento grave para exibi-lo literalmente

Write-Host "`" — aspas duplas dentro de string:"
Write-Host "Ele disse: `"PowerShell é incrível`""   # `" — aspas duplas dentro de string com aspas duplas

Write-Host "`' — aspas simples dentro de string:"
Write-Host "Ele disse: `'PowerShell`'"              # `' — aspas simples dentro de string com aspas duplas

Write-Host "`0 — caractere nulo:"
Write-Host "Antes`0Depois"              # `0 — caractere nulo (null character)

Write-Host "`a — bipe sonoro:"
Write-Host "Bipe`a"                     # `a — alert/bell — emite um bipe sonoro no terminal

Write-Host "`b — backspace:"
Write-Host "Texto`b"                    # `b — backspace — apaga o caractere anterior no terminal

Write-Host "`f — avanço de página:"
Write-Host "Página`f"                   # `f — form feed — avanço de página (usado em impressoras)

Write-Host "`v — tabulação vertical:"
Write-Host "Linha`vVertical"            # `v — tabulação vertical