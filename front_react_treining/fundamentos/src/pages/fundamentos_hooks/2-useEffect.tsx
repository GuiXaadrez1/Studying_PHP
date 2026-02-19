import {useEffect, useState} from 'react';
import { JSX } from "@emotion/react/jsx-dev-runtime";

/**
 * Sintaxe do useEffect:
 * 
 * useEffect((callback) => {lógica},[dependências]);
 * 
 *  useEffect é um hook do react que permite realizar efeitos colaterais em
 *  componentes funcionais. Ele é executado após a renderização do componente 
 *  e pode ser usado para realizar tarefas como:
 * 
 * 1 - Manipulação de DOM: Você pode usar o useEffect para acessar e manipular
 *  o DOM, como adicionar ou remover event listeners, ou atualizar o título da
 *  página.
 * 
 * 2 - Requisições de API: Você pode usar o useEffect para fazer 
 * requisições de API
 * 
 * 3 - Limpeza de recursos: O useEffect também pode ser usado para limpar
 * recursos, como cancelar timers ou remover event listeners quando o 
 * componente é desmontado.
 * 
 * 4 - Sincronização de estado: Você pode usar o useEffect para sincronizar 
 * o estado do componente com outros dados, como o estado de outro 
 * componente ou o estado de uma biblioteca de gerenciamento de estado.
 * 
 */

const ComponentWithUseEffect = ():JSX.Element => {

    const [count, setCount] = useState(0);
    const [calculation, setCalculation] = useState(0);

    
    // executa algo, baseado em algo... mudança de um valor, carregamento da página
    useEffect(() => {
        // basicamente vamos atualizar o valor de calculation toda vez que o valor de count mudar
        // multiplicando o valor de count por 2
        setCalculation(count * 2);
    }, [count]);

    // esse [count] é um array de dependências, ou seja, o useEffect só será
    //  executado quando o valor de count mudar. Se não passarmos esse array,
    //  o useEffect será executado toda vez que o componente for renderizado,
    //  o que pode causar problemas de desempenho.

    return (
        <div>
            <button onClick={() => setCount(count + 1)}>Click Aqui</button>
            <p>Contagem de Clicks: {count}</p>
            <p>Valor da contagem atualizada após despará um efeito colateral do useEffect: {calculation}</p>
        </div>
    );

}

// Lembre-se Os nomes dos componentes devem começar com letra maiúscula, caso contrário, o React os tratará como elementos DOM nativos em vez de componentes personalizados. Portanto, é importante seguir essa convenção para garantir que seus componentes sejam renderizados corretamente.
export default ComponentWithUseEffect;