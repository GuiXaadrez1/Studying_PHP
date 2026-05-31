# Introdução

Este arquivo.md tem como principal objetivo explicar e exibir diretivas php bem como as suas funcionalidades

## O que são as diretivas?

No contexto do PHP, diretiva é um parâmetro de configuração que instrui o motor de execução do PHP (Zend Engine) sobre como se comportar em determinados aspectos.

Definição curta:

    Diretiva é uma configuração que controla o ambiente de execução de scripts PHP.

## Para que serve as diretivas?

Essencialmente, as diretivas permitem personalizar o ambiente de execução PHP sem alterar o código-fonte dos scripts.

### Finalidades práticas:

    Aumentar segurança: Desabilitar funções perigosas (disable_functions).

    Aumentar performance: Controlar uso de memória, tempo máximo de execução.

    Adaptar ambiente: Ajustar fuso horário, charset, comportamento de logs.

    Facilitar debugging: Ativar/desativar exibição de erros (display_errors).

    Controlar uploads e requisições: Limitar tamanhos de upload, variáveis POST etc.

## Como uma Diretiva Funciona? 

1️⃣ O interpretador PHP (Zend Engine) é iniciado pelo servidor web ou pela CLI.
2️⃣ Ele carrega o arquivo php.ini — ou várias fontes de configuração (php.ini, .htaccess, diretivas do servidor, variáveis de ambiente).
3️⃣ As diretivas são lidas, validadas e armazenadas em memória para uso durante a execução de cada script.
4️⃣ Quando um script PHP roda, o motor segue essas regras para limitar, permitir ou modificar comportamentos em tempo real.

### 📌 Exemplo prático do fluxo:

    Se memory_limit = 128M no php.ini, nenhum script PHP pode ultrapassar 128 MB de uso de RAM — se ultrapassar, um erro fatal é disparado.

    Se display_errors = Off, qualquer erro será logado, mas não exibido para o usuário final.

## Onde e Como Usar Diretivas?

1. php.ini

Principal local de definição. Exemplo:
    
    memory_limit = 256M
    display_errors = Off
    
    🔍 Prós: Valor padrão para todo o servidor.
    🔍 Contras: Alterar requer reiniciar o servidor PHP (dependendo do ambiente).

2. arq.htaccess (arquivo com extensão .htaccess) no (servidores Apache)
Para projetos hospedados em Apache com mod_php:

    php_value memory_limit 256M
    php_flag display_errors Off

    🔍 Obs: Nem toda diretiva é permitida no .htaccess. Respeite o AllowOverride do servidor.

3. Diretamente no código com ini_set()

Para alterar diretivas em tempo de execução, se a diretiva for modificável dinamicamente:

```php
<?php
    ini_set('display_errors', '1');
    ini_set('memory_limit', '512M');
?>
```

4. Linha de comando (CLI)
Para scripts executados pelo terminal:

    php -d memory_limit=512M script.php

## Tipos de Diretivas

Cada diretiva tem um nível de mutabilidade:

    Nível	                Onde pode ser alterada
    PHP_INI_SYSTEM	    Somente no php.ini ou servidor
    PHP_INI_PERDIR	    php.ini ou diretórios (.htaccess)
    PHP_INI_USER	    php.ini, .htaccess ou ini_set()
    PHP_INI_ALL	        Qualquer lugar

🔍 Nem toda diretiva pode ser modificada via ini_set()!

## Como Saber o Valor de uma Diretiva?
Para ler valores atuais, use:

```php
<?php
echo ini_get('memory_limit');
?>
```
Para restaurar:

```php
<?php
ini_restore('memory_limit');
?>
```

Para ver todas as diretivas carregadas:

```php
<?php
phpinfo();
?>
```
## Resumo Prático
✔️ Diretiva = regra de configuração do motor PHP
✔️ Define limites, permissões, segurança, ambiente
✔️ Pode ser ajustada em php.ini, .htaccess, ini_set() ou CLI
✔️ É interpretada pelo Zend Engine antes ou durante a execução do script
✔️ Impacta performance, segurança, debugging e compatibilidade

## TABELA DE DIRETIVAS DO PHP

