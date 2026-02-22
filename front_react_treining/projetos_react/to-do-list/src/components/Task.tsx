// no react 16 sempre deve-se importar o REACT do 'react' para nao dar b.o
import * as React from 'react';
import {ReactElement} from 'react';


interface TaskProps { 
    task: { 
        id: number; 
        text: string; 
        done: boolean; 
    }; 
    onRemove: (id: number) => void;
    onToggle: (id: number) => void; 
}

const Task: React.FC<TaskProps> = ({ task, onRemove, onToggle }): ReactElement => {
    return ( 
        <li> 
            <input type="checkbox" checked={task.done} onChange={() => onToggle(task.id)}
            /> 
            <span style={{ textDecoration: task.done ? "line-through" : "none" }}> 
                {task.text} 
            </span> 
            <button type="button" onClick={() => onRemove(task.id)}> 
                Remover 
            </button> 
        </li> 
    ); 
};

export default Task;