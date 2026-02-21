// Continuação do ConceptionChildrenProps.tsx

import {Card} from "./ConceptionChildrenProps"

import {ReactElement} from "react"
import { useState,useEffect } from "react";

const UsingChildren:React.FC = ():ReactElement => {

    const [argument,setArgument]= useState(false);

    const [titleName,setTitleName] = useState("Reunião Parlamentar.")

    const [inputValue, setInputValue] = useState(""); // controla o input

    const handleTitleName = (nameTitle:string) => {
        return nameTitle;
    } 

    const handleArguments = (arg:boolean):any => {

        /*
            VOU DEIXAR ESSE SWITCH CASE COMO REFERENCIA DE ESTUDOS

        switch (arg){
    
            case false:
            
                setArgument(argument)
                return "Colaborador: Esta encerrado a sessão do parlamento."
            
            case true:
                setArgument(argument)
            return "Presidente lula: não esta encerrado meu amigo! Re-abra os trabalhos"
        }*/

        setArgument(arg);
    }
    
    // Condição de Efeito colateral!

    /*

        O useEffect só faz sentido se você precisa reagir a mudanças de estado
        ou props com efeitos colaterais externos.
        
        Usar setters (setArgument, setTitleName) como dependências não faz
        sentido, porque eles nunca mudam.

        useEffect(() => { 
        },[setArgument,setTitleName])

    */

    const handleSubmit = (e: React.FormEvent<HTMLFormElement>) => { 
        
        e.preventDefault();

        if (inputValue.trim() !== "") {
            
            setTitleName(inputValue);
            
            setInputValue(""); // limpa o campo

        }};

    return(
        <>
            {/* 
                Perceba que criamos um componente que aceta outros componentes
                dentro dele! Este componente CARD é o componente pai dos]
                componentes que estao dentro dele... no sentido de usar a prop
                especial => children

                porem o componente pai do componente CARD é este que estamos
                criando neste arquivo useChildren... e podemos passar os dados
                deste componente tanto para o componente CARD e os seus filhos 
                via PROPS normais... 
            */}
            <Card>

                <form onSubmit={handleSubmit}>
                    <input type="text" 
                        value={inputValue} // valor do input
                        onChange={(e) => setInputValue(
                            e.target.value // pegando o valor do input
                        )}
                    />
                    <button type="submit">Atualizar título</button>
                </form>

                <h1>
                    {titleName}
                </h1>
                <p>
                    {
                        argument 
                        ? "Presidente Lula: não está encerrado meu amigo! Reabra os trabalhos"
                        : "Colaborador: Está encerrada a sessão do parlamento."
                    }
                </p>

                {/* Botões para disparar mudanças */}
                {/*
                    Para Referência de estudos!

                    <button onClick={() => handleTitleName("Sessão Extraordinária")}>
                        Mudar título
                    </button> 
                */}

                <button onClick={() => handleArguments(false)}>
                    Encerrar sessão
                </button>
                
                <button onClick={() => handleArguments(true)}>
                    Reabrir sessão
                </button>

            </Card>
        </>
    )
}


export default UsingChildren;

