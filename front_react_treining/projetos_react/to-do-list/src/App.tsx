import React from 'react';
import {ReactElement} from 'react';

import {
  useState,
  useEffect
} from 'react';

// import logo from './logo.svg';

import TaskInput from './components/TaskInput';
import TaskList from './components/TaskList';
//import Task from './components/Task';

// importando o nosso estilizador
import './App.css';


// definido o tipo Task
interface taskObject{ 
  id: number; 
  text: string; 
  done: boolean; 
}

const App:React.FC = ():ReactElement => {

  // iniciando a criacao para a lógica das funcionalidades do nosso projeto

  // definifo estados das tarefas dos nossos componentes
  const [tasks, setTasks] = useState<taskObject[]>([]);

  const addTask = (task:string) => {
    
    // id,title,done
    setTasks([ ...tasks, { id: Date.now(), text: task, done: false } ]);
  }

  const removeTask = (id: number) => { 
    setTasks(
      tasks.filter(
        (t) => t.id !== id
      )
    ); 
  };

  const toggleTask = (id: number) => { 
    setTasks( 
      tasks.map(
        (t) => t.id === id ? { ...t, done: !t.done } : t 
      ) 
    ); 
  };
  
  return(
    <>
      <h1>Lista de tarefas!</h1>
       <TaskInput onAddTask={addTask} />
      <TaskList tasks={tasks} onRemove={removeTask} onToggle={toggleTask} />
    </>
  );   
}

export default App;
