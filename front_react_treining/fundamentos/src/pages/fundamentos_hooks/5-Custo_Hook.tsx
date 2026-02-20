// Aqui vamos aprender criar um hook customizado para realizar
// lógica de programação específica e compartilhar entre componentes.

// Podemos usar hooks nativos do react para implementar na lógica


import {useState,useEffect} from 'react';

// iremos implementar uma hook que monitora o tamanho da tela


export default function useWindowSize(){

    /**
     * Estamos pegando a altura e largura da tela propriamente do DOM (REAL)
     */
    const [windowSize,setWindowSize] = useState({
        width: window.innerWidth,
        height: window.innerHeight        
    });

    // vai monitorar o tempo o tamanho da tela
    // lembrando que este hook aplica efeito colateral no componente
    useEffect(()=>{
 
        // Funcao que altera valores 
        function handleResize(){
            setWindowSize(
                // atualizando os atributos dos obetos
                {
                    width: window.innerWidth,
                    height: window.innerHeight
                }
            )
        }
    
        // Evento que dispara a função
        window.addEventListener("resize",handleResize)
        
        handleResize()

        // Limpeza de memória (necessário para não estourar a memória do usuário)
        return () => window.removeEventListener("resize",handleResize)

    },[]); // quando o array esta vazio, dispara apenas uma vez

    // retornado o tamanho da janela atualmente...
    return windowSize;
}