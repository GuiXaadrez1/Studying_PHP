/*
    Irei explicar de forma resumida como funciona a hierarquização entre componentes
    ao qual chamamos de "Estilização em Cascata" ou componente pai e componente filho.
*/ 

import React from 'react';
import {ReactElement,JSX} from "react";

import './styled.css';

const ComponenteUm:React.FC = ():ReactElement => {
    return(
        <div>
            <h3>olá este é o componente que vai servir de pai para o compoente fiho</h3>
        </div>
    );
}

export default ComponenteUm;

// Explicação: O componente acima é o componente pai que irá renderizar no componente filho