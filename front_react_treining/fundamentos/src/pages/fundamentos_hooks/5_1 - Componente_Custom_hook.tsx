
// Importando o custom hook para aplicarmos e vermos ele funcionando
import useWindowSize from './5-Custo_Hook';

import {JSX} from '@emotion/react/jsx-dev-runtime';

const ComponenteUseHookCustom:React.FC = ():JSX.Element => {
    
    // aplicando destruturação de objetos afim de obter os atributos
    // e aplicando o valor deles diretamente em uma variável
    // funciona para arrays também..
    const{width,height} = useWindowSize();

    return (
        <>
            <div>
                <p>
                    Altura da Janela: {width}
                </p>
                <p>
                    Largura da janela: {height}
                </p>
            </div>
        </>
    )
}


export default ComponenteUseHookCustom;