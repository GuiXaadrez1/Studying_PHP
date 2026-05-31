# ============================================================
# Aula 8 — MÓDULOS, PARÂMETROS, ARQUIVOS, SISTEMA, APIS, LOGS, REMOTING
# ============================================================

# ============================================================
# PARÂMETROS DE SCRIPT — param() no topo do arquivo
# ============================================================
# param() permite que o script receba argumentos externos ao ser executado
# equivalente ao $argv[] do PHP ou sys.argv[] do Python
# SINTAXE de execução: .\aula8.ps1 -Nome "PowerShell" -Versao 7
# IMPORTANTE: param() deve ser SEMPRE a primeira instrução do script

param(
    [string] $Nome   = "Usuário",    # parâmetro com valor padrão
    [int]    $Versao = 7,            # parâmetro inteiro com valor padrão
    [switch] $Verbose                # switch — equivalente a uma flag booleana, não precisa de valor
                                     # ex: .\aula8.ps1 -Verbose   -> $Verbose = $true
                                     # ex: .\aula8.ps1            -> $Verbose = $false
)

Write-Host "======= PARÂMETROS DE SCRIPT ======="
Write-Host "Nome:    $Nome"
Write-Host "Versão:  $Versao"
Write-Host "Verbose: $Verbose"

# parâmetros obrigatórios — [Parameter(Mandatory)] força o usuário a informar o valor
# se não informado, o PowerShell solicita interativamente no terminal
function ExemploParametroObrigatorio {
    param(
        [Parameter(Mandatory)]
        [string] $NomeObrigatorio,          # obrigatório — lança erro se não informado

        [Parameter(Mandatory=$false)]
        [string] $NomeOpcional = "Padrão"   # opcional — usa o valor padrão se não informado
    )
    Write-Host "Obrigatório: $NomeObrigatorio | Opcional: $NomeOpcional"
}
# ExemploParametroObrigatorio -NomeObrigatorio "PowerShell"

# ============================================================
# MÓDULOS — importando e exportando código reutilizável
# ============================================================
# módulos são arquivos .psm1 que encapsulam funções reutilizáveis
# equivalente ao require/include do PHP ou import do Python
# SINTAXE: Import-Module .\meuModulo.psm1

Write-Host "======= MÓDULOS ======="

# listando todos os módulos disponíveis no sistema
$modulos = Get-Module -ListAvailable
Write-Host "Total de módulos disponíveis: $($modulos.Count)"

# importando um módulo nativo do PowerShell
Import-Module Microsoft.PowerShell.Utility   # módulo de utilitários nativos

# verificando se um módulo está carregado
if (Get-Module -Name Microsoft.PowerShell.Utility) {
    Write-Host "Módulo Microsoft.PowerShell.Utility carregado com sucesso!"
}

# criando e importando um módulo customizado
# primeiro criamos o arquivo .psm1 com as funções
$conteudoModulo = @'
function Saudacao {
    param([string]$Nome)
    Write-Host "Olá, $Nome! Seja bem-vindo ao módulo customizado."
}

function Despedida {
    param([string]$Nome)
    Write-Host "Até logo, $Nome!"
}
'@
$conteudoModulo | Out-File -FilePath ".\meuModulo.psm1" -Encoding UTF8

# importando o módulo criado
Import-Module .\meuModulo.psm1 -Force   # -Force recarrega o módulo se já estiver importado
Saudacao  -Nome "PowerShell"
Despedida -Nome "PowerShell"

# removendo o módulo da sessão após o uso
Remove-Module meuModulo

# ============================================================
# MANIPULAÇÃO DE ARQUIVOS — leitura e escrita
# ============================================================

Write-Host "======= MANIPULAÇÃO DE ARQUIVOS ======="

