# Introdução

Este documento visa ser um guia para utilizar corretamente a função preg_split.

## O que é o preg_split?

preg_split é a função "split by regex" do PHP:
Divide uma string em partes usando uma expressão regular como delimitador.

Analogia:

- É o explode() — mas com regex, o que torna muito mais flexível.

##  Assinatura

```php
<?php
    array preg_split(
        string $pattern,
        string $subject,
        int $limit = -1,
        int $flags = 0
    )
?>
```

**Parâmetros:**

| Parâmetro  | Tipo   | Descrição                                                                             |
| ---------- | ------ | ------------------------------------------------------------------------------------- |
| `$pattern` | string | A expressão regular que define **onde cortar**.                                       |
| `$subject` | string | A string a ser dividida.                                                              |
| `$limit`   | int    | Número máximo de elementos no array (último elemento leva o resto). `-1` = ilimitado. |
| `$flags`   | int    | Opções adicionais de controle (ex.: remover vazios, capturar delimitadores).          |

Retorno:

- Sempre um array com os pedaços da string.

### Exemplos 

**Separar por espaços:**
```php
<?php
    $subject = "Um dois  três   quatro";
    $result = preg_split("/\s+/", $subject);

    print_r($result);
    // Saída:
    // Array
    // (
    //     [0] => Um
    //     [1] => dois
    //     [2] => três
    //     [3] => quatro
    // )
?>
```

Explicação:

- /\s+/ → Expressão para um ou mais espaços/brancos.

- Divide sempre que encontrar 1 ou mais espaços consecutivos.

- explode(' ', ...) não faria isso — só separa por UM espaço exato.

**Separar por vírgula e/ou espaço:**

```php
<?php
$subject = "maçã, banana, laranja uva,melão";
$result = preg_split("/[\s,]+/", $subject);

print_r($result);
// Array
// (
//     [0] => maçã
//     [1] => banana
//     [2] => laranja
//     [3] => uva
//     [4] => melão
// )
?>
```
Explicação:

- /[\s,]+/ → Qualquer quantidade de espaços ou vírgulas.

- Ideal para textos mal formatados.

**Usando $limit:**
```php
<?php
    $subject = "um dois três quatro cinco";
    $result = preg_split("/\s+/", $subject, 3);

    print_r($result);
    // Array
    // (
    //     [0] => um
    //     [1] => dois
    //     [2] => três quatro cinco
    // )
?>
```

Explicação:

- 3 → máximo de 3 elementos.

- O terceiro elemento carrega o resto da string.

**Removendo resultados vazios:**

Às vezes sua regex gera divisões vazias.

Exemplo: string começando ou terminando com delimitador.

```php
<?php
    $subject = "um,,dois,,,três,";
    $result = preg_split("/,+/", $subject);

    print_r($result);
    // Array
    // (
    //     [0] => um
    //     [1] => dois
    //     [2] => três
    //     [3] => 
    // )
?>
```
Perceba o "" no final — por quê? A string termina com ,.

Para ignorar resultados vazios utilize a flag PREG_SPLIT_NO_EMPTY:

```php
<?php
    $result = preg_split("/,+/", $subject, -1, PREG_SPLIT_NO_EMPTY);

    print_r($result);
    // Array
    // (
    //     [0] => um
    //     [1] => dois
    //     [2] => três
    // )
?>
```

**Manter delimitadores no resultado:**

Por padrão, o delimitador não aparece.

Mas se o padrão usar parênteses, você captura o que casa também!

```php
<?php
    $subject = "um,dois;três.quatro";
    $result = preg_split("/(,|;|\.)/", $subject);

    print_r($result);
    // Array
    // (
    //     [0] => um
    //     [1] => ,
    //     [2] => dois
    //     [3] => ;
    //     [4] => três
    //     [5] => .
    //     [6] => quatro
    // )
?>
```
Explicação:

- () → grupo de captura.

- O delimitador aparece no array.

- Útil quando você quer saber onde foi cortado.

**Flags combinadas:**

```php
<?php
    $subject = ",um,,dois,,";
    $result = preg_split("/,+/", $subject, -1, PREG_SPLIT_NO_EMPTY);

    print_r($result);
    // Array
    // (
    //     [0] => um
    //     [1] => dois
    // )
?>
```

Aqui:

- ,+ → um ou mais ,

- PREG_SPLIT_NO_EMPTY → sem vazios.

- Sem () → delimitador não aparece.

## Principais Flags

| Constante                   | Valor | Efeito                                                     |
| --------------------------- | ----- | ---------------------------------------------------------- |
| `PREG_SPLIT_NO_EMPTY`       | 1     | Remove strings vazias do resultado                         |
| `PREG_SPLIT_DELIM_CAPTURE`  | 2     | Inclui delimitadores capturados                            |
| `PREG_SPLIT_OFFSET_CAPTURE` | 4     | Retorna cada pedaço junto com a posição original na string |


## Exemplo com PREG_SPLIT_OFFSET_CAPTURE

```php
<?php
    $subject = "um dois três";
    $result = preg_split("/\s+/", $subject, -1, PREG_SPLIT_OFFSET_CAPTURE);

    print_r($result);
    // Array
    // (
    //     [0] => Array ( [0] => um [1] => 0 )
    //     [1] => Array ( [0] => dois [1] => 3 )
    //     [2] => Array ( [0] => três [1] => 8 )
    // )
?>
```
Cada pedaço é um array [ valor, posição ].


## Diferença entre explode e preg_split

| Função         | Tipo de corte           | Poder                          |
| -------------- | ----------------------- | ------------------------------ |
| `explode()`    | Delimitador **literal** | Simples, rápido, não usa regex |
| `preg_split()` | **Regex**               | Divide por padrões complexos   |

Se precisar só de "sep1,sep2" → explode(',',$str).
Se quiser "sep1, sep2;sep3" → preg_split() é melhor.

## Boas práticas

✅ Valide a regex antes (testa no regex101.com).
✅ Use PREG_SPLIT_NO_EMPTY se não quiser resíduos vazios.
✅ Use PREG_SPLIT_DELIM_CAPTURE para tokens tipo tokenizer.
✅ Combine com array_map para pós-processar pedaços.

## Conclusão

preg_split → divide onde regex casar.

Potente para parsing de texto, logs, CSV mal formatados, strings com múltiplos delimitadores.

Junto com preg_match e preg_replace, forma a trindade PCRE do PHP.