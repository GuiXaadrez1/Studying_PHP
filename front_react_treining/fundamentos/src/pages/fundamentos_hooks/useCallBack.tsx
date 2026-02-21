// useCallback -> muito parecido com useMemo.
// maior diferença é que o useCallback armazena funcoes na cache de forma fixa
// desde que suas depedências nao seja atualizadas... 
// useMemo memoriza valores de variáveis...



// React.memo -> não é igual ao useMemo... 
// React.memo -> usamos para memorizar componentes funcionais REACT na cache 
// de forma fixa mudando somente se necessário! 

import React, { 
    useState,
    useCallback,
    ReactElement 
} from "react";



// Defindo propriedades das props do componente embrulhado, empacotado pelo
// método React.memo

interface BotaoProps { 
    onClick: () => void; 
    children: React.ReactNode; // lembre-se... children é um component especial e sempre deve ser tipado com ReactNode
}

// Definido a aramazendo em cache uma componente REACT com REAC.memo
const Botao: React.FC<BotaoProps> = React.memo(({ onClick, children }) => { 
    return <button onClick={onClick}>{children}</button>; 
});

const ContadorCallback = ():ReactElement => {

    const [contador,setContador] = useState(0);

    const incrementar = useCallback(()=>{
        setContador(contador + 1);
    },[contador]); // depedência... lembrando que o componete e o valor da funcao
    // muda assim que as depedencas sao alteradas

    return(
        <>
            <div>
                <p>
                    Contagem do contador Callback:{contador}
                </p>
                <Botao
                    onClick={incrementar}
                >
                    Incrementar
                </Botao>
            </div>
        </>
    );
}

export  default ContadorCallback; 