# --- TXT ---
# escrevendo em arquivo TXT
"Linha 1 do arquivo"          | Out-File -FilePath ".\arquivo.txt" -Encoding UTF8
"Linha 2 do arquivo"          | Out-File -FilePath ".\arquivo.txt" -Encoding UTF8 -Append
Add-Content -Path ".\arquivo.txt" -Value "Linha 3 adicionada com Add-Content"

# lendo arquivo TXT — retorna um array de strings, uma por linha
$linhas = Get-Content -Path ".\arquivo.txt"
Write-Host "Total de linhas: $($linhas.Count)"
foreach ($linha in $linhas) {
    Write-Host "Linha: $linha"
}

# lendo arquivo inteiro como string única
$textoCompleto = Get-Content -Path ".\arquivo.txt" -Raw
Write-Host "Arquivo completo:`n$textoCompleto"

# ---- CSV ---
# escrevendo CSV — Export-Csv serializa objetos diretamente para CSV
$pessoas = @(
    [PSCustomObject]@{ Nome = "Ana";    Idade = 25; Cargo = "Dev" },
    [PSCustomObject]@{ Nome = "Bruno";  Idade = 30; Cargo = "DBA" },
    [PSCustomObject]@{ Nome = "Carlos"; Idade = 28; Cargo = "DevOps" }
)
$pessoas | Export-Csv -Path ".\pessoas.csv" -NoTypeInformation -Encoding UTF8
# -NoTypeInformation remove a linha de tipo .NET que o PowerShell adiciona por padrão

# lendo CSV — Import-Csv deserializa o CSV de volta para objetos
$pessoasLidas = Import-Csv -Path ".\pessoas.csv"
Write-Host "--- Pessoas do CSV ---"
foreach ($pessoa in $pessoasLidas) {
    Write-Host "Nome: $($pessoa.Nome) | Idade: $($pessoa.Idade) | Cargo: $($pessoa.Cargo)"
}

# ---- JSON ---
# escrevendo JSON — ConvertTo-Json serializa objetos para JSON
$config = [PSCustomObject]@{
    Aplicacao = "MeuApp"
    Versao    = "1.0.0"
    Ambiente  = "Producao"
    Database  = [PSCustomObject]@{
        Host = "localhost"
        Port = 5432
        Name = "meudb"
    }
}
$config | ConvertTo-Json -Depth 3 | Out-File -FilePath ".\config.json" -Encoding UTF8
# -Depth define a profundidade de serialização de objetos aninhados

# lendo JSON — ConvertFrom-Json deserializa JSON de volta para objeto .NET
$configLida = Get-Content -Path ".\config.json" -Raw | ConvertFrom-Json
Write-Host "Aplicação: $($configLida.Aplicacao)"
Write-Host "DB Host:   $($configLida.Database.Host)"
Write-Host "DB Port:   $($configLida.Database.Port)"

# ---- XML ---
# escrevendo XML
$xml = [xml]@"
<?xml version="1.0" encoding="UTF-8"?>
<configuracao>
    <aplicacao>MeuApp</aplicacao>
    <versao>1.0.0</versao>
    <ambiente>Producao</ambiente>
</configuracao>
"@
$xml.Save("$PWD\config.xml")

# lendo XML
$xmlLido = [xml](Get-Content -Path ".\config.xml" -Raw)
Write-Host "XML - Aplicação: $($xmlLido.configuracao.aplicacao)"
Write-Host "XML - Versão:    $($xmlLido.configuracao.versao)"

# ============================================================
# ACESSO AO SISTEMA — processos, serviços e registro
# ============================================================

Write-Host "======= ACESSO AO SISTEMA ======="

# --- PROCESSOS ---
# listando processos em execução
$processos = Get-Process | Sort-Object CPU -Descending | Select-Object -First 5
Write-Host "--- Top 5 processos por CPU ---"
foreach ($proc in $processos) {
    Write-Host "Nome: $($proc.Name) | PID: $($proc.Id) | CPU: $($proc.CPU)"
}

