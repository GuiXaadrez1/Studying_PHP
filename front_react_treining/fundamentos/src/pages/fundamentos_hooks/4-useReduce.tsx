import { useReducer } from 'react';

// useReduce funciona como se fosse um useState, porém, usa-se para 
// estados mais complexos!

// Basicamente: useState + centralização da lógica de atualização
// Funciona com esse Elementos: estado → reducer → dispatch(action)
// Fluxo: dispatch → reducer → novo estado → re-render

/*
    Com useReduce é permitido lógica de estado personalizado! 
    Se você perceber que está monitorando várias partes do estado
    que dependem de lógica complexa, useReducer pode ser útil.
*/

const estadoInicial = { contador: 0 };

/**
 * Aqui estamos definindo a função auxiliar que será aplicada no useReduce
 * Como temos vários casos no contador é possível realizar essa manipulação
 * lógica para atender as ações necessárias do usuário... 
 * @param estado 
 * @param action 
 */

interface Estado {
    contador: number;
}

interface Action {
    tipo: string;
}

const reducer = (estado:Estado,action:Action) => {
    
    switch(action.tipo){
        case "incrementar":
            return {contador:estado.contador + 1}
        case "decrementar":
            return {contador:estado.contador - 1}
        case "resetar":
            return {contador:0}
        default:
            throw new Error("Ação não suportada!");
    }

};

const Contador = () => {

    // Além de inicializar o useReduce
    // é necessário passar uma função que realize as modificações
    // necessárias para o valor retornado no nosso useReduce...      
    // A função dentro de reduce, é uma função que o reduce sempre vai querer!

    const[estado,dispatch] = useReducer(reducer,estadoInicial);
    return (
        <>
            <div>
                <p>Contagem:{estado.contador}</p>
                <button onClick={()=>dispatch({ tipo: "incrementar" })}>
                    Incrementar ao Contador
                </button>
            </div>
            <div>
                <button onClick={()=>dispatch({tipo:"decrementar"})}>
                    Decrementar ao Contador
                </button>
            </div>
            <div>
                <button onClick={()=>dispatch({tipo:"resetar"})}>
                    Resetar o Contador
                </button>
            </div>
        </>
    )
};

export default  Contador;