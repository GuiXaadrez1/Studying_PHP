// Importando a biblioteca react
import React from 'react';
import ReactDOM from 'react-dom/client';

// importando arquivos estáticos ou de estilização
/*import './logo.svg'*/

// importando o arquivo index.css referente a nossa main.tsx/index.tsx
/*import './index.css'*/

// importando o componete padrão criado pelo react mas que foi personalizado neste projeto
//import App from './App';

// importando página personalizada da módulo home
//import Home from './pages/home/index';

// importando página para aprender componentes pais que serevem de containers para seus filhos
//import cpFaither from './pages/cpfaither_cpson/cpfaither';

// importando componentes criados no pacote fundamentos_one
import ComponenteDois from './pages/fundamento_one/indexCPthow';
import Botton from './pages/fundamentos_three/index';
import Form from './pages/fundamentos_for/index';
import LogginButton from './pages/fundamentos_for/IfternarioAndComponetsComProps';
import ErrorMessage from './pages/fundamentos_five';
import MapInListNumbers from './pages/fundamentos_five/MapInListNumbers';
import BotaoEstilizadoUm from './pages/fundamentos_six/index';

// Estudos dos HOOKS NATIVOS DO REACT

// useEffect and useState
import ComponentWithUseEffect from './pages/fundamentos_hooks/2-useEffect';
import Timer from './pages/fundamentos_hooks/2_1 - useEffect-LimpezaEstado';

// useContext
import { MyContext,MyContextProvider } from './pages/fundamentos_hooks/3-useContext';
import ComponenteFilho from './pages/fundamentos_hooks/3_1 - componenteFilho';
import ValueContext from './pages/fundamentos_hooks/3_2-ValueContext';

// useReducer
import Contador from './pages/fundamentos_hooks/4-useReduce';

// Hook Custom
import ComponenteUseHookCustom from './pages/fundamentos_hooks/5_1 - Componente_Custom_hook';

// Children, o prop especial do REACT
import UsingChildren from './pages/fundamentos_seven/useChildrenConception';

// Sincronizando estados (useState/useEffect) com props

import PerfilUser from './pages/fundamentos_seven/sincroniaEstadosProps';

// HOOK USE MEMO AND USE CALLBACK
import HeavyCalculation from './pages/fundamentos_hooks/useMemo'; // useMemo
import ContadorCallback from './pages/fundamentos_hooks/useCallBack'; // useCallBack


// importando o arquivo reportWebVitals para medir o desempenho da aplicação
import reportWebVitals from './reportWebVitals';

// root variável que cria um DOM virtual ao qual contém nossa página principal para ser 
// renderizada, essa variável comporta um objeto ReactDOM
const root = ReactDOM.createRoot(
  document.getElementById('root') as HTMLElement
);

root.render(
  <>
    <React.StrictMode> {/* React.StrictMode é um componente que ativa verificações e avisos adicionais para seus descendentes. Ele é usado para ajudar a identificar problemas potenciais em uma aplicação React durante o desenvolvimento. Ele não afeta o comportamento da aplicação em produção, mas pode ajudar a detectar problemas como ciclos de vida obsoletos, uso de APIs inseguras e outros problemas comuns. */ }
     
      {/* Projetinho de estudo inical...  */}
      {/*   comentando componete <App/> */} 
      {/*<Home/>*/}


      {/* Fundamentos Iniciais */}

      <ComponenteDois/> {/* Componente para aprender sobre componentes pais e filhos e herança de dados por meio de props*/}
      <Botton/> {/* Componente de botão para aprender sobre eventos, estados e props */}
      <Form/> {/* Componente de formulário para aprender sobre eventos, estados e props */}
      <LogginButton loggedIn={true} /> {/* Componente de botão de login para aprender sobre renderização condicional usando operador ternário e props */}
      <ErrorMessage error={true}/> {/* Componente de mensagem de erro para aprender sobre renderização condicional usando render nulo */}
      <MapInListNumbers numbers={[1,2,3,4,5]}/> {/* Componente de mapeamento de números para aprender sobre map e props */}
      <BotaoEstilizadoUm backgroundColor="blue" color="white"/> {/* Componente de botão estilizado para aprender sobre CSS/Inline Styles usando props de estilo */}
      
      {/* Estudos com HOOKS */}

      {/* useState com useEffect */}
      <ComponentWithUseEffect /> {/* Componente para aprender sobre o hook useEffect */}
      <Timer /> {/* Componente para aprender sobre o hook useEffect e limpeza de estado */}
    
      {/* useContext */}
      <MyContextProvider>

        <ComponenteFilho/>
        <ValueContext/>

      </MyContextProvider>

      {/* useReduce */}
      <Contador/>

      {/* Custom Hooks*/}
      <ComponenteUseHookCustom/>

      <UsingChildren/>

      {/* Sincronização com Props */}

      {/* <PerfilUser 
        userId={1} 
      /> */}

      <HeavyCalculation nm={6}/>
      
      <ContadorCallback/>

    </React.StrictMode> 
  </>
);

// If you want to start measuring performance in your app, pass a function
// to log results (for example: reportWebVitals(console.log))
// or send to an analytics endpoint. Learn more: https://bit.ly/CRA-vitals
reportWebVitals();
