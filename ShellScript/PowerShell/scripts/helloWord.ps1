echo "hellow_word"

# No PowerShell, todo retorno de cmdlet é um Objeto fortemente tipado baseado no .NET Framework
# diferente do Bash que trata tudo como texto (string), o PowerShell herda o sistema de tipos do .NET
# permitindo acesso direto a métodos e propriedades de classes C# nos objetos retornados
# as variáveis são declaradas e referenciadas com o prefixo $ (cifrão), assim como no PHP
# a tipagem é inferida automaticamente pelo runtime com base nos tipos primitivos e classes do .NET (C#)
# equivalente no Bash seria a Substituição de Comando: info=$(comando)
# atalho útil no PowerShell ISE: CTRL+SPACE para acionar o IntelliSense e explorar parâmetros disponíveis
$arq = Get-Item .\helloWord.ps1

# para referenciar o conteúdo de uma variável, basta invocar seu identificador diretamente
# o PowerShell serializa automaticamente o objeto para uma representação legível no stdout
# echo $arq

# assim como no Bash, o PowerShell suporta Pipeline (|) para encadeamento de cmdlets
# o objeto retornado por um cmdlet é passado diretamente como entrada para o próximo da cadeia
# diferente do Bash onde o pipe trafega apenas texto, no PowerShell trafega o OBJETO completo
$methods   = $arq | Get-Member -MemberType Methods    # inspeciona todos os métodos disponíveis no objeto
$propriety = $arq | Get-Member -MemberType Properties # inspeciona todas as propriedades disponíveis no objeto
# $propriety = $arq | Get-Member -MemberType AliasProperty # inspeciona os aliases de propriedades do objeto

# OPERADORES DE ACESSO NO POWERSHELL
# Operador de Acesso a Membro de Instância (.): acessa propriedades e métodos de um objeto instanciado
#   equivalente ao (.) do Python e Java — ex: $objeto.Propriedade / $objeto.Metodo()
# todas as propriedades concatenadas em uma única linha de stdout usando interpolação de string com $()
# a interpolação $() dentro de aspas duplas força a avaliação da expressão antes de exibir no stdout
echo "Tipo: $($arq.GetType()) | Nome: $($arq.Name) | BaseName: $($arq.BaseName) | Extensão: $($arq.Extension)"

# Operador de Acesso a Membro Estático (::): acessa métodos e propriedades estáticas diretamente da classe .NET
#   equivalente ao (::) do PHP — não precisa instanciar um objeto, acessa direto na classe
#   ex: [string]::Join() / [Math]::Sqrt()
#   @() é o operador de construção de Array/Matriz no PowerShell — equivalente ao [] do Python ou array() do PHP
$concatString = [string]::Join("-", @("a","b","c")) # invoca o método estático Join da classe [string] do .NET passando um array como argumento
echo "Strings concatenadas da matriz: $concatString"

# [string]::Format() é equivalente ao String.Format() do C# e ao printf() do Bash
# as chaves {0} {1} {2} são placeholders indexados que referenciam as posições do array passado como argumento
$formatString = [string]::Format("{0} {1} {2}", @('Instituto','de','Scripts'))
echo $formatString

# acessando a propriedade estática FullName da classe [string] do .NET
# FullName retorna o nome completo qualificado da classe no namespace do .NET
# ATENÇÃO: para acessar propriedades estáticas de uma classe, ela deve estar entre colchetes [] sem o $
# usar $() força a avaliação correta da expressão dentro do echo
echo $([string].FullName)