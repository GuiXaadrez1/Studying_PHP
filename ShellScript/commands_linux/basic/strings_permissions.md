## Personalizei o arquivo criado pelo código SecondCode.bash

```bash
# Parte personalizada
ls -l

total 25
drwxr-xr-x 1 GuiGui 197121    0 Apr  3 20:05 .
drwxr-xr-x 1 GuiGui 197121    0 Apr  3 18:36 ..
-rwxr-xr-x 1 GuiGui 197121 1492 Apr  3 19:53 FirstCode.bash
-rw-r--r-- 1 GuiGui 197121    0 Apr  3 18:31 FourthCode.bash
-rwxr-xr-x 1 GuiGui 197121  751 Apr  3 20:02 SecondCode.bash
-rw-r--r-- 1 GuiGui 197121  950 Apr  3 20:05 strings_permissions.md
-rw-r--r-- 1 GuiGui 197121    0 Apr  3 20:06 strings_permissions.txt
-rw-r--r-- 1 GuiGui 197121   33 Apr  3 20:05 teste.py
-rw-r--r-- 1 GuiGui 197121 1471 Apr  3 18:19 ThirdCode.bash
```

## Vamos entender como funciona as permissoes:

## iniciou-se com:

    - d -> representa um diretório
    - l -> representa um link
    - - (hífen) ->  é um arquivo comum

### Caracteres do conjunto de caracteres (permissoes) e seus significados 

r -> leitura
w -> escrita
x - execucao

## Podemos executar um arquivo usando o seguinte comando..

```bash
./teste.txt # como não tem permissao de execucao nao vai dar certo... Porem se fosse me pytohn sim!

./teste.py # também nao vai funcionar porque nao tem permissao para exeucatar 

./FirstCode.bash # funciona porque tem a permissao de executar
```

## Entendendo os grupos de caracteres

- Primeiro Grupo: permissoes para usuário (quem criou o script);

- Segundo Grupo: permissoes para o grupo de usuarios (compartilhamento de arquivos via rede);

- Terceiro Grupo: permissoes para todos os demais usuario

## Criando um shellscript pelo terminal

ao usar o comando abaixo abrimos o Vim para criar um script Shell Script
```bash
vi nome_do_arquivo_shell_script
```

neste caso vamos abrir o vim que respeita os comandos do UNIX
vai ser necessário ter um conhecimento prévio sobre...
Mas se quiser sair você pode usar as seguintes instrucoes:

Clicar em Esc e digitar: :wq (escreveu e salvou alteracao, insercao...)

## Alterando permissoes

```bash

# permissoes para o usuário
chmod u=rwx test*  # leitura, escrita e execucao para o test* que criamos no vim

# permissoes do grupo de usuarios
chmod g=rw test* # leitura e escrita

# permissoes para outros grupos de usuario
chmod o=r test* # neste caso apenas leitura
````
