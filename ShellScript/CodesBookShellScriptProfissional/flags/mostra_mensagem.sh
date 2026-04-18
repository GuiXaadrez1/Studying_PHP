#!/bin/bash
#
# Aqui vamos trabalhar com flags(chaves), geralmente usamos para configurações, opções
# Elas ficam no topo do programa e são usadas para configurar o comportamento do script.
# E ditam como o script deve se comportar, como ele deve processar os dados
# ou quais funcionalidades devem ser ativadas ou desativadas. 
#
#
# Use 0 (zero) para desligar as opções e 1 (um) para ligá-las.
# O padrão é 0, ou seja, as opções estão desligadas por padrão.
#
# Iníco de configurações
USAR_CORES=1
CENTRALIZAR=0
SOAR_BIPE=0
CONFIRMAR=0
# Fim da configuração - Não edite daqui para baixo!

if test "$TERM" = "vt100" then
    USAR_CORES=0
fi

if test $USAR_CORES -eq 1 then
    msg_colorida $mensagem #chama a função "msg_colorida"
else 
    echo $mensagem
fi

# Provavelmente esse código não vai funcionar, mas o objetivo é mostrar como as flags podem 
# ser usadas para controlar o comportamento do script.