### diretório node_modules

Esse diretório contém todos os arquivos importantes das nossas ferramentas para o projeto funcionar corretamente e adequadamente, sempre gerado em tempo de compilação das nossas dependências....

### diretório public

Essa pasta sempre vai ser disponibilizado de forma acessível direto no navegador
este é o diretório principal 

### diretório src

#### sub-diretório assets (react versão mais nova)

Fica todos os nossos nossos arquivos estáticos, imagens, arquivos de mídia, e etc...
nas versões mais novas do react, o react e seus componentes principais fica neste arquivo.

## arquivos no diretório raiz:

#### README.md

Utilizamos para fazer a porta de entrada do projeto, para poder faze documentação do projeto, funcionalidades do projeto, experiências adquiridas e etc...

### arquivo .env

Arquivo para criar variáveis de ambiente do projeto, ou seja, da nossa aplicação, lembre-se que existe duas variáveis de ambiente, o do host ('máquina') e sistema operacional e o de aplicações  como o arquivo .env

### arquivo .gitignore

Serve para aignorar arquivos grandes e pesados que não fazem sentido serem versionados como: node_modules, imagen grandes, vídeos grandes, esses arquivos não podem passar de 100 mb, basicamente serve para não versionarmos ele.

### packge.json

Arquivo JSON utilizado para versiona as depedências do nosso projeto, seja para produção do produto de software ou para o próprio desenvolvimento do projeto, nele temos todas as informações do projeto, depedências, depedências de desenvolviemnto, scripts no painel de controle que basicamente são controles e etc...

### package-lock,json

Arquivo ao qual está versionado todas as depeência do projeto, pacotes, libs, frameworks e etc...

### tsconfig.json
Serve pra configurarmos o nosso typescript no projeto, sempre recomedno usar as recomendações da microsoft para isso.

### eslint.config.js ou eslint.config.mts (específico para typescript)

O elint é uma biblioteca que tem como principal objetivo cosertar problemas encontrados no código, esse arquivo nos ajuda a configurá-lo específicamente ao nosos projeto, versão do typescript, react e etc...