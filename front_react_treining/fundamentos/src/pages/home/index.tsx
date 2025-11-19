// Aqui é o componente principal que será renderizado pelo nosso typescript
// App.tsx: é o componente raiz da aplicação
// Contém a interface inicial da sua aplicação (o que será exibido).

import React from 'react';
import { JSX } from "react";

// import logo from '../../assets/logo.svg';

import './style.css';



// Criando uma interface para materializar um objeto Usuário
interface User{
  id:number,
  name:string,
  idade:number,
  email:string,
}

// criando um componete que será renderizado pela página index.tsx
export default function Home():JSX.Element{
  
  // Criando um array de objetos User
  const users: User[] = [
    {
      id: 1,
      name: "Alice Silva",
      idade: 28,
      email: "alice.silva@exemplo.com",
    },
    {
      id: 2,
      name: "Bruno Costa",
      idade: 35,
      email: "bruno.costa@exemplo.com",
    },
    {
      id: 3,
      name: "Carla Souza",
      idade: 22,
      email: "carla.souza@exemplo.com",
    },
  ];

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
        {/* No react podemos usar chaves dentro do JSX ao qual chamaos de {JavaScript Expression}
          Basicamente nos permite realizar lógica de programação javascript ou typescript dentro do
          JSX
        */
        }
        { users.map(user => (
           <div className = "cardsList">
            <p>Nome:</p>
            <p>Idade:</p>
            <p>Email:</p>
            <button type='submit'>Deletar:</button>
          </div>
          ))
        }
      </div>
    </>
  );
}