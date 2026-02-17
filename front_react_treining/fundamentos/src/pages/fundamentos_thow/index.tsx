import React from "react";
import {ReactElement,JSX} from "react";


// Criando uma estrutura para um objeto, usamos para criar um tipo de dado também
interface listaUsersProps{
    name:string[];
}

/*

Resumidamente, props são Props são um objeto de entrada enviado pelo componente pai e 
recebido como parâmetro pelo componente filho. 

Eles permitem que os componentes sejam dinâmicos e reutilizáveis,

*/

// usando desestruturação de objetos e arrays no nosso props
const ComponenteComProps:React.FC<listaUsersProps> = ({name}:listaUsersProps):JSX.Element|ReactElement =>{

    return(
        <div>
            {   /* AQUI ESTÁ O NOSSO JAVASCRIPT EXPRESSION */

                // Lembrando que o método map é usado para iterar sobre um array
                //  e retornar um novo array com os resultados da função aplicada 
                // a cada elemento do array original.

                // Neste caso estamos usando o map apenas para renderizar 
                // os itens do array name, que é o nosso props, 
                // e renderizando cada item do array em um elemento li.

                name.map((item:string,index:number)=>{
                    return(
                        <li key={index}> O nome do usuário é: {item.toUpperCase()}</li>
                    );
                })
            }
        </div>
    );

}

export default ComponenteComProps;

// Explicação: O componente acima está recebendo props do tipo array e 
// renderizando os itens do array usando map 
// o map basicamente retorna um novo array com os resultados 
// da lógica aplicada sobre a função anônima/arrow function ou callback function,
// que é a função passada como argumento para o map,
// aplicando em cada elemento do array original, e nesse caso, renderizando cada item do array em um elemento li.