| Categoria | Diretiva | Descrição | Exemplo |
|-----------|----------|-----------|---------|
| **Erros e Logs** | `error_reporting` | Define quais tipos de erro são reportados. | `error_reporting(E_ALL);` |
| | `display_errors` | Exibe erros no output. | `ini_set('display_errors', '1');` |
| | `log_errors` | Salva erros em log. | `ini_set('log_errors', '1');` |
| | `error_log` | Caminho do arquivo de log de erros. | `error_log = "/var/log/php_errors.log"` |
| | `track_errors` | Habilita variável `$php_errormsg`. | `ini_set('track_errors', '1');` |
| **Execução e Recursos** | `memory_limit` | Limite máximo de memória para scripts. | `ini_set('memory_limit', '512M');` |
| | `max_execution_time` | Tempo máximo de execução (segundos). | `ini_set('max_execution_time', '60');` |
| | `max_input_time` | Tempo máximo para processamento de entrada. | `ini_set('max_input_time', '60');` |
| | `max_input_vars` | Máximo de variáveis de entrada. | `max_input_vars = 1000` |
| | `post_max_size` | Tamanho máximo de dados POST. | `post_max_size = 8M` |
| | `upload_max_filesize` | Tamanho máximo de upload de arquivos. | `upload_max_filesize = 2M` |
| | `max_file_uploads` | Número máximo de arquivos por upload. | `max_file_uploads = 20` |
| | `default_socket_timeout` | Timeout padrão de socket. | `default_socket_timeout = 60` |
| **Sessões** | `session.save_path` | Caminho de armazenamento de sessão. | `session_save_path('/tmp/sessions');` |
| | `session.gc_maxlifetime` | Tempo máximo de vida da sessão (segundos). | `session.gc_maxlifetime = 1440` |
| | `session.cookie_lifetime` | Tempo de vida do cookie de sessão. | `session.cookie_lifetime = 0` |
| | `session.use_cookies` | Usa cookies para ID de sessão. | `session.use_cookies = 1` |
| | `session.use_only_cookies` | Restringe ID de sessão só a cookies. | `session.use_only_cookies = 1` |
| | `session.cookie_secure` | Cookies de sessão apenas em HTTPS. | `session.cookie_secure = 1` |
| **Segurança** | `allow_url_fopen` | Permite abrir URLs com funções de I/O. | `allow_url_fopen = On` |
| | `allow_url_include` | Permite `include` via URL. | `allow_url_include = Off` |
| | `disable_functions` | Desativa funções perigosas. | `disable_functions = exec,passthru,shell_exec` |
| | `open_basedir` | Restringe diretórios de operação. | `open_basedir = "/var/www/html:/tmp/"` |
| | `expose_php` | Exibe cabeçalho X-Powered-By. | `expose_php = Off` |
| | `safe_mode` | Modo seguro (obsoleto). | `safe_mode = Off` |
| **Upload/Arquivo** | `file_uploads` | Permite upload de arquivos. | `file_uploads = On` |
| | `upload_tmp_dir` | Diretório temporário de uploads. | `upload_tmp_dir = "/tmp"` |
| **Padrões/Charset** | `default_charset` | Charset padrão da saída. | `default_charset = "UTF-8"` |
| | `default_mimetype` | MIME padrão da resposta. | `default_mimetype = "text/html"` |
| **Data/Hora** | `date.timezone` | Fuso horário padrão. | `date.timezone = "America/Sao_Paulo"` |
| **Desempenho** | `realpath_cache_size` | Tamanho do cache de caminhos reais. | `realpath_cache_size = 16K` |
| | `realpath_cache_ttl` | TTL do cache de caminhos reais. | `realpath_cache_ttl = 120` |
| **Outros** | `precision` | Precisão de floats. | `precision = 14` |
| | `short_open_tag` | Permite `<? ?>` como tag curta. | `short_open_tag = On` |
| | `zend.assertions` | Define comportamento de `assert()`. | `zend.assertions = -1` |
| | `memory_limit` | (Repetido propositalmente, pois é crítico). | `memory_limit = 256M` |

---

## 📌 Observações

- ✅ Use `ini_set()` **apenas se a diretiva permitir alteração dinâmica**.  
- ✅ Sempre teste configurações em ambiente de staging antes de ir para produção.  
- ✅ Documente alterações para rastreabilidade.  
- ⚡️ Para listar **todas as diretivas carregadas** em execução:  

```php
  <?php phpinfo(); ?>
```
