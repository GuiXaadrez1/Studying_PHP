# INTRODUÇÃO

Esse documento tem como principal objetivo explicar breviamente o que é um CGI
para mais informações segue o link: https://github.com/GuiXaadrez1/Studying_ProgWeb/blob/main/Anota%C3%A7%C3%B5es/Conceitos_ProgWeb%2BContexto_Hist%C3%B3rico.pdf


## O QUE É UM CGI?

CGI (Common Gateway Interface) é um padrão/protocolo que define como o servidor web se comunica com programas externos (scripts) para gerar conteúdo dinâmico.

📡 Interface: O CGI é um contrato — o servidor web (Apache, NGINX) inicia um processo externo (ex: um script PHP, Python, Perl) sempre que recebe uma requisição.

🔄 Como funciona: Cada requisição → novo processo → processa a entrada → gera saída (HTML, JSON, etc) → devolve ao servidor → servidor responde ao navegador.

⚙️ Uso clássico: Antes de mod_php e FastCGI, scripts dinâmicos eram quase sempre rodados via CGI puro.

⚠️ Problema: Criar um novo processo para cada request é pesado e ineficiente.

resumo: CGI é o padrão que permite rodar programas externos no servidor web para gerar páginas dinâmicas.


## O Xampp é um CGI?


Ao utilizar var_dump($_SERVER) obtemos a seguinte informação -> ["GATEWAY_INTERFACE"] => "CGI/1.1"

### 📌 1️⃣ O que significa ["GATEWAY_INTERFACE"] => "CGI/1.1"?
E
ssa variável $_SERVER["GATEWAY_INTERFACE"] informa qual interface de comunicação entre o servidor web 
(por exemplo, Apache) e o interpretador (neste caso, o PHP) está sendo usada.

O valor CGI/1.1 indica que o servidor APRESENTA a execução do PHP como se fosse via CGI, mesmo que na prática, 
na maioria dos casos atuais, ele não rode o PHP como um CGI tradicional.

### 📌 2️⃣ Mas o XAMPP é um CGI?

Não.

👉 O XAMPP é um pacote de desenvolvimento que reúne Apache (servidor web), MariaDB/MySQL (banco de dados), PHP (interpretador) e Perl.
👉 O Apache, por sua vez, pode rodar o PHP de três formas principais:

CGI puro — O Apache executa o interpretador php-cgi como um programa externo a cada requisição.

mod_php — O interpretador PHP é embutido como um módulo no Apache (mod_php), então não há novo processo CGI a cada request.

FastCGI — Uma evolução do CGI: mantém processos do interpretador vivos para não precisar iniciar um novo a cada requisição, melhorando a performance.

No XAMPP, o padrão é usar mod_php, que NÃO é CGI puro, mas por padrão a variável GATEWAY_INTERFACE ainda reporta "CGI/1.1" 
por retrocompatibilidade — é só um valor histórico que indica o protocolo de interface web que está sendo seguido, não o modo de execução real.

### 📌 3️⃣ Por que isso importa?

🔍 Se você realmente rodar PHP como CGI puro, cada request cria um novo processo do PHP — isso é pesado, pouco escalável.
🔍 Usar mod_php ou FastCGI é muito mais performático, pois mantém o interpretador carregado na memória.

### 📌 4️⃣ Como verificar o modo real?

✅ Verifique seu phpinfo():

Procure por Server API

Apache 2.0 Handler → Você está usando mod_php.

CGI/FastCGI → Você está usando CGI ou FastCGI de fato.

### ✔️ Resumo prático

XAMPP não é CGI — Ele usa Apache, que por padrão roda mod_php.

["GATEWAY_INTERFACE"] mostra "CGI/1.1" apenas para indicar o protocolo, não o método real de execução.

O que realmente define se é CGI puro ou não é o handler do PHP dentro do Apache.