# verificando se um processo está rodando
$chrome = Get-Process -Name "chrome" -ErrorAction SilentlyContinue
if ($chrome) {
    Write-Host "Chrome está rodando com PID: $($chrome.Id)"
} else {
    Write-Host "Chrome não está rodando"
}

# --- SERVIÇOS ---
# listando serviços em execução
$servicos = Get-Service | Where-Object { $_.Status -eq "Running" } | Select-Object -First 5
Write-Host "--- Primeiros 5 serviços rodando ---"
foreach ($servico in $servicos) {
    Write-Host "Serviço: $($servico.Name) | Status: $($servico.Status)"
}

# --- INFORMAÇÕES DO SISTEMA ---
$so        = Get-CimInstance Win32_OperatingSystem
$cpu       = Get-CimInstance Win32_Processor
$memoria   = Get-CimInstance Win32_PhysicalMemory

Write-Host "--- Informações do Sistema ---"
Write-Host "SO:      $($so.Caption)"
Write-Host "CPU:     $($cpu.Name)"
Write-Host "RAM:     $(($memoria | Measure-Object -Property Capacity -Sum).Sum / 1GB) GB"
Write-Host "Espaço livre: $([math]::Round($so.FreePhysicalMemory / 1MB, 2)) MB"

# --- AGENDAMENTO DE TAREFAS ---
# criando uma tarefa agendada para executar o script diariamente
$acao    = New-ScheduledTaskAction -Execute "PowerShell.exe" -Argument "-File C:\scripts\aula8.ps1"
$gatilho = New-ScheduledTaskTrigger -Daily -At "08:00"
# Register-ScheduledTask -TaskName "MinhaTaskPS" -Action $acao -Trigger $gatilho
Write-Host "Tarefa agendada configurada (comentada para não registrar agora)"

# ============================================================
# COMUNICAÇÃO COM APIs — Invoke-RestMethod e Invoke-WebRequest
# ============================================================
# Invoke-RestMethod  — faz requisições HTTP e deserializa JSON/XML automaticamente
# Invoke-WebRequest  — faz requisições HTTP e retorna o objeto de resposta bruto (headers, status, body)
# equivalente ao curl do Bash ou file_get_contents/Guzzle do PHP

Write-Host "======= COMUNICAÇÃO COM APIs ======="

# GET — consumindo uma API pública
try {
    $resposta = Invoke-RestMethod -Uri "https://jsonplaceholder.typicode.com/posts/1" -Method GET
    Write-Host "ID:     $($resposta.id)"
    Write-Host "Título: $($resposta.title)"
    Write-Host "Body:   $($resposta.body)"
} catch {
    Write-Host "Erro na requisição GET: $($_.Exception.Message)"
}

# POST — enviando dados para uma API
try {
    $body = @{
        title  = "Meu Post PowerShell"
        body   = "Conteúdo criado via script"
        userId = 1
    } | ConvertTo-Json   # serializa o hashtable para JSON antes de enviar

    $headers = @{
        "Content-Type" = "application/json"
        "Accept"       = "application/json"
    }

    $respostaPost = Invoke-RestMethod `
        -Uri     "https://jsonplaceholder.typicode.com/posts" `
        -Method  POST `
        -Body    $body `
        -Headers $headers

    Write-Host "Post criado com ID: $($respostaPost.id)"
} catch {
    Write-Host "Erro na requisição POST: $($_.Exception.Message)"
}

# verificando status HTTP com Invoke-WebRequest
try {
    $req = Invoke-WebRequest -Uri "https://jsonplaceholder.typicode.com/posts/1"
    Write-Host "Status HTTP: $($req.StatusCode)"        # 200, 404, 500 etc.
    Write-Host "Content-Type: $($req.Headers['Content-Type'])"
} catch {
    Write-Host "Erro: $($_.Exception.Message)"
}

# ============================================================
# LOGS ESTRUTURADOS — auditoria e rastreabilidade
# ============================================================
# logs são essenciais para automações profissionais
# permitem rastrear o que o script fez, quando e o resultado

