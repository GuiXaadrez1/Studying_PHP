# 1 - Introdução

No ecossistema tipado do React com TypeScript, três entidades são fundamentais para compreender como componentes são definidos, processados e renderizados:

- React.FC

- ReactElement

- JSX.Element

Embora frequentemente confundidos por iniciantes, esses conceitos representam níveis completamente diferentes dentro da arquitetura interna do React.

Este documento descreve essas diferenças de forma científica, analisando natureza formal, função no ciclo de renderização, impacto na tipagem e implicações arquiteturais.

## 2 - Fundamentos Teóricos

## 2.1 - A distinção entre Componentes e Elementos

### O React opera com duas categorias essenciais:

- Componentes → são funções (ou classes) que produzem elementos.

- Elementos → são objetos imutáveis que descrevem a interface a ser renderizada.

- A diferença entre os três tipos estudados nasce exatamente dessa distinção.

## 3 - React.FC

## 3.1 - Definição

React.FC (Function Component) é um tipo do TypeScript que descreve a assinatura de um componente funcional.

### 3.2 - Natureza Científica

- Representa um tipo de função, não um elemento.

- Impõe que o componente receba props e retorne algo renderizável (geralmente um ReactElement).

- Inclui suporte implícito a children (salvo versões mais recentes que recomendam desabilitar via configuração).

- Padroniza a assinatura:

```tsx
(props: Props) => ReactElement
```

### 3.3 - Implicações Arquiteturais

O uso de React.FC cria um contrato formal que padroniza a criação de componentes, melhorando previsibilidade e consistência no projeto.

### 3.4. Exemplo:

```tsx
// interface é um contrato para um objeto, tipo de dados
interface ButtonProps {
  label: string;
}

const Button: React.FC<ButtonProps> = ({ label }) => {
  return <button>{label}</button>;
};
```

## 4. ReactElement

### 4.1 - Definição

ReactElement é o objeto final que o React utiliza no processo de reconciliação.

### 4.2 - Natureza Científica

É um objeto JavaScript retornado por React.createElement.

É a representação concreta da UI no Virtual DOM.

Contém propriedades internas como:

- type

- props

- key

### 4.3 - Consequência Arquitetural

ReactElement é o produto final da execução de um componente — algo que o React consegue comparar, diffs, reconciliar e finalmente transformar em DOM.

### 4.4 - Exemplo

```tsx
const element: ReactElement = <div>Hello</div>;
```

## 5. JSX.Element

### 5.1. Definição

JSX.Element é o tipo produzido pela transpilação do JSX antes de virar um ReactElement.

### 5.2. Natureza Científica

- Representa o que o TypeScript entende como o “resultado do JSX”.

- Geralmente é equivalente a um ReactElement, mas nem sempre carrega todos os metadados internos.

- Surge da transformação:

```tsx
<Tag />
```

Para:

```tsx
React.createElement(Tag)
```

### 5.3 - Consequência Arquitetural

É o tipo retornado por componentes quando você usa JSX.
Serve como uma camada intermediária entre o JSX e o ReactElement.

## 6 - Comparação Científica

| Critério                      | React.FC                  | ReactElement           | JSX.Element          |
| ----------------------------- | ------------------------- | ---------------------- | -------------------- |
| **Natureza**                  | Tipo de função            | Objeto                 | Objeto               |
| **Função ou produto?**        | Função que cria elementos | Produto final concreto | Resultado do JSX     |
| **Criado por**                | Desenvolvedor             | `React.createElement`  | Compilador JSX       |
| **Usado para**                | Tipar componentes         | Representar nós da UI  | Tipar expressões JSX |
| **Contém props?**             | Define tipo dos props     | Sim                    | Sim                  |
| **Participa do Virtual DOM?** | Não                       | Sim                    | Sim                  |

## Linha do Ciclo Operacional

```ini
React.FC 
  → JSX 
    → JSX.Element 
      → React.createElement() 
        → ReactElement 
          → Reconciliação 
            → DOM Virtual 
              → DOM Real
```

Esse pipeline demonstra claramente que:

- React.FC é entrada (componente);

- JSX.Element é intermediário (tipo gerado pelo compilador);

- ReactElement é produto final (consumido pelo React).

## Conclusão

As diferenças entre React.FC, ReactElement e JSX.Element não são apenas semânticas, mas estruturais dentro da arquitetura do React:

- React.FC → contrato tipado de um componente

- JSX.Element → resultado tipado da expressão JSX

- ReactElement → objeto final consumido pelo mecanismo de reconciliação

Compreender esses três níveis é essencial para dominar React em um nível avançado, criando componentes mais previsíveis, sistemas mais estáveis e pipelines de renderização mais eficientes.