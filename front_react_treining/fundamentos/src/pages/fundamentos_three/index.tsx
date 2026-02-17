/*
    Aqui iremos trabalhar com hooks nativos do React. 
    Ou também como chamamos: eventos! 

    Eventos -> São ações que ocorrem em resposta a interações do usuário
    ou mudanças no estado do componente.
    
    Exemplo de eventos: onClick, onChange, onSubmit, onMouseOver, etc.
*/

/*
    Lembrando também que retornamos JSX, ou seja, HTML dentro do JavaScript
    Logo podemos aplicar o mesmo conceito de estilização de Css nos containers 
    do JSX.ELement que é o Html.

    importando o style.css para estilizar o componente botão
*/

import './style.css'

/*
    Hook de variável de estado do React com ele podemos ter mais dinâmismo 
    nas páginas sem a necessidade de recarregar a página para atualizar o 
    conteúdo ou seja, aramazenamos um valor em uma variável e quando esse 
    valor for atualizado, o componente é re-renderizado. Lembrando! Apenas 
    esse componente! Por conta do DOM virtual do React que só atualiza o que 
    é necessário,
*/
import { useState } from 'react';


// Criando um componente botão para exemplificar o uso de eventos no React
const Button = () => {

    // definindo a variável de estado count e a função setCount para atualizar o valor de count
    const [count, setCount] = useState(0);

    /*
        handleClick é a função que será chamada quando o botão for clicado

        handle -> Siginifica manipulador,
        Clcik -> Significa clique

        handleClick é o manipulador de clique do botão
    */
    
    const handlePlusClick = () => {
        setCount(count + 1);
    }  

    const handleMinusClick = () => {
        setCount(count - 1);
    }   
    
    return (
        <>  
            {/*className é o class que usamos no css para definirmos class em um html -> JSX*/} 

            <button className="btn" onClick={handlePlusClick}>
                { /* 
                    Lembrando que usamos JavaScript Expression dentro de JSX
                    para aplicar lógica de programação, como por exemplo, 
                    a função handleClick que é chamada quando o botão é clicado.
                */ }
               Contar Clicks
            </button>

            <button className="btn" onClick={handleMinusClick}>
                { /* 
                    Lembrando que usamos JavaScript Expression dentro de JSX
                    para aplicar lógica de programação, como por exemplo, 
                    a função handleClick que é chamada quando o botão é clicado.
                */ }
               Diminuir Clicks
            </button>

            <div>
                {/* A contagem vai zerar apenas quando renderizar novamente a página */}
                <p>Contagem de Clicks: {count}</p>
            </div>

        </>
    );

}


export default Button;