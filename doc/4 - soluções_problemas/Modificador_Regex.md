# Introdução
Este documento tem como principal objetivo tratar como se resolver o error: 

```php
<
Warning: preg_match_all(): Unknown modifier 'p' in C:\xampp\htdocs\Studying_PHP\RegEx_exercícios\metacaracteres\Quantificadores4.php on line 57

Warning: Trying to access array offset on value of type null in C:\xampp\htdocs\Studying_PHP\RegEx_exercícios\metacaracteres\Quantificadores4.php on line 58
array(1) { [0]=> string(72) "Error: filtrar_html(): Return value must be of type array, null returned" }
```

## Problema

Ao usar a função preg_match_all() no PHP com expressões regulares, é comum definir o padrão (pattern) entre delimitadores /. No entanto, se você adicionar um caractere extra depois do delimitador de fechamento /, o PHP interpreta esse caractere como modificador.
Ou seja MetaCaracter...

### Exemplo de código com erro:
```php
<?php
    preg_match_all("/<p>.*?</p>/", $texto, $matches);
?>
```

Neste caso, o /p no final faz o PHP entender que você está usando um modificador p. Porém, p não é um modificador válido, o que gera o erro:

```bash
    Warning: preg_match_all(): Unknown modifier 'p'
```

Além disso, quando o preg_match_all() falha, ele retorna false. Se o código tenta acessar $matches[0] ou outra posição de um array que não foi preenchido, surge outro aviso:

Warning: Trying to access array offset on value of type null

### Causa do Erro

- Delimitador / incorretamente fechado com um caractere extra (p).

- preg_match_all falha e retorna false.

- O código tenta acessar $matches[0] de um array que não existe.

## Solução

Basta remover o modificador inválido e garantir que o padrão termine corretamente:

```php
<?php
    $regex = '/<p>.*?<\/p>/';
    preg_match_all($regex, $texto, $matches);
?>
```

Também é boa prática validar o retorno para evitar tentar acessar índices nulos:

```php
<?php
    if (preg_match_all("/<p>.*?<\/p>/", $texto, $matches)) {
        print_r($matches);
    } else {
        echo "Regex não encontrou nada ou ocorreu um erro.";
    }
?>
```

## Dica

Modificadores válidos no PHP incluem:

    i → Case-insensitive

    m → Multiline

    s → Dotall (permite . casar com quebras de linha)

    u → UTF-8

Sempre verifique a sintaxe da expressão regular para evitar erros de delimitador e modificador.