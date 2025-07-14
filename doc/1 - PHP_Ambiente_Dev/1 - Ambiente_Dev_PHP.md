# Introdução

    Este arquivo.md tem como objetivo criar uma documentação para o ambiente de desenvolvimento do dev PHP fullstack

## Intalação e configuração do PHP nos diversos sistemas operacionais:

recomendo que veja os seguintes materiais:

0 - docuemntação de apoio para a instalação e configuração do PHP: https://www.php.net/manual/pt_BR/introduction.php#intro-whatcando
1 - documentação de apoio para instalação do PHP: https://www.php.net/manual/pt_BR/install.general.php
2 - documentação de apoio para instalação do PHP: https://www.php.net/downloads.php
3 - documentação de apoio  para configuração: https://www.php.net/manual/pt_BR/install.php
4 - vídeo aula ensinado a instalar o xampp: https://youtu.be/8DVk8LeuFpc?si=-usi7o1-MqWwX5Gv
5 - vídeo aula ensinando a fazer configurações opcionais no xampp: https://youtu.be/4n_un0Bqsio?si=Mkju1vWBYpN06E4N
6 - vídeo aula mostrando o arquivo de configuração do php no xampp, o famoso php.ini: https://youtu.be/H9kO0gVSLlo?si=WjVxiT50kaYkoMs3
7 - vídeo aula gringa para usar o VSCODE com PHP 2025: https://youtu.be/RaH75OuHge8?si=R3TJ_kDJBJuouC6F
8 - vídeo aula do guanabara mostrando extensões para o php: https://youtu.be/fsD5NF03MPc?si=nEwEomOhssSF07c4
9 - vídeo aula VSCode + Extensões para o PHP que achei útil: https://youtu.be/h09qpPkb9bI?si=jpYieGRnPqJ4VXFj

Observações: o material/recurso de sétima posição é um vídeo gringo que ensina a montar um ambiente de desenvolvimento com PHP no VSCode sem precisar do Xampp

## Pré-requisistos:

    - Ler as documentações descritas acima para ter uma noção do que você quer fazer
    - Possuir um conhecimento básico em html, css, javascript, typescript(adicional)
    - Xampp instalado e configurado ( suporte a recursos como: mysql, phpadmin, php embutido) # é o que literalmente vamos usar
    - VSCODE instalado (pode usar extensões a gosto! Porém o principal é o: Live Server  )

    Observações: Use as versões mais recente do xampp para o seu sistema operacional
    Observações: NÃO DEIXE DE VER AS VÍDEOS AULAS SOBRE COMO FAZER CONFIGURAÇÕES ADICIONAIS NO XAMPP
    Observações: NÃO DEIXE DE VER AS VÍDEOS AULAS SOBRE O ARQUIVO DE CONFIGURAÇÃO DO PHP, php.ini É IMPORTANTE SABER MEXER 

##  Exemplos Instalação do PHP por Sistema Operacional

A documentação oficial cobre bem os detalhes, mas aqui está um resumo prático por OS:

Windows:

    Baixe o XAMPP — que já traz Apache, MySQL, PHP, phpMyAdmin prontos.

Instale e teste com http://localhost no navegador.

Teste o php no terminal:

    php -v

    Se não reconhecer, adicione o php.exe do XAMPP no PATH do Windows.

Linux (Debian/Ubuntu):

    sudo apt update
    sudo apt install apache2 php libapache2-mod-php php-mysql
    php -v

Teste o Apache:

    sudo systemctl status apache2

MacOS

Use o Homebrew:

    brew install php
    php -v

Para gerenciar múltiplas versões, use o brew link.


### Banco de Dados (MySQL)

O XAMPP já vem com o MySQL. Basta iniciar o serviço pelo Painel de Controle.

Acesse http://localhost/phpmyadmin para gerenciar bancos e usuários.

## Teste Rápido do PHP

    Crie um arquivo info.php dentro do diretório público (htdocs no XAMPP ou /var/www/html no Linux):

        <?php
        phpinfo();
        ?>

    Acesse http://localhost/info.php e verifique as informações da instalação.


