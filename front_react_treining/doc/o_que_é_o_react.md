## Introdução Geral

O desenvolvimento web moderno passou por uma profunda transformação com o surgimento de bibliotecas e frameworks voltados para a construção de interfaces dinâmicas e reativas. Dentre eles, o React.js, criado pelo Facebook (Meta) em 2013, destacou-se por introduzir um novo paradigma de renderização baseada em componentes e pelo uso de um DOM Virtual (Virtual DOM) para otimizar a manipulação da árvore de elementos do documento HTML.

O objetivo deste documento é apresentar uma análise científica sobre os fundamentos que sustentam o React, com ênfase no funcionamento do DOM, Virtual DOM, Componentização e a diferença entre páginas e componentes.

# O que é o react?

O React.js é uma biblioteca JavaScript declarativa e baseada em componentes voltada para a construção de interfaces de usuário (UI – User Interface).

Em vez de manipular o DOM real diretamente, o React utiliza uma representação virtual do mesmo — chamada de Virtual DOM — que atua como uma camada intermediária entre a lógica da aplicação e a interface renderizada no navegador.

### Princípio de funcionamento

O React trabalha com uma árvore de componentes que reflete a estrutura da interface. Quando um estado interno ou uma propriedade muda, o React:

- Reconstrói uma nova árvore virtual representando o estado atualizado;

- Compara essa nova árvore virtual com a versão anterior, utilizando um algoritmo de diferenciação (diffing algorithm);

- Identifica apenas as partes que realmente mudaram;

- Atualiza seletivamente o DOM real — minimizando operações custosas e melhorando o desempenho.

- Este processo é denominado Reconciliação (Reconciliation).

## O que é o DOM?

O DOM é a representação em memória de um documento HTML ou XML. Ele transforma a estrutura hierárquica do arquivo em uma árvore de objetos, na qual cada nó representa um elemento, atributo ou texto do documento.

### Estrutura do DOM (Document  Object Model)

Cada página HTML, ao ser carregada pelo navegador, é convertida em uma árvore DOM. Por exemplo:

```html
<html>
  <body>
    <h1>Exemplo</h1>
    <p>Texto</p>
  </body>
</html>
```

É representada internamente como:

```bash
HTML
 └── BODY
      ├── H1
      └── P
```

Cada nó é acessível e manipulável via JavaScript, permitindo alterações dinâmicas na interface (por exemplo, document.getElementById() ou element.innerHTML).

### Como o DOM funciona internamente

O DOM é uma API de programação que reflete o documento carregado. Toda vez que ocorre uma mudança (por exemplo, ao inserir um elemento via JavaScript), o navegador precisa recalcular a renderização da página — o que envolve:

- Reflow: Recalcular posições, dimensões e hierarquia dos elementos;

- Repaint: Reaplicar cores, bordas e estilos visuais;

- Renderização final: Atualizar o pixel na tela.

Essess processos são custosos em termos de desempenho, especialmente em interfaces com alto volume de interações.

Por isso, o React introduziu o Virtual DOM, que atua como uma camada de abstração e otimização sobre o DOM real.

### O Virtual DOM e o ReactDOM

O Virtual DOM é uma cópia leve e abstrata do DOM real mantida em memória. Ele não é renderizado no navegador, mas utilizado internamente pelo React para calcular a menor diferença possível entre o estado anterior e o novo estado da interface.

### Processo de Reconciliação

Quando o estado de um componente muda:

- O React cria uma nova versão do Virtual DOM;

- O algoritmo de diffing compara essa nova árvore com a anterior;

- As diferenças são agrupadas em um patch (conjunto de mudanças);

- Apenas os nós realmente alterados são enviados ao ReactDOM, que os aplica no DOM real.

Esse mecanismo garante eficiência e reatividade, reduzindo operações redundantes de renderização.

## O que são as paginas e componetes? Qual a diferença?

### Páginas vs. Componentes

No React, toda a interface é construída a partir de componentes, que são unidades independentes e reutilizáveis de código responsáveis por renderizar partes da interface.

1 - Componentes

Básicamente são funções ou arrow function que retornam componentes JSX ao qual consegue entender scripts html.

```typescript

// exemplo de um componente criado através de uma função, em projetos legados

function Saudar():JSX.Element{
    return(
        <>
            <h1>Olá,mundo</h1>
        </>
    );
}

export default saudar; 

// Os componentes eram criados através de de Class para materializar um Objeto tipo JSX.Element

// esse JSX.Element posteriomente é lido em pelo react render e transformado em um HTMelement

// Outra forma de exportar um componente

// lembrando que para cria rum componente, o nome dele ao criar um função que retorna um jsx 
// deve inicar com letrar maiúscula 
export function Saudar():JSX.Element{
    return(
        <>
            <h1>Olá,mundo</h1>
        </>
    );
}
```

Os componentes:

- Possuem estado interno (useState, this.state);

- Podem receber propriedades externas (props);

- São reutilizáveis e compostos (um componente pode conter outro).

## Páginas

Uma página é uma composição maior formada por múltiplos componentes. 

**Em aplicações React com roteamento (usando react-router-dom), cada rota representa uma página.**

Exemplo:

```bash
/home → Página Home (com Header, Footer, Cards, etc.)
/about → Página Sobre (com texto e imagens)
```

### Resumo

| Conceito       | Definição                                                             | Exemplo                  |
| -------------- | --------------------------------------------------------------------- | ------------------------ |
| **Componente** | Unidade funcional reutilizável que representa uma parte da interface. | Botão, Input, Card, Menu |
| **Página**     | Conjunto de componentes que formam uma tela completa.                 | Home, Login, Dashboard   |

## Conclusão

O React não é apenas uma biblioteca de UI; é uma arquitetura declarativa baseada em componentes e estados, otimizada por uma camada de abstração inteligente (Virtual DOM).
O entendimento do DOM real, do Virtual DOM, e da composição de componentes e páginas é essencial para compreender o comportamento reativo e performático do React.

Esses princípios permitem ao desenvolvedor estruturar aplicações modulares, eficientes e escaláveis, alinhadas com os paradigmas contemporâneos de engenharia de software front-end.