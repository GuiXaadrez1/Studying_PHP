// Aqui vamos entender sobre o Render Nulo

import { JSX } from "@emotion/react/jsx-runtime";

// Render Nulo é uma técnica em React onde um 
// componente retorna null em vez de JSX. Isso significa que o componente 
// não renderiza nada no DOM. É útil para casos onde você deseja 
// condicionalmente ocultar um componente ou quando um componente não tem 
// nada a exibir.

// Por exemplo, se você tem um componente de mensagem de erro que só deve ser
//  exibido quando há um erro, você pode usar render nulo para ocultar o 
// componente quando não há erro:

// LEMBRANDO que a variável dentro da function callback => é um objeto ao qual chamamos de props
// quando usamos desestruturalção de objetos em props, estamos pegando a 
// propriedade
//  error do objeto props e atribuindo-a à variável error, 
// para que possamos usá-la diretamente dentro do componente sem precisar 
// acessar props.error toda vez que quisermos usar o valor da mensagem de erro. 

// aqui etamos usando TypeScript para definir o tipo do componente e das props,
// React.FC é um tipo genérico para componentes funcionais em React, e 
// { error: boolean | null } define o tipo das props que o componente espera receber, 
// indicando que a prop error pode ser um booleano ou null. O retorno do componente é JSX.Element ou null, 
// o que significa que ele pode retornar um elemento JSX para renderizar ou null para não renderizar nada.
const ErrorMessage:React.FC<{ error: boolean | null }> = ({ error }):JSX.Element|null => {
    
    // se for um destes erros... Não renderizar nada
    if ( error === null || error === undefined || error === false) {
        return null; // Não renderiza nada se não houver erro
    }
    
    // retorna um componente de mensagem de erro se houver um erro
    return <span>Erro ocorrido!</span>; // Renderiza a mensagem de erro se houver um erro
}

export default ErrorMessage;