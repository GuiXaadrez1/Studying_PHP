// importando a biblioteca react
import React from 'react';

// importando a class JSX da biblioteca react
import { JSX } from "react";

// importando o hook natico useState, ele basicmaente cria um array com dois valores
// primeiro index valor é o antigo e o segundo é o novo
import {useState} from "react";

import logo from './logo.svg';
import './App.css';

function AppOriginVersion():JSX.Element{


  // fazendo uma desconstrução de array
  // basicamente podemos acessar variáveis de um array setando variáveis ela
  // com nomes aleatórios.
  const [contador, setContador] = useState(0);
  
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

export default AppOriginVersion;
