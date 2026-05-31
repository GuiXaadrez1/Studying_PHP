# Aula2 de tipo de dados em PowerShell olhe o arquivo hello_word.ps1
$str="scripts scritps"

# como $str é uma string, o PowerShell já infere automaticamente que é um objeto System.String do .NET
# podemos acessar diretamente os métodos de instância sem precisar referenciar a classe [string]
# diferente do echo (alias de Write-Output), o Write-Host é o cmdlet nativo que avalia expressões diretamente no stdout

Write-Host $str.ToUpper()  # método de instância: converte todos os caracteres para maiúsculas
Write-Host $str.ToLower()  # método de instância: converte todos os caracteres para minúsculas
Write-Host $str.Length     # propriedade de instância: retorna o total de caracteres da string

# cast -> conversão explícita de tipos, funciona igual ao PHP
# basta prefixar o valor com o typecode .NET entre colchetes [tipo]
$numberString = "1"
$numberStringToInt = [int]$numberString

# GetType().Name inspeciona o tipo CLR (.NET) do objeto em tempo de execução
# confirma que o cast foi aplicado corretamente
Write-Host "Valor original:   $numberString    | Tipo: $($numberString.GetType().Name)"
Write-Host "Valor convertido: $numberStringToInt | Tipo: $($numberStringToInt.GetType().Name)"

# transformando uma string em uma matriz de caracteres
$caracteres = "123"
Write-Host "String que vamos converter: $caracteres"

# [typecode[]] -> sintaxe para declarar um vetor/matriz unidimensional de um tipo específico no .NET
$matrizChar = [char[]]$caracteres
Write-Host "Matriz de caracteres: $matrizChar | Tipo: $($matrizChar.GetType().Name)"

# ATENÇÃO: converter [char[]] diretamente para [int[]] não retorna o valor numérico do dígito!
# o .NET interpreta cada char pelo seu código ASCII/Unicode na tabela de caracteres
# '1' = 49 | '2' = 50 | '3' = 51  → são os códigos decimais da tabela ASCII
$MatrizIntASCII = [int[]]$matrizChar
Write-Host "Matriz ASCII (código Unicode dos chars): $MatrizIntASCII | Tipo: $($MatrizIntASCII.GetType().Name)"

# para obter os valores inteiros reais dos dígitos, precisamos usar o Pipeline (|) com ForEach-Object
# ForEach-Object itera cada elemento da matriz e aplica o [int]::Parse() em cada char individualmente
# [int]::Parse() é um método estático da classe [int] do .NET que converte string/char para inteiro real
$MatrizIntReal = $matrizChar | ForEach-Object { [int]::Parse($_) }
Write-Host "Matriz de inteiros reais: $MatrizIntReal | Tipo: $($MatrizIntReal.GetType().Name)"