// Vamos aprender mais sobre children
// herança de componentes e props... 

// Dica de ouro, se estivermos componentes que estiverem componentes dentro
// dele, então vamos trabalhar com children! 


// Em React, children é uma prop especial usada quando um componente funciona
//  como container de outros componentes ou elementos.

// lembrando que props são objetos que são passados de componente pai para filho
// {props} -> para acessar o valor => props.dados1 e etc... 
// por isso usamos destruturacao de objetos... {dados1,dados2}


interface CardProps {
  children: React.ReactNode;
};

/*

Porque ReactNode aceita:

- JSX

- string

- number

- arrays

- fragments

- null

- undefined

*/

export function Card({ children }: CardProps) {
  return (
    <div>
      {children}
    </div>
  );
}