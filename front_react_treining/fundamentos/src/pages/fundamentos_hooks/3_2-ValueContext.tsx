import {useContext}  from 'react';
import { MyContext } from './3-useContext';

const ValueContext = () => {

    const { mensagem, setMensagem } = useContext(MyContext);

    return (
        <>  
            {/* Aplicando um Template String, é uma espécie de format do python no typescript */}
            <div>
                Valor Contexto é: " {`${mensagem}`} "
            </div>
            <div>
                Esse valor de cotexto esta dentro de uma useState
            </div>
        </>
    );
}

export default ValueContext;