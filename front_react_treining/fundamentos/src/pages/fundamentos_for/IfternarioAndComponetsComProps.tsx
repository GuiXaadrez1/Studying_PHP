import {JSX,ReactElement, useState} from 'react';


// Criando o componente com Renderização Condicional usando operador ternário
// e variavel de estado com useState

// Lembrando Interface são estruturas objetos aos quais podemos ter acesso
//  a suas propriedades e métodos, elas são usadas para definir 
// contratos de dados entre componentes, garantindo segurança de tipo, 
// previsibilidade e documentação implícita do componente.
interface LoginButtonProps {
    loggedIn: boolean;
}

const LogginButton: React.FC <LoginButtonProps>= ({loggedIn}) => {
    
    // aqui definimos um type generic especializado
    // indicando que o tipo do estado é boolean apartir da 
    // primeira renderizacao do componente, ou seja, o valor inicial do estado
    const [isLoggedIn, setIsLoggedIn] = useState<boolean>(loggedIn);

    // atenção ao JavaScript Expression -> {...} dentro do JSX  
    return (
        <>
            <div>
                
                {/*
                    
                    Cuidado com o uso de operador ternário em JSX 
                    Aqui estamos validando se o estado isLoggedIn é verdadeiro 
                    ou falso para renderizar o botão de login ou logout 
                    O operador ternário é uma forma concisa de escrever uma 
                    expressão condicional, mas deve ser usado com moderação para evitar
                    código difícil de ler. Em casos mais complexos, pode ser melhor
                    usar uma estrutura de controle mais tradicional, como if-else, 
                    para melhorar a legibilidade do código.
                
                */}
                
                {isLoggedIn ? (
                    <button onClick={() => setIsLoggedIn(false)}>
                        Logout
                    </button>
                ) : (
                    <button onClick={() => setIsLoggedIn(true)}>
                        Login
                    </button>
                )}
            </div>

            <p>
                {isLoggedIn ? "Usuário logado" : "Usuário não logado"}
            </p>
        </>
    );
};


export default LogginButton;    


// ANÁLISE DESTE CÓDIGO COM SEUS DEVIDOS COMPONENTES, PROPS, ESTADOS E EVENTOS E ETC... 

// ============================================================
// 1 - Criamos um componente de botão de login/logout 
// usando operador ternário para renderização condicional
// ============================================================

// ------------------------------------------------------------
// 2 - IMPORTAÇÕES:
//
// React é necessário para permitir o uso de JSX
// useState é um Hook responsável por gerenciar estado interno
// ------------------------------------------------------------

// ------------------------------------------------------------
// 3 - TIPAGEM DAS PROPS COM INTERFACE:
// 
// Interfaces são utilizadas para definir contratos de dados
// entre componentes. Elas garantem segurança de tipo,
// previsibilidade e documentação implícita do componente.

// Neste caso, definimos que o componente espera receber
// uma propriedade chamada "loggedIn" do tipo boolean
// ------------------------------------------------------------


// ------------------------------------------------------------
// 4- GERENCIAMENTO DE ESTADO COM useState

// useState cria estado local no componente.
// O estado controla a renderização dinâmica da interface.

// Aqui estamos inicializando o estado com base na prop.
// Isso define o valor inicial do estado.

// IMPORTANTE:

// Esse valor será usado apenas na primeira renderização.
// Mudanças futuras na prop NÃO alteram automaticamente o estado.

// ------------------------------------------------------------

// ------------------------------------------------------------
// 5 - RENDERIZAÇÃO DO COMPONENTE

// React exige que o retorno seja um JSX.Element.

// Quando há múltiplos elementos, utilizamos Fragment (<> </>)
// para evitar criação desnecessária de nós no DOM.

// ------------------------------------------------------------

//----------------------------------------------- 
// 6 -  RENDERIZAÇÃO CONDICIONAL COM OPERADOR TERNÁRIO

// O operador ternário é uma JavaScript Expression
// utilizada dentro do JSX.

// Sintaxe:
// condição ? resultado_verdadeiro : resultado_falso

// React permite expressões JavaScript dentro de {}.
//-----------------------------------------------


// ============================================================
// ANÁLISE TÉCNICA DO COMPONENTE - RESUMO:
// ============================================================


// ✔ Fluxo de Dados
// Props → Estado Inicial → Renderização → Eventos → Novo Estado

// ✔ JSX.Element
// Todo componente React deve retornar um elemento JSX válido.
// Fragment permite múltiplos elementos sem criar divs extras.

// ✔ Operador Ternário
// Permite renderização declarativa.
// Evita uso de estruturas imperativas como if dentro do return.

// ✔ Hook useState
// Controla o ciclo de re-renderização.
// Sempre que setState é chamado:
// → React recalcula o Virtual DOM
// → React compara mudanças
// → Atualiza o DOM real apenas se necessário.


// ✔ Cuidados Arquiteturais
// Inicializar estado com props pode gerar inconsistência.
// Em arquiteturas maiores, recomenda-se componente controlado.