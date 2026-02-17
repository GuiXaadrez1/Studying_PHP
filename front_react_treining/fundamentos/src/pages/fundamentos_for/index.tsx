import { JSX, useState } from "react";



// Criando componente de formulário controlado.
const Form:React.FC = ():JSX.Element => {
    
    const [value,setvalue] = useState('');

    /**
     * Aqui é uma função de manipulação de evento para o envio do formulário.
     * Aqui podemos escutar diversos eventos relacionados ao formulário: 
     * como onSubmit, onChange, etc.
     * 
     * Ser para manipulação de dados, validação, envio ao servidor pela API
     * loading, chamada de funcoes de mensagem de sucesso ou erro, etc.
     * 
     * @param e 
     */
    const handleSubmit = (e: React.FormEvent<HTMLFormElement>) => {
        
        // previne o comportamento padrao do formulário, permite termos
        //  mais controle sobre o que acontece quando o formulário é enviado,
        //  como validação de dados ou envio assíncrono para um servidor.
        e.preventDefault(); 

        // exibe um alerta com o valor do input quando o formulário é enviado 
        alert(value); 
    
    };

    const handleInputChange = (e: React.ChangeEvent<HTMLInputElement>) => {
        setvalue(e.target.value);
    };

    // placeholder form 
    const placeholder = 'Digite algo...';

    return (
        <>
            {/*
                Usavamos a variável de formulário action para 
                enviar os dados para um servidor da forma antiga
                com as variáveis super globais dos métodos HTTP GET / POST no PHP
                Esse dados entao eram encapsulados no formado:
                <application/x-www-form-urlencoded> e enviados para o servidor 

                Atualmente com React e outras bibliotecas de front-end,
                o envio de dados para o servidor é feito de forma diferente, 
                utilizando arquitetura API REST que basicamente constrói 
                APIs para serem consumidas pelo Fetch ou Axios para fazer
                requisições HTTP  e sesu mpetodos de forma assíncronas async/wait.
                Essas APIs permitem enviar dados em formatos como JSON, 
                que é mais flexível e fácil de trabalhar do que o formato 
                tradicional de formulário.
            */}

            {/*
            
                OnSubmit é um evento que ocorre quando o formulário é enviado,
                ou seja, quando o usuário clica no botão de envio ou pressiona
                Enter enquanto está focado em um campo de entrada. 
                Ele é usado para capturar o momento em que o formulário é 
                submetido e executar uma função de manipulação de evento 
                associada a esse evento.
            */}
            <form onSubmit={handleSubmit}>
                <input 
                    type="text" // formulário do tipo texto
                    placeholder={placeholder} // placeholder para mostrar uma dica do que deve ser digitado no input
                    value={value}  // valor do input controlado pela variável de estado value
                    onChange={handleInputChange}  // evento onChange para atualizar o valor do input conforme o usuário digita
                /> {/*  e.target.value é uma propriedade que obtem o valor do input */}
            </form>

            <button type="button" onClick={() => alert(value)}>Enviar</button>

            {/*
                Essa parte é curiosa! onClick={()=>alert(value)}
                Por que chamamos uma função anônima para exibir o alerta?
                Sendo que em outros eventos so passamos o nome da função 
                sem os parênteses, como onSubmit={handleSubmit}?

                A razão para isso é que queremos passar o valor atual do input
                para o alerta quando o botão for clicado. Se usássemos 
                onClick={alert(value)}, o alerta seria exibido imediatamente 
                quando o componente fosse renderizado, em vez de esperar pelo 
                clique do botão. Ao usar uma função anônima, garantimos que o 
                alerta só seja exibido quando o botão for clicado, 
                e que ele mostre o valor atualizado do input.
                
                Meio que sem a função anônima, o que vai funcionar não é o react
                mas sim o JavaScript puro, e isso não é o que queremos, ou seja, 
                queremos que o React controle o comportamento do botão, e não o
                JavaScript puro. Quando é JavaScript puro, ele executa a função
                imediatamente, e não quando o evento ocorre. Para obtermos o evento
                novamente é necessário renderizar a página toda com F5 ou Refresh, 
                e isso não é o que queremos, queremos que o React controle o comportamento
                do botão, e não o JavaScript puro. Basicamente estamos Manipulando o DOM Real
                e nao o Virtual ao usar o JavaScript Puro.
            */}
        </>
    )
}

export default Form;