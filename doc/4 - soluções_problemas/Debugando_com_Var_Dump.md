# 📌 Guia de Debug no PHP com `var_dump`

## ✅ Introdução

O `var_dump` é uma função **nativa do PHP** usada para **depurar variáveis** em tempo de execução.  
Ele **exibe o tipo de dado** e **detalha o valor real**, incluindo o conteúdo de arrays e objetos.

---

## 🧩 O que faz o `var_dump`?

- Mostra **tipo primitivo**: `int`, `string`, `bool`, `array`, `object`, `null`.
- Exibe **tamanho** (strings e arrays).
- Mostra **estrutura recursiva**: arrays aninhados e propriedades de objetos.
- Retorna `void` → só imprime na tela.

---

## ✅ Sintaxe básica

```php
<?php
    var_dump($variavel);
?>
```

Aceita vários argumentos:

```php
<?php
    var_dump($a, $b, $c);
?>
```

## Exemplo prático:
Entrada:

```php
    <?php
    $idade = 25;
    $nome = "Rick Sanchez";
    $habilidades = ['PHP', 'MySQL', 'JavaScript'];
    $ativo = true;

    var_dump($idade);
    var_dump($nome);
    var_dump($habilidades);
    var_dump($ativo);
?>
```

Saída:

```csharp
    int(25)
    string(12) "Rick Sanchez"
    array(3) {
    [0]=>
    string(3) "PHP"
    [1]=>
    string(5) "MySQL"
    [2]=>
    string(10) "JavaScript"
    }
    bool(true)
```

## ⚙️ Quando usar

- ✅ Verificar tipo real de uma variável.
- ✅ Inspecionar estrutura de arrays/objetos complexos.
- ✅ Depurar resultados de funções.
- ✅ Confirmar se variáveis estão definidas ou null.


## Comparação com outras funções de debug

| Função            | O que faz                                                                           |
| ----------------- | ----------------------------------------------------------------------------------- |
| `echo`            | Apenas imprime valor como string.                                                   |
| `print_r`         | Exibe estrutura de arrays/objetos de forma mais legível, mas **sem mostrar tipos**. |
| `var_dump`        | Mostra **tipo, tamanho e estrutura completa**.                                      |
| `var_export`      | Similar ao `print_r`, mas retorna código PHP válido.                                |
| `debug_zval_dump` | Mostra info extra sobre contagem de referências.                                    |

## ⚠️ Cuidados

Em produção, remova ou comente var_dump → não exponha estrutura de dados sensíveis.

Para debug em páginas HTML, combine com <pre>:

```php
<?php
    echo '<pre>';
    var_dump($variavel);
    echo '</pre>';
?>
```

##  Dicas

Para debug mais controlado, use print_r para visual rápido.

Para análise profunda, prefira var_dump.

Para debug avançado → use xdebug com breakpoint e stack trace.

## Exemplo real aplicado

```php
<?php
    function somar($a, $b) {
        $soma = $a + $b;
        var_dump($soma); // Debug em runtime
        return $soma;
    }

    $resultado = somar(5, 10);
?>
```

## Resumo

| Função            | Vantagem                                |
| ----------------- | --------------------------------------- |
| `var_dump`        | Mais detalhado, mostra tipo e estrutura |
| `print_r`         | Legível, mas menos detalhado            |
| `echo`            | Apenas string                           |
| `debug_zval_dump` | Baixo nível, raramente usado            |

## Conclusão 
Use var_dump como sua lupa para enxergar o que o interpretador PHP realmente enxerga.