Write-Host "======= LOGS ESTRUTURADOS ======="

# função de log reutilizável com níveis e timestamp
function Write-Log {
    param(
        [string] $Mensagem,
        [ValidateSet("INFO","WARN","ERROR","SUCCESS")]
        [string] $Nivel = "INFO",   # ValidateSet restringe os valores aceitos — equivalente ao enum
        [string] $Arquivo = ".\script.log"
    )

    $timestamp = Get-Date -Format "yyyy-MM-dd HH:mm:ss"   # formato ISO 8601
    $linha     = "[$timestamp] [$Nivel] $Mensagem"

    # exibe no console com cor de acordo com o nível
    switch ($Nivel) {
        "INFO"    { Write-Host $linha -ForegroundColor Cyan    }
        "WARN"    { Write-Host $linha -ForegroundColor Yellow  }
        "ERROR"   { Write-Host $linha -ForegroundColor Red     }
        "SUCCESS" { Write-Host $linha -ForegroundColor Green   }
    }

    # grava no arquivo de log
    $linha | Out-File -FilePath $Arquivo -Append -Encoding UTF8
}

# usando a função de log
Write-Log -Mensagem "Script iniciado"                    -Nivel "INFO"
Write-Log -Mensagem "Arquivo não encontrado"             -Nivel "WARN"
Write-Log -Mensagem "Erro crítico na conexão"            -Nivel "ERROR"
Write-Log -Mensagem "Operação concluída com sucesso!"    -Nivel "SUCCESS"

# lendo o log gerado
Write-Host "--- Conteúdo do Log ---"
Get-Content -Path ".\script.log" | ForEach-Object { Write-Host $_ }

# ============================================================
# EXECUÇÃO REMOTA — Invoke-Command
# ============================================================
# permite executar comandos e scripts em máquinas remotas via WinRM
# equivalente ao SSH do Bash para execução remota
# REQUISITO: WinRM deve estar habilitado na máquina remota
#            Enable-PSRemoting -Force (executar como administrador na máquina remota)

Write-Host "======= EXECUÇÃO REMOTA ======="

# executando comando em máquina remota
# Invoke-Command -ComputerName "ServidorRemoto" -ScriptBlock {
#     Get-Process | Select-Object -First 5
# }

# executando com credenciais
# $credencial = Get-Credential   # solicita usuário e senha interativamente
# Invoke-Command -ComputerName "ServidorRemoto" -Credential $credencial -ScriptBlock {
#     Get-Service | Where-Object { $_.Status -eq "Running" }
# }

# executando um arquivo .ps1 inteiro remotamente
# Invoke-Command -ComputerName "ServidorRemoto" -FilePath ".\aula8.ps1"

# sessão persistente — mantém a conexão aberta para múltiplos comandos
# $sessao = New-PSSession -ComputerName "ServidorRemoto"
# Invoke-Command -Session $sessao -ScriptBlock { $env:COMPUTERNAME }
# Remove-PSSession -Session $sessao   # fecha a sessão ao terminar

Write-Host "Execução remota comentada — requer WinRM habilitado na máquina remota"
Write-Host "Para habilitar: Enable-PSRemoting -Force (como Administrador)"

# ============================================================
# LIMPEZA DOS ARQUIVOS CRIADOS NESTA AULA
# ============================================================
Remove-Item ".\arquivo.txt"   -ErrorAction SilentlyContinue
Remove-Item ".\pessoas.csv"   -ErrorAction SilentlyContinue
Remove-Item ".\config.json"   -ErrorAction SilentlyContinue
Remove-Item ".\config.xml"    -ErrorAction SilentlyContinue
Remove-Item ".\script.log"    -ErrorAction SilentlyContinue
Remove-Item ".\meuModulo.psm1"-ErrorAction SilentlyContinue
Write-Host "Arquivos temporários removidos — aula concluída!"