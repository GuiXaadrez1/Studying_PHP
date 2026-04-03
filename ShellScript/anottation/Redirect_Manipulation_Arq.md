# Introdução 

Vamos entrar em uma das partes mais importantes do shell: 

controle de fluxo de dados (I/O). Isso é o que separa scripts “que funcionam” de scripts profissionais, previsíveis e robustos.

## Redirecionamento e Manipulação de Arquivos no Bash

### 🧠 Fundamento (isso aqui é o núcleo)

Todo processo no Linux/Unix trabalha com 3 fluxos padrão:

| Nome       | Descritor | Finalidade       |
| ---------- | --------- | ---------------- |
| **STDIN**  | `0`       | Entrada de dados |
| **STDOUT** | `1`       | Saída padrão     |
| **STDERR** | `2`       | Saída de erro    |


### Modelo mental Essencial 

```txt
[STDIN] → comando → [STDOUT] + [STDERR]
```

Isso significa:

- Entrada → vem de arquivo, teclado ou pipe
- Saída → vai para tela, arquivo ou pipe
- Erro → fluxo separado

## uso do cat e grep

```bash


# cat = cat = concatenar e emitir conteúdo


cat arquivo.txt # Lê o arquivo (STDIN interno) / Joga no STDOUT

cat < arquivo.txt # Leia isso como entrada padrão

echo "Olá" | cat # STDIN (echo) → cat → STDOUT ( | = entrada de um saida de outro)

cat a.txt b.txt > resultado.txt # Junta conteúdos / Redireciona para arquivo



# grep = filtrar fluxo de dados com base em padrão



grep "erro" arquivo.txt # Procura linhas que contenham "erro" / Resultado vai para STDOUT

cat arquivo.txt | grep "erro" # arquivo → cat → grep → STDOUT

grep "erro" arquivo.txt # Evita processo desnecessário (UUOC — Useless Use of cat)

echo "erro fatal" | grep "erro" # Entrada via STDIN

grep -i "erro" arquivo.txt # Ignorar case

grep -c "erro" arquivo.txt # Contar ocorrências

grep -n "erro" arquivo.txt # Mostrar número da linha

```

## cat 

| Fluxo  | Comportamento               |
| ------ | --------------------------- |
| STDIN  | aceita                      |
| STDOUT | imprime conteúdo            |
| STDERR | erros (arquivo inexistente) |


## grep

| Fluxo  | Comportamento                  |
| ------ | ------------------------------ |
| STDIN  | principal fonte                |
| STDOUT | linhas filtradas               |
| STDERR | erros (arquivo não encontrado) |


## REDIRECIONAMENTO BÁSICO

### > - Write Sobrescrever arquivo

```bash
echo "Olá mundo" > arquivo.txt
```

- Cria o arquivo
- Sobrescreve se já existir

### >> - Append (acrescentar)

```bash
echo "Nova linha" >> arquivo.txt
```

- Não apaga conteúdo anterior
- Adiciona ao final

### Diferença entre o append e o write

```bash
>   # destrutivo
>>  # não destrutivo
```

## REDIRECIONANDO ERROS

### Write de STDERR 2>

```bash
ls arquivo_inexistente 2> erro.log
```

- Apenas erros vão para o arquivo

### Append de STDERR 2>>

```bash
ls arquivo_inexistente 2>> erro.log
```

- Append de erros

## REDIRECIONANDO TUDO

### Write stdout + stderr = &>

```bash
ls arquivo  &> saida.log
```

- Junta saída normal + erro

#### Forma clássica (mais controlada)

```bash
ls arquivo > saida.log 2>&1
```
- > → stdout
- 2> &1 → stderr aponta para stdout

## DESCARTANDO SAÍDA

### /dev/null

```bash
ls arquivo_inexistente > /dev/null 2>&1
```
- ignora tudo (output + erro)

## REDIRECIONAMENTO DE ENTRADA

### <

```bash
cat < arquivo.txt
```

- Arquivo vira entrada do comando

### PIPELINE (ENCADENAMENTO) |

```bash
cat arquivo.txt | grep "erro"
```

- Saída de um vira entrada de outro

### HERE DOCUMENT (MULTILINHA)

```bash
cat << EOF
linha 1
linha 2
EOF
```

- Muito usado em scripts automatizados

### HERE STRING

```bash
grep "hello" <<< "hello world"
```

### Descritores Personalizados

```bash
exec 3> arquivo.txt
echo "teste" >&3
```

- Controle avançado de I/O

## Como devemos pensar?

Quando você escreve shell script, pense sempre:

- “Para onde está indo o STDOUT?”

- “E o STDERR?”

- “Eu preciso logar isso ou ignorar?

## Resumo Estrutural

| Operador    | Função              |      |
| ----------- | ------------------- | ---- |
| `>`         | sobrescreve         |      |
| `>>`        | append              |      |
| `2>`        | erro                |      |
| `2>>`       | append erro         |      |
| `&>`        | tudo                |      |
| `2>&1`      | junta streams       |      |
| `<`         | entrada             |      |
| `           | `                   | pipe |
| `<<`        | heredoc             |      |
| `<<<`       | here string         |      |
| `>&`        | redireciona saída   |      |
| `<&`        | redireciona entrada |      |
| `/dev/null` | descartar           |      |
