# Aula 3 de typecode -> tipo de dados para scripts PowerShell... Caso de dúvidas veja a aula 2

# ============================================================
# DATETIME — trabalhando com datas e horas no .NET
# ============================================================

# [datetime] é uma classe do .NET que representa um ponto específico no tempo
# o cast de string para [datetime] aceita o padrão americano MM-DD-YYYY
# lembre-se: o cálculo de intervalo usa o horário do relógio do computador como referência
$dateNatal = [datetime]"12-25-2026"
Write-Host "Data Natal: $($dateNatal)"

# [datetime]::Now é uma propriedade estática — não precisa instanciar um objeto para acessá-la
# ela captura a data e hora exata no momento em que a linha é executada
$current_date = [datetime]::Now
Write-Host "Data atual: $($current_date)"

# ============================================================
# TIMESPAN — resultado da subtração entre dois objetos [datetime]
# ============================================================

# no .NET, subtrair dois objetos [datetime] retorna automaticamente um objeto [TimeSpan]
# [TimeSpan] representa um intervalo de tempo e já vem com propriedades prontas para uso
# o PowerShell resolve o operador (-) nativamente entre objetos [datetime]
$intervalo = $dateNatal - $current_date
Write-Host "Intervalo até o Natal: $($intervalo)"

# propriedades PARCIAIS do [TimeSpan]
# cada propriedade retorna apenas o fragmento correspondente do intervalo total
# ou seja, .Hours não retorna o total de horas — retorna só as horas do fragmento do dia
Write-Host "Dias restantes:         $($intervalo.Days)"
Write-Host "Horas restantes:        $($intervalo.Hours)"
Write-Host "Minutos restantes:      $($intervalo.Minutes)"
Write-Host "Segundos restantes:     $($intervalo.Seconds)"
Write-Host "Milisegundos restantes: $($intervalo.Milliseconds)"

# propriedades TOTAL do [TimeSpan]
# diferente das parciais, as propriedades Total acumulam o intervalo inteiro na unidade desejada
# exemplo: TotalHours retorna todas as horas do intervalo, não apenas as horas do fragmento do dia
Write-Host "Total de horas restantes:    $($intervalo.TotalHours)"
Write-Host "Total de minutos restantes:  $($intervalo.TotalMinutes)"
Write-Host "Total de segundos restantes: $($intervalo.TotalSeconds)"

# ============================================================
# TIPOS DE DADOS PRIMITIVOS DO .NET NO POWERSHELL
# ============================================================

# no PowerShell, os tipos primitivos são aliases diretos das classes do .NET
# use .FullName na classe para inspecionar o nome completo no namespace System do .NET
# REGRA:
#   .GetType().FullName → use em INSTÂNCIAS (objetos já criados) ex: $variavel.GetType().FullName
#   .FullName           → use em CLASSES    (os tipos em si)     ex: [int].FullName

Write-Host "======= TIPOS NUMERICOS INTEIROS ======="
Write-Host "[int]    -> $([int].FullName)"      # System.Int32  — inteiro de 32 bits, o mais comum para números sem decimais

Write-Host "======= TIPOS NUMERICOS DE PONTO FLUTUANTE ======="
Write-Host "[single] -> $([single].FullName)"   # System.Single — ponto flutuante de 32 bits, menor precisão, menor consumo de memória
Write-Host "[float]  -> $([float].FullName)"    # System.Single — [float] é apenas um ALIAS de [single], ambos mapeiam para o mesmo tipo
Write-Host "[double] -> $([double].FullName)"   # System.Double — ponto flutuante de 64 bits, MAIOR precisão — recomendado para cálculos decimais

Write-Host "======= TIPOS DE TEXTO ======="
Write-Host "[string] -> $([string].FullName)"   # System.String — cadeia de caracteres de tamanho dinâmico
Write-Host "[char]   -> $([char].FullName)"     # System.Char   — caractere único de tamanho fixo (16 bits Unicode)

# ============================================================
# ARRAYS E MATRIZES NO POWERSHELL
# ============================================================

Write-Host "======= FORMA 1 — ARRAY COM @() ======="

# @() é o operador nativo do PowerShell para construir arrays
# aceita qualquer tipo de dado misturado — o PowerShell infere o tipo automaticamente
# equivalente ao [] do Python ou array() do PHP

$arraySimples = @("PowerShell", "Bash", "Python")
Write-Host "Array: $arraySimples | Tipo: $($arraySimples.GetType().Name) | FullName: $($arraySimples.GetType().FullName)"
Write-Host "Elemento no índice 0: $($arraySimples[0])"  # acesso por índice, começa em 0 igual ao Python e PHP

Write-Host "======= FORMA 2 — ARRAY TIPADO COM [tipo[]] ======="

# [tipo[]] força o array a aceitar apenas um tipo específico de dado
# tentar inserir um tipo diferente causará erro em tempo de execução
# equivalente aos arrays tipados do C# — int[], string[], char[]

$arrayTipado = [int[]](1, 2, 3, 4, 5)
Write-Host "Array: $arrayTipado | Tipo: $($arrayTipado.GetType().Name) | FullName: $($arrayTipado.GetType().FullName)"
Write-Host "Elemento no índice 2: $($arrayTipado[2])"  # acesso por índice

Write-Host "======= PROPRIEDADES DO ARRAY ======="

# .Length retorna o total de elementos do array — igual ao .Length do C# e Java
# REGRA: arrays são INSTÂNCIAS, portanto usamos .GetType().FullName e não [tipo].FullName

Write-Host "Total de elementos (arraySimples): $($arraySimples.Length)"
Write-Host "Total de elementos (arrayTipado):  $($arrayTipado.Length)"