# Introdução 

Esse arquivo.md visa deixa registrado todos os comandos básicos do Power Shell

**Observação:** Pode ser programado orientado a Objeto! E sua documentação é muito bem feita e elaborada para tirar dúvidas.

## Atalhos básicos do Power Shell

- ctrl + backspace = deleta uma palavra inteira na linha;

- ctrl + delete = o mesmo do de cima;

- ctrl + seta para direita ou esquerda -> vai pular a palavra toda depedendo da direção; 

- Esc = deleta a linha inteira

- ctrl + space => retorna o intelliSense (lista de todas as opções de parâmetros de um cmdlet) **muito útil!**

## Comandos básicos

- Get-Host => obtém informações do power shell;

```powershell

Get-Host

''' out-put
Name             : ConsoleHost
Version          : 5.1.26100.8457
InstanceId       : bb3dd7fd-7f89-4a80-b0d9-c5c3a987bf09
UI               : System.Management.Automation.Internal.Host.InternalHostUserInterface
CurrentCulture   : pt-BR
CurrentUICulture : pt-BR
PrivateData      : Microsoft.PowerShell.ConsoleHost+ConsoleColorProxy
DebuggerEnabled  : True
IsRunspacePushed : False
Runspace         : System.Management.Automation.Runspaces.LocalRunspace
'''
```

- Write-Host => funciona como se fosse o echo do bash;

```powershell

Write-Host Hello Word!

''' out-put
Hello Word!
'''

```

- get-date => obtém data e hora atual parecido com o echo $(date) do bash;

```powershell

Get-Date

'''out-put
quarta-feira, 27 de maio de 2026 21:46:37
'''

```

- Get-Command => Retorna uma lista com todos os Commandlet(comandos internos)  que podemos usar com o Power Shell 

```powershell

Get-Command

''' out-put

CommandType     Name                                               Version    Source
-----------     ----                                               -------    ------
Alias           Add-AppPackage                                     2.0.1.0    Appx
Alias           Add-AppPackageVolume                               2.0.1.0    Appx
Alias           Add-AppProvisionedPackage                          3.0        Dism
Alias           Add-MsixPackage                                    2.0.1.0    Appx
Alias           Add-MsixPackageVolume                              2.0.1.0    Appx
Alias           Add-MsixVolume                                     2.0.1.0    Appx
Alias           Add-ProvisionedAppPackage                          3.0        Dism
Alias           Add-ProvisionedAppSharedPackageContainer           3.0        

...
'''

```

- Get-Help [CommandLet] => serve para descrever o que um comando faz!

- Get-Alias => Retorna uma lista de alias de determinados cmdlet

- Get-ChildItem => funciona como o dir do cmd ou ls do bash;

```powershell


```out-put

    Diretório: C:\xampp\htdocs\Studying_PHP\ShellScript\PowerShell

Mode                 LastWriteTime         Length Name                                            
----                 -------------         ------ ----                                            
d-----        27/05/2026     21:23                commands_powershell                             
d-----        27/05/2026     21:10                scripts                                         

```

- Set-Location "path_selected" => funciona como um cd para navegação de pastas

```powershell
Set-Location C:\xampp\htdocs\Studying_PHP\ShellScript
```

- Clear-Host => funciona que nem o clear do bash para limpar o console

```powershell
Clear-Host
```

**Observação:** Lembrando que host em shell é a versão do power shell e o computador que tem ele como usuário/cliente

**Note:** Parece que o terminal do Power Shell é case-insensivite

## Marcetes:

./path => usamos ponto para diretório relativo

```powershell

# acessando sub-pasta PowerShell dentro do diretório atual

Set-location .\PowerShell

# Indo para a pasta de usuário de forma direta!
Set-Location ~ 

# usando carcater coringa para filtragem com get-command

Get-Command *-host 
Get-Command ???-host

Get-Alias *rm

# * -> retorna uma lista com todos os commandlet com -host
# ??? -> retorna uma lista com todos os comandos com -host no final 

```

## Aprofundamentos sobre o comando de Ajuda do PowerShell

- Get-Help [cmdlet] # ajuda resumida
- Get-Help [cmdlet] -Path # obtém os parâmetros que podemos usar no Get-Help
- Get-Help [cmdlet] -Detailed # obtém informações completas
- Get-Help [cmdlet] -ShowWindow # abre uma interface gráfica para obtenção de informação do comando (muito bom!)
- Get-Help [cmdlet] -Exemple # obtém exemplos usando o CommandLet

## Alias - apelidos para cmdlet -> exemplo> Clear-Host = cls/clear (cmd/bash)

os comandos do Power Shell não é o mesmo do Shell (Bash), CMD (bat) e etc... 
os comandos cmdlet do Power Shell possuem alias (apelidos) com os nomes do comandos usados no cmd/bash para executar um comando interno do power shell cmdlet.

é possível criamos um alias para o nosso prórpio conjunto de comandos, exemplo:

```powershell
New-Alias -name limpar -value Clear-Host

# Verificando se o alias limpar foi criado apontando para o cmdlet Clear-Host
Get-Alias limpar

# Obtendo sabendo se um cmdlet possui um alias
Get-Alias -Definition Clear-Host

# Atualizando comando que esse alias faz referência
Set-Alias limpar Get-Host
```

**Observação:** Não é possível criar um alias com mesmo nome de outro

```powershell 

# Exportando informações de alias para um arquivo.txt

Export-Alias $home\Desktop\Test.txt

# Podemos salvar tanto como um csv e como um Script

Export-Alias -path $home\Desktop\Test.ps1 -as script

# .ps1 => Arquivo de extensão lido com o PowerShell... Funciona como um .sh ou .bash

# Importando o alias que esta dentro do arquivo Exportado e  Salvando dentro do PowerShell

Import-Alias -path $home\Desktop\Test.ps1
```

## Políticas de Execução

- Restricted => padrão, permite usar o shell, mas bloqueia scripts

- AllSigned => permite executar scripts, mas requer que sejam assinados por um fornecedor confiável, mesmo os scripts criados no próprio computador. Avisa antes de executar scripts de fornecedores desconhecidos.

- RemoteSigned => Permite executar scripts, mas requer que sejam assinados por um fornecedor confiável, exceto os criados no próprio computador. Avisa antes de executar scripts de fornecedores desconhecidos.

- Unrestricted => Os scripts desconhecidos podem ser executados , mas adverte o usuário antes de executar um script baixado da internet.

- Bypass => Nada é bloqueado e não há aviso ou solicitações.

- Undefined => Não há diretiva de execução definida.

**Observações:** Para lidar com políticas de execução deve-se usar o powershell como administrador 

### Comandos para lidar com essas políticas

- Get-ExecutionPolicy # retorna a política vigente no computador

- Set-ExecutionPolicy # lista a política de execução em cada escopo no computador

```powershell

# mudando a poçítica de execução
Set-ExecutionPolicy -ExecutionPolicy AllSigned -Scope LocalMachine -force

# -ExecutionPolicy -> Usamos para alterar a política de execução do powershell
# -Scope -> Escopo onde a política esta sendo aplicada!
# -force -> força a alteração

# Se você quer criar seus scripts, recomendo que realize essa configuração...
# ao menos para a política: RemoteSigned
```