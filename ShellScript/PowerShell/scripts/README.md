# Introdução

Assim como no Bash, vamos aprender a criar alguns scripts .ps1 e scritps ou programas de extensão .ps1

- Vamos envolver sintaxe e entre outras coisas!

## IDE (editores de texto) para scritps .ps1 

### VScode 

- Para criar scripts.ps1 nas versões modernas do poweshell e é mais indicado...

### PowerShell ISE 

- Já vem isntalado nativamente no poweshell... Não recebe atualizações desde a versão 5.2... 

- Muito bom para scripts rápidos

#### Editores via Terminal.. pode ser o Nano ou Vim... Fica a critério seu!

- Como eu prefiro Vim... Vou usar esse editor de terminal e ensinar como installar no powershell... 

```powershell

choco install vim -y

# Ou via Winget

winget install vim.vim   

```

#### criando e abrindo arquivo.ps1

```powershell
vim nome-do-script.ps1
```

#### Comandos Essenciais de Edição:

- Inserir texto: Pressione i (modo Insert). 
- Salvar: Pressione ESC, digite :w e Enter. 
- Sair: Pressione ESC, digite :q e Enter. 
- Salvar e Sair: Pressione ESC, digite :wq e Enter. 
- Sair sem salvar: Pressione ESC, digite :q! e Enter.

## Tipos de dados 

- Tudo dentro do PowerShell é objeto assim como o python
- Os tipos de dados são baseados na linguagem de programação c# com .NET
