<DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8"> <!-- Define a codificação de caracteres para dar suporte ao pt-br -->
        <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- Deixa responsivo em mobile -->
        <meta http-equiv="X-UA-Compatible" content="IE=edge"> <!-- Força compatibilidade Edge no IE -->
        <title> Aprendendo Include e Require</title>
    </head>
    <body>
        <!-- Para chamar uma função, não esquecer de chamar ela -->
        <?php 
            include_once 'funcoes.php'; 
            echo saudacao(); 
        ?>
        <a href="http://localhost/Studying_PHP/codes/version_php.php">Clique aqui para obter informações do php embutido no xampp</a>
        <?php
            include_once 'funcoes.php';
            include 'config.php';
            require 'first.php';
            echo("<p> acima está  o nosso include! </p>");
            echo("<p> abaixo temos a mesma explicação do arquivo acima: </p>");  
            echo("<p>Se colocarmos um nome ou um arquivo.php que não existe no include, o servidor lança um warning e continua o script </p>");
            echo("<p>Caso o sesrvidor não encontro o arquivo no include, ele vai lançar esse tipo de aviso:</p>
                <ul>
                    <li> Warning: include(cofig.php): Failed to open stream: No such file or directory in C:\xampp\htdocs\Studying_PHP\codes\Include_vs_Require.php on line 12 </li>
                    <li> Warning: include(): Failed opening 'cofig.php' for inclusion (include_path='C:\xampp\php\PEAR') in C:\xampp\htdocs\Studying_PHP\codes\Include_vs_Require.php on line 12  </li>
                </ul>
            ");
        
            echo calc_velocidade_luz( 299792.488 , 1.000293);
        ?>
        <p>SÓ PARA DEIXAR CLARO!!! PODEMOS MISTURAR  SCRIPTS PHP COM HTML E VISE-VERSA</p>
        <p>SCRIPTS PHP TEM SUPORTE PARA ISSO.</p>
        <p>A DIFERENÇA DO REQUIRE PARA O INCLUDE É: </p>
        <?php
            echo("
                <ul>
                    <li>Quando o servidor não consegue achar o arquivo no require, basicemnte ele lança um erro fatal que mata a execução do script PHP </li>
                </ul>
                <p>EXEMPLO: </p>
                <ul>
                    <li>
                        Fatal error: Uncaught Error: Failed opening required 'fist.php' (include_path='C:\xampp\php\PEAR') in C:\xampp\htdocs\Studying_PHP\codes\Include_vs_Require.php:13 Stack trace: #0 {main} thrown in C:\xampp\htdocs\Studying_PHP\codes\Include_vs_Require.php on line 13
                    </li>
                </ul>    
            ");
        ?>
        <p>QUANDO OU NÃO DEVO USAR INCLUDE E REQUIRE: </p>
        <table border = 1> <!--É o container principal que define que o conteúdo dentro será organizado em linhas e colunas. Delimita todo o bloco de dados tabulares. -->
            <thead> <!-- Cabeçalho da Tabela. Agrupa linhas de cabeçalho (normalmente <th>). Usado para identificar títulos das colunas. Facilita estilização e acessibilidade. -->
                <tr> <!-- Table Row (linha da tabela). Cada <tr> representa uma linha inteira. Agrupa células em linha única — pode conter <td> ou <th>. -->
                    <th>Include</th> <!-- Table Header Cell (célula de cabeçalho). É uma célula de título. O conteúdo é exibido em negrito e centralizado por padrão. Usado dentro de <tr>. -->
                    <th>Exemplos</th>
                    <th>Require</th>
                    <th>Exemplos</th>
                </tr>
            </thead>
            <tbody> <!-- Corpo da Tabela. Contém as linhas de dados reais (<tr> com <td>). -->
                <tr>
                    <td>Arquivos.php Opcionais, como se fossem um extra!</td> <!-- Table Data Cell (célula de dados). É a célula normal de conteúdo, neste caso ela se refere a segunda coluna --> 
                    <td>Arquivos.php externos mais usados para: cabeçalho, configurações de cabeçalho, footer e etc...  do html ou configurações específicas para a página que não são tão fundamental</td>
                    <td>Arquivos.php externos obrigatórios.</td> <!-- essa é a celula referente a segunda coluna -->
                    <td>Arquivos.php externos que é de configuração, com conexão com o banco de dados, informações essencias para o sistema</td>
                </tr>
                <tr>
                    <td>lança um aviso quando não acha o arquivo </td>
                    <td>head.php, footer.php, body.php e etc... serve também como um extends do JINJA2 DO DJANGO/Flask para Herança de páginas</td>
                    <td>Lança um erro fatal ao não encontrar o arquivo externo </td>
                    <td>infra.php,conexao.php, e etc... </td>
                </tr>
            </tbody>
        </table>
        <p>OBSERVAÇÕES!!!!!!</p>
        <p>Para carregar, instanciar os arquivos externos apenas um vez podemos usar o seguinte</p>
        <ul>
            <li>include_once = carrega, instancia o arquivo apenas uma vez</li>
            <li>require_once = mesmo conceito acima</li>
        </ul>
        <p>Você pode fazer isso por N motivos como: mais de um arquivo com o mesmo nome ou outras ocasiões</p>
    </body>
</html>