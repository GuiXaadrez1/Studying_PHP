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
      {/*   comentando componete <App/> */} 
      {/*<Home/>*/}
      <ComponenteDois/> {/* Componente para aprender sobre componentes pais e filhos e herança de dados por meio de props*/}
      <Botton/> {/* Componente de botão para aprender sobre eventos, estados e props */}
      <Form/> {/* Componente de formulário para aprender sobre eventos, estados e props */}
      <LogginButton loggedIn={true} /> {/* Componente de botão de login para aprender sobre renderização condicional usando operador ternário e props */}
      <ErrorMessage error={true}/> {/* Componente de mensagem de erro para aprender sobre renderização condicional usando render nulo */}
      <MapInListNumbers numbers={[1,2,3,4,5]}/> {/* Componente de mapeamento de números para aprender sobre map e props */}
    </React.StrictMode> 
  </>
);

// If you want to start measuring performance in your app, pass a function
// to log results (for example: reportWebVitals(console.log))
// or send to an analytics endpoint. Learn more: https://bit.ly/CRA-vitals
reportWebVitals();
