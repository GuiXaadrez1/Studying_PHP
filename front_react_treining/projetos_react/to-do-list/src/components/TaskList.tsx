import React from 'react';

import {ReactElement} from 'react';
import Task from './Task';



// definido a estruta do objeto tasks 
interface TaskObject { 
    id: number; 
    text: string; 
    done: boolean; 
};

interface TaskListProps { 
    // tasks sao uma lista de objetos task
    tasks: TaskObject[]; 
    // definindo estrutura da funcao dentro do nosso objeto... Lembre-se da interface do Laravel
    onRemove: (id: number) => void; 
    onToggle: (id: number) => void; 
}

const TaskList:React.FC<TaskListProps> = ({ tasks, onRemove, onToggle }): ReactElement => {
    return(
        <>
            <ul> {
                tasks.map(
                    (task) => ( 
                        <Task key={task.id} 
                            task={task} onRemove={onRemove} 
                            onToggle={onToggle} /> 
                        )
                    )
                } 
            </ul>
        </>
    )
};

export default TaskList;