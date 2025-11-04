// Aqui é o componente principal que será renderizado pelo nosso typescript
// App.tsx: é o componente raiz da aplicação
// Contém a interface inicial da sua aplicação (o que será exibido).

import React from 'react';
import { JSX } from "react";

import logo from './logo.svg';

import './style.css';

// criando um componete que será renderizado pela página indez.tsx
export default function Home():JSX.Element{

  return (
    <>
        {/*className é o class que usamos no css para definirmos class em um html*/}
      <div className = 'container' >
            <form>
                <h3>Cadastro de usuário</h3>
                <input name ='nome' type ='text'></input>
                <input name ='idade' type ='number'></input>
                <input name ='email' type ='email'></input>
                <button type = 'button'>Cadastrar</button>
            </form>
      </div>
      <div>
            <div className = "cardsList">
        
            </div>
      </div>
    </>
  );
}