import React from "react";

import { ReactElement,JSX } from "react";

/* Importando o componente */

import ComponentUm from "./index";

import ComponenteComProps from "../fundamentos_thow/index";

// definido uma variável do tipo array de string, que é o tipo de dado esperado pelo nosso componente com props, que é o componente filho
// lembrando que props são do tipo objeto! 
const listaUsers:string[] = ['Ana','Bruno','Carlos','Daniel','Eduarda'];

const ComponenteDois:React.FC = ():JSX.Element|ReactElement => {

    /* 
        Lembrando que famosos bigodes "{}", tambem conhecidos como chaves
        são naturalmente usadas para inserir expressões JavaScript dentro do JSX.
        eles são o que chamamos de JavaScript Expressions.
        Com ele podemos colocar lógica JavaScript dentro do JSX Element.
    */

    return(
        <>
            {/* Aqui estamos renderizando o componente pai importado */}
            <ComponentUm />
            <div>
                <p>Este componente criado, é o compoente filho do componante pai acima que foi importado e renderizado</p>
                <p> O componente fiho justamente obtém todos os elementos JSX da página anterior</p>
                <p>Ou seja, ao renderizar essa página no navegador, também é renderizado os elementos</p>
                <p>do compoente acima.</p>
            </div>

            {/* 
                Aqui estamos renderizando o componente com props
                
                Lembrando que os dados são passados do componente pai para o componente filho
                através dos props.
            
            */}
            <ComponenteComProps name={listaUsers}/>
        </>
    );
};

export default ComponenteDois;

// Explicação: O componente acima é o componente filho que renderiza o componente pai