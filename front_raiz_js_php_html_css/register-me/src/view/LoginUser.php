<?php

    # declarando tipagem explícita!
    declare(strict_types=1);
    
    # definindo o nome do nosso pacote! Como é uma view
    # é mais interessante usar require_onde 
    namespace View;

    require_once "./includes/head.php";
?>  
    <!--- Container que define o corpo da página! É aqui onde a mágica acontece--->
    <body>
        <div>
            <?php         
                for($i=0;$i<101;$i++){
                    echo"<p>Resultado da contagem: ". (string) $i ."</p>";
                }
            ?>
        </div>
    </body>

<!-- Fim do documento HTML -->
</html>






