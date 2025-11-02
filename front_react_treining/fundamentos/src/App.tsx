// Aqui é o componente principal que será renderizado pelo nosso typescript
// App.tsx: é o componente raiz da aplicação
// Contém a interface inicial da sua aplicação (o que será exibido).

import React from 'react';
import { JSX } from "react";

// importando nossos arquivos estáticos de estilização, imagens
import logo from './logo.svg';
import './App.css';

// Importando hooks do React conhecido como usaState
// ele serve para criar variáveil de estado para o componente
// e ele retorna um array com exatamente dois elementos, o antigo e o novo
import {useState} from 'react';

// criando um componente com função, antigamente era criado com classes
// esse componente vai retornar um JSX, do nosso DOM (DOCUMENTE OBJECT MANIPULATION) virtual
function App():JSX.Element{

  // defindo  definindo variável no escopo da função para realizar
  // iterações, eventos, capturasa de enventos dentro do nosso JSX  


  // realizando Desestruturação de Array
  // é um recurso do JavaScript que permite que você extraia valores de um array e os
  //  atribua a variáveis com nomes específicos de forma concisa

  const [contador, setContador] = useState(0);
  
  // JSX.Element -> serve para colocarmos o html dentor do TypeScript
  return (
    <>
      <div className="App">
        <header className="App-header">
          <img src={logo} className="App-logo" alt="logo" />
          <p>
            Edit <code>src/App.tsx</code> and save to reload.
          </p>
          <p>
            Componente principal renderizado no arquivo.html no diretório public conhecido como root
          </p>
          <button onClick = {() => setContador(contador + 1)}>
            Count {contador} 
          </ button>
          <a
            className="App-link"
            href="https://reactjs.org"
            target="_blank"
            rel="noopener noreferrer"
          >
            Learn React
          </a>
        </header>
      </div>
    </>
  );
}

export default App;
