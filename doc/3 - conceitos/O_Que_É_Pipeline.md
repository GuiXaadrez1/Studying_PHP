# Introdução 
Este documento tem o principal objetivo mostrar o conceito geral de uma pipeline

## 📌 O que é Pipeline?

✅ Definição geral:

    Pipeline é um termo que vem do inglês “tubulação” — ou seja, um encadeamento de etapas 
    onde a saída de uma etapa é a entrada da próxima.

    No contexto de computação, pipeline significa organizar um fluxo de processamento em estágios, 
    onde cada estágio faz uma parte do trabalho e passa o resultado adiante.

📚 Exemplo didático (analogia)

Pense numa linha de montagem de carros:

    1️⃣ Um operário monta o chassi.

    2️⃣ Outro instala o motor.

    3️⃣ Outro pinta.

    4️⃣ Outro faz inspeção.

Cada fase depende da anterior. Isso é um pipeline.

## ⚙️ Pipeline em Computação

Pipelines aparecem em várias áreas, cada uma com contexto diferente:

🚦 1️⃣ Pipeline de Compilador (exemplo: Zend Engine)
Quando falamos do Zend Engine, o pipeline é o fluxo interno de execução:


    Código-fonte PHP 
    ↓ Tokenizer
    ↓ Parser (AST)
    ↓ Compiler (Opcode)
    ↓ Executor (VM)

Cada etapa:

    Lê

    Processa

    Entrega para a próxima

⚡️ 2️⃣ Pipeline de CPU (Arquitetura de Processadores)
Em hardware, pipeline é quando uma CPU divide a execução de uma instrução em estágios:

    Fetch (busca a instrução)

    Decode (decodifica)

    Execute (executa)

    Writeback (salva resultado)

Com isso, a CPU executa múltiplas instruções simultaneamente, cada uma em um estágio diferente.
Isso chama-se pipelining de instruções → aumenta performance.

🚀 3️⃣ Pipeline de CI/CD (Integração Contínua / Deploy Contínuo)
Em DevOps, um pipeline é a sequência automatizada para:

    1️⃣ Receber o código (Git).
    2️⃣ Rodar testes.
    3️⃣ Fazer build.
    4️⃣ Publicar em staging.
    5️⃣ Fazer deploy em produção.

Ferramentas como GitLab CI, GitHub Actions, Jenkins, Azure Pipelines executam isso.

🧩 4️⃣ Pipeline de Dados

Em ETL/ELT ou Big Data, Pipeline de dados é o fluxo que:

    1️⃣ Extrai dados.
    2️⃣ Transforma.
    3️⃣ Carrega para outro destino.
    (Ex.: Airflow, Apache Beam, Spark)


## 🔑 Características de um Pipeline

✔️ Encadeamento: Cada estágio depende do anterior.
✔️ Especialização: Cada etapa faz uma parte específica.
✔️ Paralelismo: Em muitos contextos, etapas podem rodar em paralelo, aumentando throughput.
✔️ Automatização: Pipelines modernos automatizam tarefas para reduzir erros manuais.

## Resumo da ideia

Pipeline é um fluxo organizado de etapas conectadas, onde cada etapa processa dados/instruções, tornando o sistema mais modular, eficiente e controlável.

🛠️ Exemplo prático: Pipeline CI/CD em YAML:

Exemplo: .gitlab-ci.yml

stages:
  - build
  - test
  - deploy

build:
  script:
    - npm install
    - npm run build

test:
  script:
    - npm run test

deploy:
  script:
    - ./deploy.sh
Cada stage é um estágio do pipeline.

## Resumindo em 1 frase

Pipeline = fluxo organizado de processamento por etapas, onde cada fase entrega insumo para a próxima.

