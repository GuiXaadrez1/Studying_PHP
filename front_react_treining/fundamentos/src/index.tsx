// Importando a biblioteca react
import React from 'react';
import ReactDOM from 'react-dom/client';

// importando arquivos estáticos ou de estilização
import './logo.svg'

// importando o arquivo index.css referente a nossa main.tsx/index.tsx
import './index.css'

// importando o componete padrão criado pelo react mas que foi personalizado neste projeto
//import App from './App';

// importando página personalizada da módulo home
import Home from './pages/home/index';

// não sei o que é 
import reportWebVitals from './reportWebVitals';

// root variável que cria um DOM virtual ao qual contém nossa página principal para ser 
// renderizada, essa variável comporta um objeto ReactDOM
const root = ReactDOM.createRoot(
  document.getElementById('root') as HTMLElement
);

root.render(
  <React.StrictMode>
    {/*   comentando componete <App/> */} 
    <Home/>
  </React.StrictMode>
);

// If you want to start measuring performance in your app, pass a function
// to log results (for example: reportWebVitals(console.log))
// or send to an analytics endpoint. Learn more: https://bit.ly/CRA-vitals
reportWebVitals();
