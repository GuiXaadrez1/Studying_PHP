# Introdução

Este documento detalha o **comando `declare`** no PHP: como funciona, quais diretivas aceita, efeitos reais no interpretador, escopo, limitações e **exemplos práticos**.

---

## ✅ 1️⃣ O que é `declare`?

`declare` é uma **construção de linguagem** (não é uma função) que instrui o **Zend Engine** a **alterar o comportamento de compilação ou execução** de um script PHP.

---

### 🔑 Definição técnica

> O `declare` **define diretivas de compilação ou runtime** que afetam **blocos de código** ou **o arquivo inteiro**, dependendo da diretiva.

No PHP, `declare` não gera saída. Serve **apenas para instruir o motor de execução**.

---

## 📚 2️⃣ Sintaxe geral

```php
<?php
    declare (directive = value) statement
?>
```
Ou usado em bloco de código:

```php
declare (directive = value) {
    // Bloco de código afetado
}
```

## 3️⃣ Diretivas suportadas

📌 strict_types
📌 Finalidade: Define modo estrito de tipagem escalar.

Valor: 0 (coerção — padrão) ou 1 (estrito).

Escopo: Arquivo inteiro. Só vale no arquivo em que foi declarado. (LEMBRE-SE DO ARQUIVO LOCAL!!!!)

```php
<?php
declare(strict_types=1);

function somar(int $a, int $b): int {
    return $a + $b;
}

echo somar(2, 2); // OK
echo somar(2, "2"); // Erro fatal (TypeError)
?>
```
---

📌 ticks
📌 Finalidade: Executa blocos de código periodicamente.

Valor: Quantidade de ticks (instruções executadas) antes de disparar blocos register_tick_function().

Escopo: Pode ser usado em blocos.

```php
<?php

<?php
declare(ticks=1);

register_tick_function(function() {
    echo "Tick!\n";
});

for ($i = 0; $i < 3; $i++) {
    echo $i . "\n";
}

?>
```
observação: ticks é muito raro em produção — era mais usado em scripts que precisavam monitorar fluxo ou debugar execuções longas.

--- 

📌 encoding (⚠️ Depreciado)
📌 Tentou-se usar para declarar codificação de scripts.

Foi removido — não faz nada desde PHP 5.3.

```php
<?php
    declare(encoding='ISO-8859-1');

?>
```
---

## 4️⃣ Escopo de declare

| Diretiva       | Escopo           | Observação                                      |
| -------------- | ---------------- | ----------------------------------------------- |
| `strict_types` | Arquivo inteiro  | **Precisa ser a primeira instrução do script.** |
| `ticks`        | Bloco ou arquivo | Pode ser isolado em blocos `{}`                 |

---

## 5️⃣ Limitações práticas

strict_types não se propaga:

    Se você include ou require outro arquivo, o modo estrito não é herdado.

    Não existe declare(strict_types=1); global.

    declare não é uma função — não pode ser chamada dinamicamente.

    Ordem importa: para strict_types, nada de output ou espaço antes do <?php.

---

## 6️⃣ Boas práticas

✔️ Use strict_types=1 em projetos críticos, APIs e libs públicas.
✔️ Use declare(strict_types=1) em todos os arquivos para consistência.
✔️ ticks raramente é usado — prefira extensões de profiling modernas.
✔️ Se strict_types não for usado, documente regras de coerção.

## 7️⃣ Casos reais de strict_types

- Projeto sem strict_types:

```php
<?php
    function soma(int $a, int $b): int {
        return $a + $b;
    }

    echo soma(2, "2"); // Funciona: PHP converte "2" em 2
?>
```

- Projeto com strict_types=1:

```php
<?php
    declare(strict_types=1);

    function soma(int $a, int $b): int {
        return $a + $b;
    }

    echo soma(2, "2"); // Erro fatal!
?>
```
---

8️⃣ Debug prático
Teste strict_types criando um mini playground:

```php
// arquivo1.php
<?php
    declare(strict_types=1);
    include 'arquivo2.php';

    echo soma(1, '1'); // Vai funcionar? Depende de onde a função está.
?>

    // arquivo2.php
<?php
    function soma(int $x, int $y): int {
        return $x + $y;
}
?>
```

obsrvação: O strict_types não se aplica a arquivo2.php — apenas ao chamador!

## 9️⃣ Comportamento interno

O Zend Engine lê declare antes de compilar funções, afetando validação de tipos e execução de ticks. 
É um comando do compilador interno, não runtime puro.

## 1️⃣0️⃣ Referências oficiais

- PHP Manual: [declare](https://www.php.net/manual/pt_BR/control-structures.declare.php)

- PHP RFC: [Scalar Type Declarations](https://wiki.php.net/rfc/scalar_type_hints_v5)

