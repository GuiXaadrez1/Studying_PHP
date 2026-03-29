<?php

    # declarando tipagem explícita!
    declare(strict_types=1);
    
    # definindo o nome do nosso pacote! Como é uma view
    # é mais interessante usar require_onde 
    namespace View;

    // 1. PRIMEIRO: Carrega as configurações (onde está o define)
    require_once __DIR__ . '/../../config/config.php'; // Ajuste o caminho para o seu arquivo de constantes

    // 2. DEPOIS: Carrega o cabeçalho HTML
    require_once __DIR__ . '/includes/head.php';
?>  
    <!--- Container que define o corpo da página! É aqui onde a mágica acontece--->
    <body>

        <div class="container">
            
            <?php         
                /*for($i=0;$i<11;$i++){
                    echo"<p>Resultado da contagem: ". (string) $i ."</p>";
                }*/
            ?> 

            <div class="form-box active" id="loginForm">   
                <form action=""
                    method="post" <?php /* methodo en transporte de dados HTTP */?>
                    enctype="application/x-www-form-urlencoded" <?php /* serializador dos dados para payload */?>
                    autocomplete="on" <?php /* Define o autocomplete do navegador */?>
                    accept-charset="utf-8"
                    name="FormLogin" <?php /* nome para identificarmos com JavaScript */ ?>
                >
                    <h2>Login</h2>
                    
                    <?php 
                        /* 
                            
                            Apropriedade name no input é importante 
                            Porque é ele que define quais dados vão ser serializados
                            para o payload e posteriormente identificados pela chave
                            associativa definia como atributo! Para captarmos com as 
                            variáveis super globais do php ($_GET['email'],$_POST['email'])
                        */
                    ?> 
                    <input 
                        type="email" 
                        name="email" 
                        placeholder="Email" 
                        required
                    >
                    
                    <input type="password" name="password" placeholder="Password" required>
                    
                    <button type="submit" name="btnLogin">Login</button>
                </form>

                <span>Não possui uma conta?
                    <a target="_self" onclick="showForm('registerForm')">Register</a>
                </span>
            
            </div>

            <div class="form-box" id="registerForm">   
                
                <form action=""
                    method="post" <?php /* methodo en transporte de dados HTTP */?>
                    enctype="application/x-www-form-urlencoded" <?php /* serializador dos dados para payload */?>
                    autocomplete="on" <?php /* Define o autocomplete do navegador */?>
                    accept-charset="utf-8"
                    name="FormLogin" <?php /* nome para identificarmos com JavaScript */ ?>
                >
                    <h2>Register</h2>
                    
                    <input type="text" name="name" placeholder="Name" required>

                    <input type="email" name="email" placeholder="Email" required>
                    
                    <input type="password" name="password" placeholder="Password" required>
                    
                    <select name="role" required>
                        <?php
                            
                            // so para dinamizar um pouco
                            
                            for($i;$i<3;$i++){

                                switch($i){
                                    
                                    case 1:
                                        
                                        echo '<option value="user">User</option>';
                                        break;
                                    
                                    case 2: 
                                        
                                        echo '<option value="admin">Admin</option>';
                                        break;

                                    default:
                                        echo '<option value="">---Select Role---</option>'; 
                                        break;      
                                };
                            };
                        ?>
                    </select>

                    <button type="submit" name="btnRegister">Register</button>
                </form>
               
                <span>Já possui um Cadastro?
                    <a target="_self" onclick="showForm('loginForm')">Login</a>
                </span>
            </div>
        </div>
    
        <script text="text/javascript" src="<?= BASE_URL_VIEW ?>js/login.js"></script>
    </body>

<!-- Fim do documento HTML -->
</html>






