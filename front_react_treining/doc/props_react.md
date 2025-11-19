## Introdução

Em um ecossistema React, props são entidades que funcionam como parâmetros imutáveis transmitidos de um componente-pai para um componente-filho.

Do ponto de vista científico, você pode tratá-los como:

- Dados de entrada controlados externamente (input parameters)

- Variáveis independentes que influenciam o comportamento do componente

- Um canal unidirecional de fluxo de informação (downward data flow)

Em termos de engenharia, props são o contrato de interface pública — análogo a um API surface de um módulo.

## A Teoria Física do Fluxo de Dados (Unidirecionalidade)

React segue o princípio de UI = f(state, props).

f -> é uma função pura.

state -> é interno ao componente.

props -> é externo e imutável durante o ciclo de vida da renderização.

Se quisermos descrever isso matematicamente:

```ini
RenderOutput = Component(props, state)
```

Imutabilidade dos props impede efeitos colaterais e assegura que:

- A mesma entrada → gera a mesma saída (determinismo)

- O componente filho não tenha autoridade para modificar o que pertence ao pai

- O sistema mantenha previsibilidade na re-renderização

## Estrutura Atômica: Props como Elementos Químicos

Imagine um componente como um molécula.

Cada prop é um átomo que compõe a molécula:

- type → define a natureza do átomo (string, number, boolean, funções)

- defaultValue → define um estado energético base

- propTypes → definem a estabilidade química esperada

- children → representam ligações químicas com outras moléculas

O componente só é estável se os átomos recebidos forem compatíveis com sua estrutura

## Props como “Campos de Força Externos” (External Forces Model)

Uma metáfora mais avançada:

- Props funcionam como forças externas que atuam sobre o componente.

O componente:

- Recebe essas forças

- Calcula sua “resposta”

- Gera um resultado visual coerente

Isso também explica:

- O componente não altera o valor da força (imutabilidade)

- Apenas responde a ela (comportamento declarativo)

## Representação Real: A Fórmula Funcional do React

```typescript

// crinado uma interface que materializa a estrutura de um objeto que pode ser um tipo de dado

interface UserCardProps {
  name: string;
  age: number;
  onSelect: () => void;
}

/*
    Criando nosso componente que rescebe nosso props
    foi realizado uma desestruturação de objetos/arrays paca captar cada propriedade
    do nosso props
*/
function UserCard({ name, age, onSelect }: UserCardProps) {
  return (
    <div onClick={onSelect}>
      <h1>{name}</h1>
      <p>{age} anos</p>
    </div>
  );
}
```

Note que o componente:

- Desestrutura os props → similar a extrair variáveis independentes de uma equação.

- Usa esses valores como entradas puras.

- Apresenta um output determinístico baseado nessas entradas

## Props vs State (Análise de Sistemas)

| Aspecto                 | Props                    | State                              |
| ----------------------- | ------------------------ | ---------------------------------- |
| Origem                  | Externa (pai → filho)    | Interna (definida pelo componente) |
| Mutabilidade            | Imutáveis                | Mutável via setState/useState      |
| Controle                | Pai controla             | Component controla                 |
| Responsabilidade lógica | Configurar comportamento | Gerenciar reatividade local        |
| Analogia científica     | Variáveis independentes  | Variáveis dependentes              |


Props como Funções: A Engenharia dos Callbacks

Props não são apenas dados — podem ser funções.
Isso cria um circuito de feedback controlado.

Exemplo:

```tsx
<UserCard onSelect={() => console.log("selecionado")} />
```

Aqui, o pai transfere ao filho um gatilho funcional.

O filho executa, mas não controla.

É como fornecer uma função de ativação externa.

## Children: O Prop mais singular

children é um prop especial.

Ele permite composição estrutural:

```tsx
<Modal>
  <Form />
</Modal>
```

Na modelagem científica:

- O componente pai é um recipiente

- children são reagentes inseridos nele

- O pai controla o recipiente, não os reagente

## Props são lidos na Renderização — Nunca fora do Ciclo

React só avalia props durante:

- Criação da árvore de elementos (virtual DOM)

- Execução da renderização

- Re-renderização por mudança de estado ou novos props

- Eles não existem como variáveis globais.

## Props são:

- Entradas imutáveis

- Fluxo unidirecional de dados

- Contrato público entre componentes

- Determinantes do comportamento funcional

- Injetáveis como dados, funções ou composição estrutural

- Um mecanismo declarativo integrado ao motor de reconciliação do React

São, essencialmente, a base da arquitetura declarativa, permitindo que React modele interfaces como funções matematicamente puras sobre dados.

## Resumão:

Props são um objeto passado como parâmetro para a função do componente, independentemente de ser:

- Função tradicional

- Arrow function

- Ca-llback function usada como componente

- Componente declarado de qualquer forma

Ou seja:

Quando você cria um componente, você recebe props como um objeto:

```tsx
function MeuComponente(props) {
  return <div>{props.titulo}</div>;
}
```

Quando você usa o componente, você envia props como atributos JSX:

```tsx
<MeuComponente titulo="Hello" />
```

Esse titulo="Hello" vira:

```tsx
props = { titulo: "Hello" }
```

### 🎯 O ponto essencial:

- Props são um objeto de entrada enviado pelo componente pai e recebido como parâmetro pelo componente filho.

- A forma da função não importa.

- A assinatura muda, mas o conceito é sempre o mesmo.