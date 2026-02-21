// Vamos aprender sobre o useMemo 

// useMemo é um hook que armazena valores de uma variável na cache do navegador
// com isso , podemos reutilizar o valor desta variavel que esta fixo em diversos
//  lugares do nosso código. useCalback é similar, mas para resultados de funcoes

// useMemo é ideal para realizar lógicas que são realizadas apenas uma vez para
//  serem  reutilizadas no resto do código e em outros componentes
// o valor só é recalculado, modificado  se alguma depedência for atualizada
// ou alterada

import {
    useState,
    useMemo, // armazena valor de uma variável na cache de uma vez para sempre
    ReactElement
} from 'react';

// usamos a interface com REACT.FC para props 
// para garantir que as props tenham o formato esperado
// de objetos em props
interface NumberProp{
    nm?:number;
}

const HeavyCalculation:React.FC<NumberProp> = ({nm}):ReactElement => {

    const heavyOperation = (num:number = 2):number|string => {
        
        const operation = num * 10000000000;
        
        // Formata com separador de milhar usando ponto 
        const formatted = operation.toLocaleString("pt-BR");

        return formatted; 
    }
    
    // o resultHeavyCalculation deixou se ser uma funcao
    // passou a se tornar uma variável com o valor armazenado em cache
    // do nosso navegador 
    const resultHeavyCalculation = useMemo(() => { 
        // O ?? que você viu é o operador de coalescência nula
        // funciona igual ao php, se nm é null o injeta um resultado padrao       
        return heavyOperation(nm ?? 2); 
    }, [nm]); // dependências

    return (
        <>  
            <p>
                Calculo: { resultHeavyCalculation}
            </p>
        </>
    );
}


export default HeavyCalculation;