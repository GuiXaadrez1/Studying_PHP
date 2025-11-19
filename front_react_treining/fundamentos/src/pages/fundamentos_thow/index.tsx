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
const ComponenteComProps = ({name}:listaUsersProps):JSX.Element|ReactElement =>{

    return(
        <div>
            {   /* AQUI ESTÁ O NOSSO JAVASCRIPT EXPRESSION */

                name.map((item:string,index:number)=>{
                    return(
                        <li> key={index} O nome do usuário é: {item}</li>
                    );
                })
            }
        </div>
    );

}

export default ComponenteComProps;

// Explicação: O componente acima está recebendo props do tipo array e renderizando os itens do array usando map