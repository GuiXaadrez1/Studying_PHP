// no react 16 sempre deve-se importar o REACT do 'react' para nao dar b.o
import * as React from 'react';

import {useState} from 'react';

import {ReactElement} from 'react';


interface inputProps{
    /* onAddTask?:any; // colocando any para deixar a chamada de funcao dinâmica! */

    // mlehor tipar a funcao
    onAddTask: (task: string) => void;
}

const TaskInput: React.FC<inputProps> = ({ onAddTask }): ReactElement => {

    const [input, setInput] = useState("")

    const handleSubmit = (e: React.FormEvent<HTMLFormElement>) => { 
        
        // validar se todos os campos do formulário foram enviados...
        e.preventDefault(); 
        
        if (input.trim()) { 
            onAddTask(input); setInput(""); 
        } 
    };

    return(
        <>
            <form
                style={{
                    fontSize:"20px",   // encosta na borda esquerda
                }}
                onSubmit={handleSubmit}
            >
                Input Tarefa:
                <input
                    type="text"
                    value={input}
                    onChange={(e: React.ChangeEvent<HTMLInputElement>)=>setInput(e.target.value)}
                    placeholder="tarefa a ser executada!"
                />
                <button type="submit">Adicionar</button>
            </form>
        </>
    )
};

export default TaskInput;