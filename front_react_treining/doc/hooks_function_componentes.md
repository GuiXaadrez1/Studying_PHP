# Introdução aos Hooks e à Evolução Funcional no React.js

A evolução da biblioteca React, especialmente a partir da versão 16.8, introduziu uma das mudanças mais significativas na sua arquitetura declarativa: o conceito de Hooks.
Os Hooks trouxeram para os componentes funcionais a capacidade de gerenciar estado, controlar ciclos de vida, acessar o contexto da aplicação e executar efeitos colaterais, eliminando a necessidade do uso de classes.

Essa inovação representa não apenas uma modificação sintática, mas uma mudança estrutural no paradigma de desenvolvimento declarativo do React, aproximando a lógica de estado à simplicidade das funções puras.

# O que são hooks?

Os Hooks são funções especiais do React que permitem “conectar” a lógica de estado e ciclo de vida aos componentes funcionais.

Tecnicamente, são funções JavaScript com regras específicas de uso, cujo prefixo deve ser use (por convenção e exigência do React).

Exmeplo básico:

```typescript
import { useState } from 'react';

const [contador, setContador] = useState(0);
```

Aqui, o useState é um Hook nativo responsável por criar uma variável de estado (contador) e uma função que a atualiza (setContador).

O React monitora esse estado internamente e, ao detectar alterações, re-renderiza o componente de forma otimizada via Virtual DOM.

## Diferença de hooks para -> functions, arrow functions e componetes no react?  

Para compreender a natureza dos Hooks, é essencial distinguir entre:

- Funções comuns (funções de lógica tradicional);

- Funções arrow (funções anônimas e de escopo léxico);

- Componentes React (funções que retornam JSX);

- Hooks React (funções especializadas que interagem com o ciclo interno do React).

A seguir, apresentamos uma análise conceitual e prática.

### função comum, função qualquer

Geralmente são declarados dentro de um componente para realizar alguma iteração com o JSX ou São declarados dentro de um diretório chamado Utils, podendo ser utilizado em outros componentes ou páginas...

Uma função comum é uma estrutura procedural básica do JavaScript/TypeScript, usada para encapsular lógica ou cálculos.

Não interage com o ciclo de renderização do React, nem possui vínculo com o Virtual DOM.

```typescript

const contador:int;

function seq_netural (n:int):int{
    if(n > 0 ){
        n += 1;
    }else if ( n === 0){
        return 0;
    }else{
        return "Forçando error"
    };
};

contador = seq_netural();;
```

Essa função executa um cálculo independente, não participa da renderização nem reage a eventos do React.

### função comum só que com arrow_function

Também, geralmente ficam armazenadas no diretório Utils em projetos em React.

As arrow functions (()=>{}) são expressões de função mais modernas que capturam o contexto léxico (this) e são frequentemente utilizadas:

- Dentro de componentes React para manipulação de eventos;

- Em utilitários (utils), para abstrair lógicas reaproveitáveis.

```typescript

// vale resaltar que acabei de criar um arrow function fortemente tipada
const saudar:saudar = (nome:string):string => {
    return `Olá, ${nome}`;
}

// arrow function normal, sem tipagem forte
const somar = (num1,num2) => {
    return num1 + num2;
}
```

Essas funções são puramente JavaScript, não têm ciclo de vida, nem gatilhos reativos — diferentemente dos Hooks.

### agora vamos fazer um Componente funcional

Um componente funcional é uma função que retorna um elemento JSX, sendo interpretado pelo Virtual DOM e posteriormente renderizado no DOM real.

básicamente vamos retornar um Html que na verdade implícitamente é um componete JSX, elemento JSX são elemntos html dentro do nosso JavaScript/Typescript com react que são renderizados pelo Virtual DOM.

```typescript

// criando um componete com função, lembrando que em versões legadas era necessário
// criar componetes React com classes (POO)

function head_page():JSX.Element{
    return(
        <>
            <head>
                <tile>Componete-Título-React<title>
            <head>
        </>
    );
}
```

Um componente é, essencialmente, uma função especializada que retorna JSX.
O JSX é uma abstração sintática sobre o JavaScript que descreve a interface visual declarativamente.

Antes dos Hooks, componentes funcionais eram estáticos, sem capacidade de armazenar estado ou reagir a eventos internos — algo restrito aos componentes de classe (class extends React.Component).

### Hook nativo (useState) e criação de Hooks personalizados

Com a introdução dos Hooks, os componentes funcionais passaram a ter acesso direto ao estado reativo do React.

Exemplo prático:

```typescript

// hook nativo do react
// cria um array de dois index, representando o valor antigo e um valor novo
import {useState} from 'react'; 

// aqui estamos fazendo uma estratégia chamada de: Desestruturação de Array
// basicamente estamos acessando valores de um array e atribuindo eles 
// à variáveis de valores específicos

// Hook nativo do React
const [nomeSaudar, setNomeSaudar] = useState('Fulano');

// Função que manipula o estado via Hook
const usar_useState = (nome: string): string => {
    setNomeSaudar(nome);
    return `Olá, ${nomeSaudar}`;
};

// Sempre que criamos uma função comum personalizada com um hook nativo do react
// definimos isso com um hooks
// geralmente ps hooks são nativos por padrão do react
```

Desestruturação de array

O useState retorna um array de dois índices:

- O valor atual do estado (nomeSaudar);

- A função que atualiza esse valor (setNomeSaudar).

Essa sintaxe:

```typescript
    const [valor, setValor] = useState(valorInicial);
```

## Características fundamentais dos Hooks

| Característica                             | Descrição                                                                                        |
| ------------------------------------------ | ------------------------------------------------------------------------------------------------ |
| **Prefixo obrigatório `use`**              | Garante que o React identifique e gerencie corretamente o Hook.                                  |
| **Executado sempre no topo do componente** | Hooks não podem ser chamados dentro de loops, condições ou funções aninhadas.                    |
| **Reatividade**                            | Hooks disparam re-renderizações automáticas quando o estado é alterado.                          |
| **Composição**                             | Permitem encapsular lógica reativa reutilizável (custom hooks).                                  |
| **Acesso ao ciclo de vida**                | Hooks substituem métodos como `componentDidMount`, `componentDidUpdate`, `componentWillUnmount`. |


## Comparitivismo Técnico

| Tipo                    | Retorno                 | Estado         | JSX | Reatividade | Uso típico                           |
| ----------------------- | ----------------------- | -------------- | --- | ----------- | ------------------------------------ |
| **Função comum**        | Valor lógico            | ❌              | ❌   | ❌           | Algoritmos e cálculos                |
| **Arrow function**      | Valor lógico            | ❌              | ❌   | ❌           | Manipulação de eventos e utilitários |
| **Componente React**    | JSX.Element             | ✔️ (com Hooks) | ✔️  | ✔️          | Construção de interface              |
| **Hook (ex: useState)** | Array ou objeto reativo | ✔️             | ❌   | ✔️          | Controle de estado e ciclo de vida   |

## Conclusão

Os Hooks representam a convergência entre a programação funcional e o modelo declarativo de UI.

Eles eliminam a necessidade de classes, tornando os componentes mais puros, previsíveis e fáceis de testar.

Em síntese:

- Funções → executam lógica imperativa.

- Componentes → descrevem interface declarativamente.

- Hooks → adicionam estado e ciclo de vida às funções, unificando ambos os paradigmas.