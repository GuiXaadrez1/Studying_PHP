#!/bin/bash

# o comando linux set | less (mostra nossas vaiaveis de escopo global no nosso SO)
# o comando env do linux também mostra todas as variáveis de ambiente de escopo global

# fazendo input dinâmico usando read
echo "Escreva a sua idade:"

# comando de leitura + variável que o usuário irá passar como parâmetro
read idade

# definido variável dentro do shell, não precisa informar o typecode da variável
# e também não precisa definir o Dolar/Cifrão como no php... Exemplo:
# Só se define o cifrão se você quiser ler ou obter o valor que está dentro desta variável
saudacao="Seja Bem-Vindo!"

# exibindo na tela os valores da variável
echo "Sua idade é: $idade - $saudacao"

# exportando as variáveis pelo NOME (sem $) para ficarem acessíveis globalmente em sub-shells
export idade
export saudacao

echo "Mostrando que as variáveis foram para o escopo global!"

# Agora vamos usar um sub-shell para printar as informações
# env filtra apenas as variáveis exportadas (escopo global)
# grep filtra apenas as variáveis que nos interessam
info=$(bash -c 'env | grep -E "^idade=|^saudacao="')

# exibindo o resultado capturado pelo sub-shell
echo $info