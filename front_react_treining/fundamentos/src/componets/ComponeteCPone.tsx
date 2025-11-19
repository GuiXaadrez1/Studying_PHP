// Criando o primeiro componete

import React from "react";
import {JSX} from "react";

// importando o useState
import {useState} from "react";

// criando um componete simples sem componetes filhos
export const CPone:React.FC = ():JSX.Element => {
    return(
        <>
            <div>
                <span>Title</span>
            </div>
        </>
    );
};


// criando um componete que aceita componetes filhos {children}
