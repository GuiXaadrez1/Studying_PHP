// Usamos muito o useEffect para lidar com limpeza de estado... 

import {useState,useEffect} from 'react';
import {JSX} from '@emotion/react/jsx-dev-runtime';

const Timer = ():JSX.Element => {
    
    const [segundos, setSegundos] = useState(0);

    useEffect(() => {        
        
        // setInterval é uma função do JavaScript que executa uma função ou
        //  um trecho de código repetidamente, com um intervalo de tempo fixo
        //  entre cada execução. Ele recebe dois argumentos: a função a ser 
        // executada e o intervalo de tempo em milissegundos.
        const intervalId = setInterval(
            () => {
                // atualizando o tempo em segundos a cada segundo e incrementando o valor de segundos em 1 
                setSegundos(prevSegundos => prevSegundos + 1);
        }, 1000); // para a contagem a cada 1mil segundos);
        
       // limpeza dos dados 
       return () => clearInterval(intervalId); 
    }, []); // array de depedências, se for vazio, ou seja, o useEffect só será executado uma vez, quando o componente for montado. Se não passarmos esse array, o useEffect será executado toda vez que o componente for renderizado, o que pode causar problemas de desempenho.

    return (
        <div>
            <p>Tempo: {segundos} em segundos</p>
        </div>
    );
};

export default Timer;