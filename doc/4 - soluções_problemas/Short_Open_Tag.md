# 📌 Relatório Técnico — Problema `strict_types` + HTML e Short Echo Tag

---

## 🧩 1️⃣ O Problema Identificado

Em PHP, a diretiva `declare(strict_types=1);` **só funciona se for a primeira instrução executada** no arquivo. Se houver **qualquer HTML antes**, o PHP já emite saída, e a diretiva perde efeito ou gera erro `Fatal error`.

No seu caso, havia **HTML (`<!DOCTYPE html>`) antes do bloco PHP**, impossibilitando ativar `strict_types` de forma correta. Assim, tipos incorretos eram aceitos silenciosamente.

---

## 🛠️ 2️⃣ A Solução Implementada

A solução foi **isolar a parte lógica** no topo do arquivo, antes do HTML:

* `<?php declare(strict_types=1);` logo na primeira linha.
* `include_once` para importar funções.
* Executar cálculos e armazenar resultados em variáveis PHP.
* **Fechar o bloco PHP**, abrir HTML.
* Imprimir valores dentro do HTML usando a **Short Echo Tag `<?= ... ?>`**.

Isso garante que `strict_types` funcione e que o HTML receba dados prontos.

---

## 🔑 3️⃣ O que é Short Echo Tag `<?= ... ?>`

A **Short Echo Tag** é uma **sintaxe reduzida** de `echo`:

```php
<?= $variavel ?>
```

Ela é **equivalente** a:

```php
<?php echo $variavel; ?>
```

Foi criada para facilitar a impressão de valores PHP **diretamente dentro do HTML**.

É **100% segura e suportada** em PHP >= 5.4 — não depende de `short_open_tag` nas configurações do servidor.

---

## 📚 4️⃣ Como usar Short Echo Tag

1️⃣ **Sempre dentro de um arquivo PHP válido.**
2️⃣ Coloque `<?= $variavel ?>` onde quer exibir um valor dentro do HTML.
3️⃣ Serve para variáveis, funções ou expressões: `<?= strtoupper($nome) ?>`.
4️⃣ Não precisa de ponto e vírgula: `<?= ... ?>` já termina o bloco.
5️⃣ Ideal para **inserir resultados** calculados antes, sem abrir novo `<?php`.

---

## ✅ 5️⃣ Exemplo Prático Resolvido

```php
<?php
// Primeira instrução: tipagem estrita
declare(strict_types=1);

include_once 'funcoes.php';
$resultado = soma(10, 20);
$nome = 'Morty';
?>

<!DOCTYPE html>
<html>
  <body>
    <h1>Resultado: <?= $resultado ?></h1>
    <p>Olá, <?= strtoupper($nome) ?></p>
  </body>
</html>
```

---

## 🔑 6️⃣ Benefício Real

* Tipagem estrita **ativa e funcional**.
* Separação entre **lógica (PHP)** e **apresentação (HTML)**.
* Código limpo, manutenção simples.
* Sem erros de "output antes do declare".

---

## 📌 7️⃣ Resumo Final

Usar `<?= ... ?>` resolve o dilema de **misturar saída PHP dentro de HTML**, sem comprometer `strict_types`.
**Primeiro declare, depois lógica, depois HTML.**

Assim seu PHP fica robusto, limpo e profissional.
