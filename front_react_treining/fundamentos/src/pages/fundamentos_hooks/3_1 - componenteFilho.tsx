import {useContext}  from 'react';
import { MyContext } from './3-useContext';

const ComponenteFilho = () => {

    const { mensagem, setMensagem } = useContext(MyContext);

    return (
        <>
            <div>
                Componente Filho dentro do Provider Context, pode tanto obter o valor que esta dentro da variável de contexto do useContext como também pode atualizar a mesma...
            </div>
            <div>
                <button type = "submit" onClick={ () => setMensagem("Nova Mensagem de na variável de Contexto")}>
                    Alterar contexto! 
                </button>
            </div>
        </>
    );
}

export default ComponenteFilho;