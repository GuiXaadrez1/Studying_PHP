// Aqui vamos treinar o seguite conceito! 
// Vamos aprender algumas formas de estilização de componentes! 

import { JSX } from "@emotion/react/jsx-dev-runtime";



// 1 - Css/Inline Styles - Basicamente usando css tradicional 
// ou usando o ATRIBUTO Style (que é uma props específica) para estilizar
// componentes de forma inline, ou seja, diretamente no componente usand
// o um objeto JavaScript / JavaScript Expression para definir as propriedades
// de estilo.

// Tamebtém podemos usar o style.css para realizar a estilizacao dos componentes
// neste arquivo.tsx, mas para isso precisamos configurar um modulo no typescript
// para aceitar a leitura deste tipo de arquivo. 
// E aplicar as classes CSS usando a props className, que é uma props 
// específica para aplicar classes CSS em elementos JSX.


// Primeiro definimos uma interface para tipas a nossa props de estilo, 
// que contém as propriedades de backgroundColor e color, ambas do tipo string. 
interface ButtonStyledProps{
    backgroundColor: string;
    color: string;
}

// Lembrando que React.FC é um tipo genérico para componentes funcionais em 
// React, e ButtonStyledProps é o tipo das props que o componente espera 
// receber. O componente BotaoEstilizado recebe as props de estilo e retorna 
// um elemento JSX que representa um botão estilizado com as propriedades 
// de backgroundColor e color aplicadas ao estilo do botão.
const BotaoEstilizadoUm:React.FC<ButtonStyledProps> = (
        { // inicio da desestruturação das props, onde pegamos as propriedades de backgroundColor e color
            backgroundColor, 
            color
          // fim da desestruturação das props, onde pegamos as propriedades de backgroundColor e color 
        }
    ): JSX.Element => {
        
        // Inicio da construcao do nosso componete  
        return (
            <button type="button" style={
                    { // Inicio do objeto de estilo, onde aplicamos as propriedades de backgroundColor e color usando a sintaxe de objeto JavaScript
                        backgroundColor,
                        color 
                     // Fim do objeto de estilo, onde aplicamos as propriedades de backgroundColor e color usando a sintaxe de objeto JavaScript
                    }
                }
            >
                Botão Estilizado
            </button>

            // Fim da construcao do nosso componete
        );
    }

export default BotaoEstilizadoUm;

// 2 - Styled Components - Biblioteca que permite criar componentes React 
// com estilos personalizados usando uma sintaxe de template literals. 
// Ela permite escrever CSS diretamente dentro do JavaScript, associando os 
// estilos aos componentes de forma mais intuitiva e modular. 
// Com styled-components, é possível criar componentes reutilizáveis e 
// facilmente personalizáveis, além de oferecer suporte a temas e outras 
// funcionalidades avançadas de estilização.


// 3 - CSS Modules - Técnica de estilização que permite criar arquivos CSS com escopo local para cada componente. 
// Com CSS Modules, os estilos definidos em um arquivo CSS são automaticamente 
// escopados ao componente que os importa, evitando conflitos de nomes e permitindo uma melhor organização dos estilos. Cada classe CSS é transformada em um nome único, garantindo que os estilos sejam aplicados apenas ao componente específico, mesmo que haja classes com o mesmo nome em outros arquivos CSS. Isso facilita a manutenção e a reutilização de estilos em projetos React.


// 4 - Tailwind CSS - Framework de CSS utilitário que permite criar interfaces de usuário rapidamente usando classes pré-definidas. 
// Com Tailwind CSS, os desenvolvedores podem aplicar estilos diretamente aos elementos HTML usando classes utilitárias, sem a necessidade de escrever CSS personalizado. O Tailwind CSS oferece uma ampla variedade de classes para controle de layout, tipografia, cores, espaçamento e muito mais, permitindo que os desenvolvedores criem designs responsivos e personalizados de forma eficiente. Ele é altamente configurável e pode ser adaptado às necessidades específicas de um projeto, tornando-se uma escolha popular para estilização em projetos React.

// 5 - Material UI - Biblioteca de componentes React que implementa o design system do Material Design, criado pelo Google. 
// O Material UI oferece uma ampla variedade de componentes pré-construídos, como botões, formulários, tabelas e muito mais, que seguem as diretrizes de design do Material Design. Ele também fornece uma personalização fácil, permitindo que os desenvolvedores ajustem os estilos e temas dos componentes para se adequar ao visual desejado. O Material UI é amplamente utilizado em projetos React devido à sua facilidade de uso, consistência visual e suporte a recursos avançados, como responsividade e acessibilidade.

// 6 - Bootstrap - Framework de CSS e JavaScript que oferece uma coleção de componentes pré-construídos e estilos para criar interfaces de usuário responsivas e modernas.

// 7 - Chakra-UI - Biblioteca de componentes React que oferece uma coleção de componentes pré-construídos e estilos para criar interfaces de usuário acessíveis e personalizáveis. O Chakra-UI é projetado para ser fácil de usar e altamente personalizável, permitindo que os desenvolvedores criem designs consistentes e responsivos com facilidade. Ele também oferece suporte a temas, tornando possível adaptar o visual dos componentes às necessidades específicas de um projeto. O Chakra-UI é uma escolha popular para estilização em projetos React devido à sua simplicidade, flexibilidade e foco na acessibilidade.