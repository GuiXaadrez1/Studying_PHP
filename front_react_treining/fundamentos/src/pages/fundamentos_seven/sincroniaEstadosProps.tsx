
import { useState,useEffect } from "react";

// estamos passando essa interface, contrato para a props deste componente
// funcional com REACT.FC
// na forma moderna nao é recomendado usar REACT.FC, porem... como no meu
// trabalho usam, logo devemos aprender a manipular da forma mais eficiente
// possivel 
interface ProfileProps{
    name?:string
    userId?:number
}


const PerfilUser:React.FC<ProfileProps> = ({
        // Lembre-se Isso aqui é uma desestruturacao de Objetos
        // estamos desestruturando em variáveis os valores da prop
        userId,
        name
    }) => { 

    // Definido os estados do componentes
    // Lembre-se: useState retorna um array com dois elementos e nao um objeto
    // por mais que a técnica de desestruturação funcione nos dois tipos.
    const [user, setUser] = useState<any>(null);

    // aplicando efeito colateral na nossa página
    useEffect(()=> {
        
        // Buscar Usuário

        /*
        * NESTA FUNCAO
        *    
        *    estamos usando uma funcao assíncrona para obter as informações
        *    lembre-se de comunicaçao entre processos... 
        *    quando usamos uma comunicação assícrona isso significa que um
        *    processo nao bloqueia o outro até que finalize... neste caso
        *    estamos esperando uma resposta que pode ou nao demorar mas
        *    o nosso código nao fica travado esperando uma resposta do 
        *    servidor...
        */
        const findUser = async () => {

            // await faz a espera da resposta afim de obter a informacao
            // neste caso, quando a resposta chega, retoma a lógica aqui
            const response = await fetch(`https://jsonplaceholder.typicode/users/${userId}`);
            const dadosUser = await response.json();
            setUser(dadosUser);
        }

        if(userId){
            findUser();
        }

    },[userId]); // vai renderizar a página apenas quando o usuário id mudar

    return (
        <div>
            {
                // o ternario do react e bem diferente em realcao ao normal
                // variavel = condicional ? value_true: value_false (ternário normal)

                // ternário no React  -> No React, o operador ternário é usado
                //  para renderização condicional dentro do JSX

                userId ? (
                    <p>
                        ID: {userId} <br/> {name}
                    </p>
                ):(
                    <p> Loading User...</p>
                )

                /*
                    Dica de ouro: Sempre use: !!

                    para garantir que valores como strings ou arrays 
                    sejam tratados como booleano

                    {!!nome && <Componente />}
                */

            }
        </div>
    );
}

export default PerfilUser;