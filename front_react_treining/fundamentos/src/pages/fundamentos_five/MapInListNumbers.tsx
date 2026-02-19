import { JSX } from "@emotion/react/jsx-runtime";
import useState from "react";

// indicando que o props do nosso componete funcional precisa ser do tipo ListNumbersProps, que é uma interface que define a estrutura do objeto props,
interface ListNumbersProps {
    numbers:number[];
}


const MapInListNumbers:React.FC<ListNumbersProps> = ({ numbers }):JSX.Element => {
    
    return (
        <>
            {/* Atençaõ ao JavaScript Expression */}

            {/* 

                Aqui estamos realizando um map paracada numero percorrido
                Dentro da nossa props... que é um array de números, 
                e renderizando cada número em um elemento li, ou seja...
                Esse map vai retornar uma parte do nosso JSX, que é o 
                elemento li, para cada número do array.

                Lembre que map trabalha com chave-key, então precisamos passar
                uma key única para cada elemento li,
             
            */}
            
            <ul style={
                { 
                    // ESTA PARTE DO STYLE PRECISAMOS DE ATENÇÃO... 
                    // Aqui estamos defindo props específicas para os
                    //  componentes JSX que funciona como se fossem
                    // atributos HTML, mas que na verdade são propriedades do componente JSX,
                    // Aqui estamos programando CSS inline para o elemento ul, e 
                    // para isso usamos a sintaxe de objeto JavaScript, onde cada 
                    // propriedade CSS é definida como uma chave do objeto, e seu 
                    // valor é a string correspondente ao valor CSS. Por exemplo, 
                    // listStyle é a propriedade CSS para definir o estilo da lista,
                    //  display é a propriedade CSS para definir o tipo de exibição do
                    //  elemento, flexDirection é a propriedade CSS para definir a 
                    // direção dos itens em um contêiner flexível, gap é a propriedade
                    //  CSS para definir o espaçamento entre os itens em um contêiner
                    //  flexível, e marginLeft é a propriedade CSS para definir a
                    //  margem esquerda do elemento.

                    listStyle: 'none', // remove os marcadores da lista
                    display: 'flex', // tipo de exibição dos itens da lista
                    flexDirection: 'column', // direção dos itens em uma coluna, ou seja, um embaixo do outro
                    justifyContent: 'start', // alinha os itens ao início do contêiner
                    alignItems: 'start', // alinha os itens ao início do contêiner
                    gap: '1px' , // espaçamento entre os itens da lista
                    // marginLeft: 1, // margem esquerda do elemento ul, para afastar a lista da borda da tela
                    // left: 10 // posição do elemento ul, para garantir que ele fique alinhado à esquerda da tela
                }
            }> {
                // Aqui esta o nosso JavaScript Expression! 

                numbers.map((item:number,index:number):JSX.Element=>{
                    return(
                        <li key={index}> O número é: {item * 10}</li>
                    );
                })
            }</ul>
        
        </>
    );
}


export default MapInListNumbers;