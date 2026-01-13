# INJEÇÃO DE DEPEÊNCIA E INVERSÃO DE CONTROLE (Base Conceitual da Arquitetura Moderna) 

## O PROBLEMA ORIGINAL (ponto de partida científico)

Antes de falar de DI ou IoC, precisamos entender qual problema eles resolvem.

O problema:

- Objetos criam suas próprias dependências.

```php
class PedidoService
{
    private PedidoRepository $repo;

    public function __construct()
    {
        $this->repo = new PedidoRepository();
    }
}
```

Análise técnica:

- Forte acoplamento
- Difícil de testar 
- Difícil de substituir implementações
- viola DIP (SOLID)

Isso é acoplamento concreto.

## Inversao de controle (IoC) - Conceito

Definição formal:

Inversão de Controle é um princípio arquitetural, onde:

- O controle de fluxo e criação de dependências

- é invertido em relação ao código tradicional.

Ou seja:

- O objeto não decide

- Ele recebe decisões externas

📌 IoC não é uma técnica, é um princípio.

## O que foi invertido?

Antes:

- Classe cria dependências

- Classe controla fluxo

Depois:

- Dependências vêm de fora

- Fluxo é orquestrado externamente

## Injeção de Dependência (DI) — CONCEITO

Definição formal:

- Injeção de Dependência é um padrão de implementação de IoC. Dependências são fornecidas a um objeto em vez de serem criadas por ele.

📌 DI é uma forma de aplicar IoC.

## Relação entre os conceitos

| Conceito                             | Tipo                |
| ------------------------------------ | ------------------- |
| Inversão de Controle                 | Princípio           |
| Injeção de Dependência               | Padrão              |
| Service Container                    | Infraestrutura      |
| Dependency Injection Container (DIC) | Implementação       |
| Factory                              | Estratégia auxiliar |

## TIPOS DE INJEÇÃO DE DEPENDÊNCIA

### 1 - Injeção via construtor (canônica)

```php
class PedidoService
{
    public function __construct(
        private PedidoRepositoryInterface $repo
    ) {}
}
```

✔ Imutável
✔ Explícita
✔ Testável
✔ Preferida


### 2 - Injeção via método (setter)

```php
class RelatorioService
{
    private LoggerInterface $logger;

    public function setLogger(LoggerInterface $logger): void
    {
        $this->logger = $logger;
    }
}
```

⚠ Opcional
⚠ Estado inválido possível

## Injeção via método de negócio

```php
public function gerar(Relatorio $relatorio, LoggerInterface $logger)
```

✔ Útil para dependências transitórias

## DIP — Dependency Inversion Principle

Definição formal:

    Módulos de alto nível não devem depender de módulos de baixo nível.
    Ambos devem depender de abstrações.

```php

    # Lembrando que Interface em php é a estruturacao de um metodo
    # ele cria um contrato entre o metodo, acao e o conceito...

    interface PedidoRepositoryInterface
    {
        public function salvar(Pedido $pedido): void;
    }

# Crinado a Class Service
class PedidoService
{   
    # materializando o contrado
    public function __construct(
        private PedidoRepositoryInterface $repo
    ) {}
}
```

📌 Isso só funciona com DI.

## DI NÃO é composição (reforço crítico)

Mesmo no construtor:

```php
public function __construct(Logger $logger)
```

- Não há criação interna
- Não há controle de ciclo de vida
- O objeto existe fora

Associação obrigatória

## Service Container (IoC Container)

O que é:

Um objeto responsável por:

- Criar instâncias

- Resolver dependências

- Gerenciar ciclo de vida

- Aplicar configurações

📌 Ele centraliza o IoC.

#### Exemplo simplificado (conceitual)

```php
$container->bind(
    PedidoRepositoryInterface::class,
    PedidoRepositoryMysql::class
);

$service = $container->make(PedidoService::class);
```

```php
# Exemplo do LARAVEL

class PedidoService
{
    public function __construct(
        PedidoRepositoryInterface $repo
    ) {}
}
```

- Resolve automaticamente

- Injeta dependências

- Controla ciclo de vida

📌 Você escreve regra de negócio, não criação.

## Diferença entre DI e FACTORY

| Factory          | DI                   |
| ---------------- | -------------------- |
| Cria objetos     | Fornece objetos      |
| Lógica explícita | Resolução automática |
| Útil localmente  | Útil globalmente     |

## REGRA DE OURO

- Quem cria, controla.
- Quem recebe, depende.

- DI é sobre dependência explícita, não comodidade.

## MENTALIDADE CORRETA

- IoC muda arquitetura

- DI muda acoplamento

- DIP muda direção de dependência

- Container muda infraestrutura

## Conclusão Final

- Injeção de dependência é a ferramenta.
- Inversão de controle é o princípio.
- DIP é a regra.
- O container é o meio.
