// Iremos aprender de forma um pouco mais detalhada o hook useContext 

// muito utilizado para compartilhar dados entre componentes sem a necessidade
//  de passar props manualmente em cada nível da árvore de componentes. 
// Ele é útil para evitar o "prop drilling", onde você precisa passar props 
// por vários níveis de componentes apenas para chegar a um componente 
// específico que precisa desses dados.

// Ou seja, bastante recomendado para projetos e média a alta complexidade e porte

import { useState, createContext, useContext } from 'react';


// criando um contrato para tipar a variável de contexto! 
// Fazemos isso para justamente não houver problemas de tipo nos valores enviados
// pelos componetes filhos...
interface MyContextType {
    mensagem: string;
    // Esse é exatamente o tipo retornado pelo useState.
    setMensagem: React.Dispatch<React.SetStateAction<string>>
}


// Criando um contexto com um valor padrão
// BASICAMENTE ESTAMOS DEFININDO UM COMPONENTE QUE POSSUI VALOR PADRÃO
export const MyContext = createContext<MyContextType>({
    mensagem: "",
    setMensagem: () => {}
});


// Definido outro componente que basicamente irá indicar quais componetes filhos
// iram obter o valor universal do contexto criado!
export const MyContextProvider = ({ children }: { children: React.ReactNode }) => {

    // ATENÇÃO AO PROP { children }

    // Este prop children é uma convenção em React que representa os elementos
    //  filhos que são passados para um componente de forma implícita. Ele é usado
    //  para permitir que um componente envolva outros componentes ou elementos JSX
    //  dentro dele. Quando você usa o prop children, está dizendo que o componente
    //  pode receber outros componentes ou elementos JSX como filhos,
    //  e esses filhos serão renderizados.

    // AQUI CRIAMOS A LÓGICA DO CONTEXTO Pelo nosso Provedor...

    const [mensagem,setMensagem] = useState('mensagem inicial');

    // value = {valorContexto} é uma variável/props do nosso componente 
    // criado com Contexto que determina o valor do contexto! 

    return (

        <> 
            {/* 
                
                Agora estamos usando o nosso componete que possui um valor
                padrão de contexto do useContext

            */}

            <MyContext.Provider  value={{ mensagem, setMensagem }}>
                {/* Componente filho! */}
                {children}
            </MyContext.Provider>
        </>
    );

};

