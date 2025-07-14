# Introdução

Este arquivo tem como objetivo exibir as principais funções nativas do **PHP 8**, úteis para o desenvolvimento de sistemas web, scripts CLI e automação.  
Cada tabela apresenta a **função**, **descrição**, **parâmetros**, **tipo de retorno**, **exemplo** e observações importantes.

Recomendo que utilize o pesquisar (cntrl + f) para o que deseja.

---

## 📌 Índice

- [Strings](#Strings)
- [Arrays](#arrays)
- [Datas e Hora](#datas-e-hora)
- [Arquivo e I/O](#arquivo-e-io)
- [Validação](#validação)
- [Filtros e Segurança](#filtros-e-segurança)
- [Matemática](#matemática)
- [Outras Utilidades](#outras-utilidades)

---

# 🔤 Strings

## 📏 Informação / Comprimento (String)

| Função | Descrição | Parâmetros | Retorno | Exemplo | Observações |
|--------|-----------|-------------|---------|---------|-------------|
| `strlen` | Comprimento em bytes/caracteres. | `string $string` | `int` | `strlen("abc") // 3` | Para multibyte use `mb_strlen`. |
| `mb_strlen` | Comprimento de string multibyte. | `string $string` | `int` | `mb_strlen("ção") // 3` | Depende da extensão `mbstring`. |
| `str_word_count` | Conta palavras. | `string $string`, `int $format` | `int|array` | `str_word_count("Hello World") // 2` | |

---

## 🔍 Busca (String)

| Função | Descrição | Parâmetros | Retorno | Exemplo | Observações |
|--------|-----------|-------------|---------|---------|-------------|
| `strpos` | Primeira ocorrência. | `string $haystack`, `string $needle` | `int|false` | `strpos("abcabc","b") // 1` | |
| `stripos` | Primeira ocorrência (case-insensitive). | `string $haystack`, `string $needle` | `int|false` | `stripos("aBc","B") // 1` | |
| `strrpos` | Última ocorrência. | `string $haystack`, `string $needle` | `int|false` | `strrpos("abcabc","b") // 4` | |
| `strripos` | Última ocorrência (case-insensitive). | `string $haystack`, `string $needle` | `int|false` | `strripos("abcAbc","B") // 4` | |
| `str_contains` | Contém substring? | `string $haystack`, `string $needle` | `bool` | `str_contains("abc","b")` | Desde PHP 8.0 |
| `str_starts_with` | Começa com? | `string $haystack`, `string $needle` | `bool` | `str_starts_with("abc","a")` | PHP 8.0 |
| `str_ends_with` | Termina com? | `string $haystack`, `string $needle` | `bool` | `str_ends_with("abc","c")` | PHP 8.0 |
| `substr_count` | Conta ocorrências. | `string $haystack`, `string $needle` | `int` | `substr_count("abcabc","b") // 2` | |

---

## ✂️ Manipulação (String)

| Função | Descrição | Parâmetros | Retorno | Exemplo | Observações |
|--------|-----------|-------------|---------|---------|-------------|
| `substr` | Retorna parte da string. | `string $string`, `int $start`, `?int $length` | `string` | `substr("abcdef",1,3) // "bcd"` | |
| `str_replace` | Substitui ocorrência(s). | `mixed $search`, `mixed $replace`, `mixed $subject` | `string|array` | `str_replace("a","x","abc") // "xbc"` | |
| `str_ireplace` | Substitui (insensível). | `mixed $search`, `mixed $replace`, `mixed $subject` | `string|array` | `str_ireplace("A","x","Abc") // "xbc"` | |
| `str_pad` | Preenche string. | `string $string`, `int $length`, `string $pad_string` | `string` | `str_pad("php",6,"-") // "php---"` | |
| `str_repeat` | Repete string. | `string $string`, `int $times` | `string` | `str_repeat("xo",3) // "xoxoxo"` | |
| `str_split` | Divide em array. | `string $string`, `int $length` | `array` | `str_split("abc")` | |
| `chunk_split` | Divide com delimitador. | `string $string`, `int $length`, `string $end` | `string` | `chunk_split("abcdef",2,"-")` | |
| `trim` | Remove espaços. | `string $string`, `string $characters` | `string` | `trim(" abc ") // "abc"` | |
| `ltrim` | Remove à esquerda. | `string $string` | `string` | `ltrim(" abc")` | |
| `rtrim` | Remove à direita. | `string $string` | `string` | `rtrim("abc ")` | |
| `wordwrap` | Quebra string em linhas. | `string $string`, `int $width`, `string $break`, `bool $cut` | `string` | `wordwrap("Uma frase longa",5,"|")` | |

---

## 🔁 Comparação (String)

| Função | Descrição | Parâmetros | Retorno | Exemplo | Observações |
|--------|-----------|-------------|---------|---------|-------------|
| `strcmp` | Compara strings (sensitive). | `string $str1`, `string $str2` | `int` | `strcmp("abc","ABC") // >0` | 0 se iguais |
| `strcasecmp` | Compara strings (insensitive). | `string $str1`, `string $str2` | `int` | `strcasecmp("abc","ABC") // 0` | |
| `strnatcmp` | Comparação natural. | `string $str1`, `string $str2` | `int` | `strnatcmp("img2","img10")` | Natural Order. |
| `strnatcasecmp` | Natural + insensitive. | `string $str1`, `string $str2` | `int` | `strnatcasecmp("img2","IMG10")` | |

---

## 🧩 Codificação (String)

| Função | Descrição | Parâmetros | Retorno | Exemplo | Observações |
|--------|-----------|-------------|---------|---------|-------------|
| `htmlspecialchars` | Escapa HTML especial. | `string $string` | `string` | `htmlspecialchars("<p>")` | |
| `htmlentities` | Escapa tudo. | `string $string` | `string` | `htmlentities("<p>")` | |
| `md5` | Hash MD5. | `string $string`, `bool $raw_output` | `string` | `md5("abc")` | Não seguro para senhas. |
| `sha1` | Hash SHA1. | `string $string` | `string` | `sha1("abc")` | Também não recomendado p/ senhas. |
| `bin2hex` | Binário → hexadecimal. | `string $string` | `string` | `bin2hex("ABC")` | |
| `hex2bin` | Hexadecimal → binário. | `string $string` | `string|false` | `hex2bin("414243")` | |
| `addslashes` | Adiciona barras invertidas. | `string $string` | `string` | `addslashes("O'Reilly")` | Evitar. Prefira prepared statements. |
| `stripslashes` | Remove barras invertidas. | `string $string` | `string` | `stripslashes("O\\'Reilly")` | |

---

## 🧵 Expressões Regulares (String)

| Função | Descrição | Parâmetros | Retorno | Exemplo | Observações |
|--------|-----------|-------------|---------|---------|-------------|
| `preg_match` | Busca padrão (1ª). | `string $pattern`, `string $subject`, `array &$matches` | `int` | `preg_match("/\d+/","abc123",$m)` | |
| `preg_match_all` | Busca todas. | `string $pattern`, `string $subject`, `array &$matches` | `int` | `preg_match_all("/\d+/","abc123abc456",$m)` | |
| `preg_replace` | Substitui regex. | `mixed $pattern`, `mixed $replacement`, `mixed $subject` | `mixed` | `preg_replace("/\d+/","X","123abc")` | |
| `preg_split` | Divide com regex. | `string $pattern`, `string $subject` | `array` | `preg_split("/[\s,]+/","a,b c")` | |
| `preg_grep` | Filtra array com regex. | `string $pattern`, `array $input` | `array` | `preg_grep("/^a/", ["apple","banana"])` | |

---

## ⚙️ Outros Utilitários (String)

| Função | Descrição | Parâmetros | Retorno | Exemplo | Observações |
|--------|-----------|-------------|---------|---------|-------------|
| `number_format` | Formata número como string. | `float $num`, `int $decimals` | `string` | `number_format(1234.567,2)` | |
| `implode` | Junta array em string. | `string $glue`, `array $pieces` | `string` | `implode(", ",["a","b"])` | |
| `explode` | Divide string em array. | `string $delimiter`, `string $string` | `array` | `explode(",","a,b,c")` | |

---

# 🧩 Arrays

## 🛠 Criação e Estrutura (Array)

| Função | Descrição | Parâmetros | Retorno | Exemplo | Observações |
|--------|-----------|-------------|---------|---------|-------------|
| `array` | Cria array. | - | `array` | `$a = array(1,2,3);` | Desde PHP 5.4, prefira `[]`. |
| `range` | Cria sequência. | `mixed $start`, `mixed $end`, `int $step` | `array` | `range(1,5)` → `[1,2,3,4,5]` | |
| `array_fill` | Preenche array com valores. | `int $start_index`, `int $count`, `mixed $value` | `array` | `array_fill(0,3,'x')` → `['x','x','x']` | |
| `array_fill_keys` | Cria array com chaves definidas. | `array $keys`, `mixed $value` | `array` | `array_fill_keys(['a','b'],'v')` | |
| `array_combine` | Une arrays `keys` + `values`. | `array $keys`, `array $values` | `array` | `array_combine(['a','b'],[1,2])` | Tamanhos devem coincidir. |

---

## ✂️ Manipulação (Array)

| Função | Descrição | Parâmetros | Retorno | Exemplo | Observações |
|--------|-----------|-------------|---------|---------|-------------|
| `array_merge` | Une arrays. | `array ...$arrays` | `array` | `array_merge([1,2],[3])` | Chaves numéricas são reindexadas. |
| `array_merge_recursive` | Une arrays recursivamente. | `array ...$arrays` | `array` | `array_merge_recursive(['a'=>1],['a'=>2])` → `['a'=>[1,2]]` | |
| `array_replace` | Substitui valores por chave. | `array $array, array ...$replacements` | `array` | `array_replace(['a'=>1],['a'=>2])` | |
| `array_splice` | Remove/substitui parte do array. | `array &$array, int $offset, ?int $length, mixed $replacement` | `array` | `array_splice($a,1,2)` | Modifica array original. |
| `array_slice` | Retorna parte do array. | `array $array, int $offset, ?int $length` | `array` | `array_slice([1,2,3,4],1,2)` | Mantém chaves originais. |
| `array_push` | Adiciona ao final. | `array &$array, mixed ...$values` | `int` (novo tamanho) | `array_push($a,4)` | Igual usar `$a[] =`. |
| `array_pop` | Remove último elemento. | `array &$array` | `mixed` | `array_pop($a)` | |
| `array_shift` | Remove primeiro elemento. | `array &$array` | `mixed` | `array_shift($a)` | |
| `array_unshift` | Adiciona ao início. | `array &$array, mixed ...$values` | `int` | `array_unshift($a,0)` | |
| `array_map` | Aplica função a todos os elementos. | `callable $callback, array $array` | `array` | `array_map('strtoupper',['a','b'])` | |
| `array_walk` | Itera e aplica função. | `array &$array, callable $callback` | `bool` | `array_walk($a, fn(&$v) => $v++)` | Modifica original. |
| `array_walk_recursive` | Aplica em todos níveis. | `array &$array, callable $callback` | `bool` | `array_walk_recursive($a, fn(&$v) => $v++)` | |

---

## 🔍 Busca e Filtros (Array)

| Função | Descrição | Parâmetros | Retorno | Exemplo | Observações |
|--------|-----------|-------------|---------|---------|-------------|
| `in_array` | Valor existe? | `mixed $needle, array $haystack` | `bool` | `in_array(2,[1,2,3])` | `strict` opcional. |
| `array_search` | Busca chave de valor. | `mixed $needle, array $haystack` | `mixed` | `array_search('x',['a'=>'x'])` | |
| `array_key_exists` | Chave existe? | `mixed $key, array $array` | `bool` | `array_key_exists('a',$a)` | |
| `array_filter` | Filtra por callback. | `array $array, ?callable $callback` | `array` | `array_filter([1,0,2])` | |
| `array_unique` | Remove duplicatas. | `array $array` | `array` | `array_unique([1,1,2])` | |
| `array_diff` | Diferença de arrays. | `array $array1, array $array2` | `array` | `array_diff([1,2,3],[2])` → `[1,3]` | |
| `array_intersect` | Interseção. | `array $array1, array $array2` | `array` | `array_intersect([1,2],[2,3])` → `[2]` | |

---

## 🔃 Ordenação (Array)

| Função | Descrição | Parâmetros | Retorno | Exemplo | Observações |
|--------|-----------|-------------|---------|---------|-------------|
| `sort` | Ordena e reindexa. | `array &$array` | `bool` | `sort($a)` | Modifica array. |
| `rsort` | Ordena reverso. | `array &$array` | `bool` | `rsort($a)` | |
| `asort` | Ordena preservando chaves. | `array &$array` | `bool` | `asort($a)` | |
| `arsort` | Ordena reverso preservando chaves. | `array &$array` | `bool` | `arsort($a)` | |
| `ksort` | Ordena pelas chaves. | `array &$array` | `bool` | `ksort($a)` | |
| `krsort` | Ordena chaves reverso. | `array &$array` | `bool` | `krsort($a)` | |
| `usort` | Ordena com função de comparação. | `array &$array, callable $callback` | `bool` | `usort($a, fn($x,$y) => $x <=> $y)` | |
| `uksort` | Ordena chaves com função. | `array &$array, callable $callback` | `bool` | `uksort($a, fn($x,$y) => strcmp($x,$y))` | |

---

## ⚙️ Funções Funcionais (Array)

| Função | Descrição | Parâmetros | Retorno | Exemplo | Observações |
|--------|-----------|-------------|---------|---------|-------------|
| `array_reduce` | Reduz array a 1 valor. | `array $array, callable $callback, mixed $initial` | `mixed` | `array_reduce([1,2,3], fn($c,$v)=>$c+$v)` | |
| `array_column` | Extrai coluna. | `array $array, int|string $column_key, int|string $index_key` | `array` | `array_column($users,'name')` | Arrays de arrays. |
| `array_sum` | Soma valores. | `array $array` | `number` | `array_sum([1,2,3])` | |
| `array_product` | Produto dos valores. | `array $array` | `number` | `array_product([1,2,3])` → `6` | |

---

## ✅ Checagem e Validação (Array)

| Função | Descrição | Parâmetros | Retorno | Exemplo | Observações |
|--------|-----------|-------------|---------|---------|-------------|
| `is_array` | É array? | `mixed $var` | `bool` | `is_array([])` | |
| `count` | Conta elementos. | `Countable|array` | `int` | `count([1,2])` | |
| `sizeof` | Alias de `count`. | `Countable|array` | `int` | `sizeof($a)` | |

---

## 🧰 Outros Utilitários (Array)

| Função | Descrição | Parâmetros | Retorno | Exemplo | Observações |
|--------|-----------|-------------|---------|---------|-------------|
| `array_keys` | Retorna chaves. | `array $array` | `array` | `array_keys(['a'=>1])` | |
| `array_values` | Retorna valores. | `array $array` | `array` | `array_values(['a'=>1])` | |
| `array_flip` | Troca chaves/valores. | `array $array` | `array` | `array_flip(['a'=>1])` | |
| `array_reverse` | Inverte ordem. | `array $array` | `array` | `array_reverse([1,2,3])` | |
| `list` | Atribuição múltipla. | `list($a,$b) = [1,2]` | - | `list($x,$y) = [1,2]` | Não é função, é sintaxe. |

---

## ⚙️ Observações Finais (Array)

- Sempre confira chaves/índices para evitar erros de `offset`.
- Para grandes coleções, prefira `generators` (`yield`) para memória otimizada.
- Use funções **imunes a efeitos colaterais** sempre que possível para pipelines previsíveis.


# 📅 Datas e Hora

## ⏳ Timestamps Simples (Data e Hora)

| Função | Descrição | Parâmetros | Retorno | Exemplo | Observações |
|--------|-----------|-------------|---------|---------|-------------|
| `time` | Retorna timestamp atual (segundos desde Unix Epoch). | - | `int` | `time() // 1720798741` | |
| `microtime` | Retorna microsegundos. | `bool $as_float` | `string|float` | `microtime(true)` | Float desde PHP 5.0. |
| `mktime` | Cria timestamp customizado. | `int $hour, int $min, int $sec, int $month, int $day, int $year` | `int|false` | `mktime(0,0,0,12,31,2025)` | |
| `gmmktime` | Igual `mktime`, mas GMT. | `...` | `int|false` | `gmmktime(0,0,0,12,31,2025)` | |

---

## 📅 Formatação e Parsing (Data e Hora)

| Função | Descrição | Parâmetros | Retorno | Exemplo | Observações |
|--------|-----------|-------------|---------|---------|-------------|
| `date` | Formata timestamp. | `string $format, ?int $timestamp` | `string` | `date('Y-m-d H:i')` | Depende de timezone padrão. |
| `gmdate` | Igual `date` mas GMT. | `string $format, ?int $timestamp` | `string` | `gmdate('Y-m-d')` | |
| `strftime` | Formata usando locale. | `string $format, ?int $timestamp` | `string` | `strftime('%A')` | OBS: Depreciação futura! |
| `strtotime` | Converte string → timestamp. | `string $datetime, ?int $baseTimestamp` | `int|false` | `strtotime('+1 day')` | |
| `getdate` | Array detalhado de data. | `?int $timestamp` | `array` | `getdate()` | |
| `checkdate` | Valida uma data. | `int $month, int $day, int $year` | `bool` | `checkdate(2,29,2024)` | Ano bissexto. |
| `idate` | Extrai parte como int. | `string $format, ?int $timestamp` | `int|false` | `idate('Y')` | |

---

## 🧩 DateTime API OO (Data e Hora)

| Classe / Função | Descrição | Parâmetros | Retorno | Exemplo | Observações |
|-----------------|-----------|-------------|---------|---------|-------------|
| `new DateTime` | Cria objeto DateTime. | `string $datetime = "now", ?DateTimeZone $timezone` | `DateTime` | `new DateTime('2025-12-31')` | |
| `DateTime::format` | Formata objeto DateTime. | `string $format` | `string` | `$dt->format('Y-m-d')` | |
| `DateTime::modify` | Modifica a data. | `string $modifier` | `DateTime|false` | `$dt->modify('+1 day')` | |
| `DateTime::setDate` | Define data. | `int $year, int $month, int $day` | `DateTime` | `$dt->setDate(2026,1,1)` | |
| `DateTime::setTime` | Define hora. | `int $hour, int $minute, int $second` | `DateTime` | `$dt->setTime(12,30,0)` | |
| `DateTime::getTimestamp` | Timestamp do objeto. | - | `int` | `$dt->getTimestamp()` | |
| `DateTime::setTimestamp` | Seta timestamp. | `int $timestamp` | `DateTime` | `$dt->setTimestamp(time())` | |
| `DateTime::diff` | Diferença entre datas. | `DateTimeInterface $targetObject` | `DateInterval` | `$dt1->diff($dt2)` | |

---

## 🔄 Diferenças & Intervalos (Data e Hora)

| Classe / Função | Descrição | Parâmetros | Retorno | Exemplo | Observações |
|-----------------|-----------|-------------|---------|---------|-------------|
| `date_diff` | Diferença procedural. | `DateTimeInterface $datetime1, DateTimeInterface $datetime2` | `DateInterval` | `date_diff($d1,$d2)` | Igual `DateTime::diff`. |
| `DateInterval` | Representa intervalo. | `string $interval_spec` | `DateInterval` | `new DateInterval('P1D')` | ISO 8601. |
| `DateInterval::format` | Formata intervalo. | `string $format` | `string` | `$di->format('%R%a days')` | |
| `DatePeriod` | Cria série de datas. | `DateTimeInterface $start, DateInterval $interval, DateTimeInterface|int $end` | `DatePeriod` | `new DatePeriod(...)` | Loop com `foreach`. |

---

## 🌐 Timezones (Data e Hora)

| Classe / Função | Descrição | Parâmetros | Retorno | Exemplo | Observações |
|-----------------|-----------|-------------|---------|---------|-------------|
| `new DateTimeZone` | Cria fuso horário. | `string $timezone` | `DateTimeZone` | `new DateTimeZone('UTC')` | |
| `DateTime::setTimezone` | Altera fuso horário. | `DateTimeZone $timezone` | `DateTime` | `$dt->setTimezone(new DateTimeZone('America/Sao_Paulo'))` | |
| `date_default_timezone_set` | Define timezone global. | `string $timezone` | `bool` | `date_default_timezone_set('UTC')` | |
| `date_default_timezone_get` | Retorna timezone global. | - | `string` | `date_default_timezone_get()` | |

---

## ⚙️ Utilidades (Data e Hora)

| Função | Descrição | Parâmetros | Retorno | Exemplo | Observações |
|--------|-----------|-------------|---------|---------|-------------|
| `sleep` | Pausa execução. | `int $seconds` | `int` | `sleep(2)` | |
| `usleep` | Pausa em microsegundos. | `int $micro_seconds` | `void` | `usleep(500000)` | |
| `time_nanosleep` | Pausa em nanossegundos. | `int $seconds, int $nanoseconds` | `mixed` | `time_nanosleep(0,500000000)` | |
| `date_sun_info` | Info sobre nascer/por do sol. | `int $time, float $latitude, float $longitude` | `array` | `date_sun_info(time(),-23.55,-46.63)` | Retorna array com sunrise/sunset. |

---

## ✅ Observações Finais (Data e Hora)

- Prefira **DateTime API OO**: mais robusta, testável, compatível com fuso horário.
- `strtotime` é poderoso, mas exige validação de formatos.
- Mantenha **timezone explícito** em sistemas globais para evitar bugs sutis.
- Para intervalos repetidos, `DatePeriod` é ideal.

---

# 📂 Arquivo e I/O

## 📝 Criação & Escrita (Arquivo e I/O)

| Função | Descrição | Parâmetros | Retorno | Exemplo | Observações |
|--------|-----------|-------------|---------|---------|-------------|
| `file_put_contents` | Escreve dados em arquivo. | `string $filename, mixed $data` | `int|false` | `file_put_contents('log.txt', 'Hello')` | Cria ou sobrescreve. |
| `fopen` | Abre arquivo ou URL. | `string $filename, string $mode` | `resource|false` | `$fp = fopen('log.txt', 'w')` | Ver `fwrite` + `fclose`. |
| `fwrite` | Escreve no ponteiro de arquivo. | `resource $handle, string $string` | `int|false` | `fwrite($fp, 'abc')` | |
| `fputs` | Alias de `fwrite`. | `resource $handle, string $string` | `int|false` | | |
| `fclose` | Fecha ponteiro de arquivo. | `resource $handle` | `bool` | `fclose($fp)` | |
| `fprintf` | Escreve com formato. | `resource $handle, string $format, mixed ...$values` | `int|false` | `fprintf($fp, "ID: %d", 123)` | |
| `mkdir` | Cria diretório. | `string $directory` | `bool` | `mkdir('data')` | Permissões via `chmod`. |

---

## 📖 Leitura (Arquivo e I/O)

| Função | Descrição | Parâmetros | Retorno | Exemplo | Observações |
|--------|-----------|-------------|---------|---------|-------------|
| `file_get_contents` | Lê arquivo inteiro. | `string $filename` | `string|false` | `file_get_contents('log.txt')` | |
| `file` | Lê como array de linhas. | `string $filename` | `array|false` | `file('log.txt')` | Cada linha = item array. |
| `fread` | Lê do ponteiro. | `resource $handle, int $length` | `string|false` | `fread($fp, 100)` | |
| `fgets` | Lê linha do ponteiro. | `resource $handle` | `string|false` | `fgets($fp)` | |
| `feof` | EOF? | `resource $handle` | `bool` | `feof($fp)` | Para loop leitura. |

---

## 🗂 Metadados & Permissões (Arquivo e I/O)

| Função | Descrição | Parâmetros | Retorno | Exemplo | Observações |
|--------|-----------|-------------|---------|---------|-------------|
| `file_exists` | Arquivo/diretório existe? | `string $filename` | `bool` | `file_exists('log.txt')` | |
| `is_file` | É um arquivo? | `string $filename` | `bool` | `is_file('log.txt')` | |
| `is_dir` | É diretório? | `string $filename` | `bool` | `is_dir('data')` | |
| `filesize` | Retorna tamanho. | `string $filename` | `int|false` | `filesize('log.txt')` | Bytes. |
| `filemtime` | Última modificação. | `string $filename` | `int|false` | `filemtime('log.txt')` | Timestamp Unix. |
| `chmod` | Muda permissão. | `string $filename, int $mode` | `bool` | `chmod('log.txt', 0644)` | |
| `unlink` | Remove arquivo. | `string $filename` | `bool` | `unlink('log.txt')` | |
| `rename` | Renomeia/move. | `string $oldname, string $newname` | `bool` | `rename('a.txt','b.txt')` | |
| `copy` | Copia arquivo. | `string $source, string $dest` | `bool` | `copy('a.txt','b.txt')` | |

---

## 📁 Manipulação de Diretórios (Arquivo e I/O)

| Função | Descrição | Parâmetros | Retorno | Exemplo | Observações |
|--------|-----------|-------------|---------|---------|-------------|
| `opendir` | Abre diretório. | `string $directory` | `resource|false` | `$dh = opendir('data')` | |
| `readdir` | Lê item. | `resource $dir_handle` | `string|false` | `readdir($dh)` | |
| `closedir` | Fecha diretório. | `resource $dir_handle` | `void` | `closedir($dh)` | |
| `scandir` | Lê lista de arquivos. | `string $directory` | `array|false` | `scandir('.')` | |
| `rmdir` | Remove diretório vazio. | `string $directory` | `bool` | `rmdir('data')` | |

---

## 🌊 Streams & Avançado (Arquivo e I/O)

| Função | Descrição | Parâmetros | Retorno | Exemplo | Observações |
|--------|-----------|-------------|---------|---------|-------------|
| `readfile` | Imprime conteúdo direto. | `string $filename` | `int|false` | `readfile('log.txt')` | Ecoloca direto no output. |
| `fseek` | Move ponteiro. | `resource $handle, int $offset` | `int` | `fseek($fp, 0)` | |
| `ftell` | Posição atual do ponteiro. | `resource $handle` | `int` | `ftell($fp)` | |
| `rewind` | Reinicia ponteiro. | `resource $handle` | `bool` | `rewind($fp)` | |
| `tmpfile` | Cria arquivo temporário. | - | `resource|false` | `$tmp = tmpfile()` | Excluído ao fechar. |
| `tempnam` | Cria nome de arquivo tmp. | `string $dir, string $prefix` | `string|false` | `tempnam(sys_get_temp_dir(),'pre')` | |
| `fpassthru` | Imprime resto do ponteiro. | `resource $handle` | `int` | `fpassthru($fp)` | |
| `flock` | Bloqueia arquivo. | `resource $handle, int $operation` | `bool` | `flock($fp, LOCK_EX)` | Concorrência segura. |

---

## ✅ Notas Finais (Arquivo e I/O)

- Para leitura/gravação segura, combine `fopen` + `flock`.
- Use `file_get_contents`/`file_put_contents` para casos **simples e rápidos**.
- Streams são poderosos para **arquivos grandes** ou **respostas HTTP**.
- **Sempre valide caminhos** para evitar **path traversal**.

---

# ✅ Validação e Filtragem

## 🔍 Verificação de Tipos (Validação e Filtragem)

| Função | Descrição | Parâmetros | Retorno | Exemplo | Observações |
|--------|-----------|-------------|---------|---------|-------------|
| `is_int` | É inteiro? | `mixed $var` | `bool` | `is_int(10)` | |
| `is_float` | É float? | `mixed $var` | `bool` | `is_float(3.14)` | |
| `is_numeric` | É numérico? | `mixed $var` | `bool` | `is_numeric('123')` | String numérica OK. |
| `is_string` | É string? | `mixed $var` | `bool` | `is_string('abc')` | |
| `is_bool` | É booleano? | `mixed $var` | `bool` | `is_bool(true)` | |
| `is_array` | É array? | `mixed $var` | `bool` | `is_array([])` | |
| `is_object` | É objeto? | `mixed $var` | `bool` | `is_object(new stdClass())` | |
| `is_callable` | É chamável? | `mixed $var` | `bool` | `is_callable('strlen')` | |
| `is_resource` | É resource? | `mixed $var` | `bool` | `is_resource($fp)` | |

---

## 🧹 Validação com Filtros (Validação e Filtragem)

| Função | Descrição | Parâmetros | Retorno | Exemplo | Observações |
|--------|-----------|-------------|---------|---------|-------------|
| `filter_var` | Filtra e valida uma variável. | `mixed $var, int $filter, array $options` | `mixed|false` | `filter_var('test@test.com', FILTER_VALIDATE_EMAIL)` | |
| `filter_input` | Filtra entrada global (`$_GET`, `$_POST`). | `int $type, string $var_name, int $filter` | `mixed|false` | `filter_input(INPUT_GET, 'email', FILTER_VALIDATE_EMAIL)` | |
| `filter_var_array` | Filtra várias variáveis. | `array $data, array $filters` | `array|false` | `filter_var_array($_POST, ['age'=>FILTER_VALIDATE_INT])` | |
| `filter_input_array` | Filtra entrada global com array. | `int $type, array $filters` | `array|false` | `filter_input_array(INPUT_POST, [...])` | |
| `FILTER_VALIDATE_EMAIL` | Valida e-mail. | Usado com `filter_var`. | - | | |
| `FILTER_VALIDATE_INT` | Valida int. | Usado com `filter_var`. | - | | |
| `FILTER_VALIDATE_FLOAT` | Valida float. | Usado com `filter_var`. | - | | |
| `FILTER_VALIDATE_IP` | Valida IP. | Usado com `filter_var`. | - | `filter_var('127.0.0.1', FILTER_VALIDATE_IP)` | |
| `FILTER_VALIDATE_URL` | Valida URL. | Usado com `filter_var`. | - | `filter_var('https://ex.com', FILTER_VALIDATE_URL)` | |

---

## 📏 Validação Regex (Validação e Filtragem)

| Função | Descrição | Parâmetros | Retorno | Exemplo | Observações |
|--------|-----------|-------------|---------|---------|-------------|
| `preg_match` | Testa regex. | `string $pattern, string $subject` | `int|false` | `preg_match('/^[a-z]+$/i', 'Abc')` | Retorna 1, 0 ou false. |
| `preg_match_all` | Testa todas ocorrências. | `string $pattern, string $subject, array &$matches` | `int|false` | `preg_match_all('/\d+/', 'a1b2c3', $out)` | |
| `preg_replace` | Substitui usando regex. | `string|array $pattern, string|array $replacement, string|array $subject` | `string|array|null` | `preg_replace('/\s+/', '-', 'a b c')` | |
| `preg_split` | Divide string com regex. | `string $pattern, string $subject` | `array|false` | `preg_split('/,/', 'a,b,c')` | |

---

## 🧴 Sanitização (Validação e Filtragem)

| Função | Descrição | Parâmetros | Retorno | Exemplo | Observações |
|--------|-----------|-------------|---------|---------|-------------|
| `htmlspecialchars` | Escapa HTML. | `string $string` | `string` | `htmlspecialchars('<b>')` → `&lt;b&gt;` | Evita XSS. |
| `strip_tags` | Remove tags HTML/PHP. | `string $string` | `string` | `strip_tags('<b>abc</b>')` → `abc` | |
| `trim` | Remove espaços laterais. | `string $string` | `string` | `trim(' abc ')` | |
| `filter_var` | Modo sanitização. | `FILTER_SANITIZE_*` | `mixed` | `filter_var('abc@example.com', FILTER_SANITIZE_EMAIL)` | |
| `FILTER_SANITIZE_EMAIL` | Remove chars inválidos. | - | - | | |
| `FILTER_SANITIZE_URL` | Limpa URL. | - | - | | |
| `FILTER_SANITIZE_STRING` | Remove tags e codifica especial. | OBS: Deprecada. | - | | |

---

## 📌 Verificação de Variáveis (Validação e Filtragem)

| Função | Descrição | Parâmetros | Retorno | Exemplo | Observações |
|--------|-----------|-------------|---------|---------|-------------|
| `isset` | Existe e não é null? | `mixed $var` | `bool` | `isset($_POST['name'])` | |
| `empty` | É vazia? | `mixed $var` | `bool` | `empty($var)` | |
| `is_null` | É null? | `mixed $var` | `bool` | `is_null($var)` | |
| `boolval` | Força bool. | `mixed $var` | `bool` | `boolval('1')` | |

---

## ⚙️ Observações Práticas (Validação e Filtragem)

- Prefira `filter_var` para e-mail, URL, IP, números — é **robusto** e **internacionalizado**.
- Para entradas externas, combine **sanitização + validação**.
- `preg_*` é útil, mas cuidado com regex mal formada.
- `htmlspecialchars` é obrigatório para **XSS**.
- `isset` + `empty` cobrem 80% das checagens de existência em formulários.

---


# 🔐 Filtros e Segurança

## 🔒 Escapamento de Saída (Filtros e Segurança)

| Função | Descrição | Parâmetros | Retorno | Exemplo | Observações |
|--------|-----------|-------------|---------|---------|-------------|
| `htmlspecialchars` | Escapa caracteres especiais. | `string $string` | `string` | `htmlspecialchars('<script>')` → `&lt;script&gt;` | Contra XSS. |
| `htmlentities` | Escapa todos os caracteres possíveis. | `string $string` | `string` | `htmlentities('©')` → `&copy;` | Para internacionalização. |
| `strip_tags` | Remove tags HTML/PHP. | `string $string` | `string` | `strip_tags('<b>bold</b>')` | |
| `addslashes` | Escapa aspas simples, duplas, barra invertida. | `string $string` | `string` | `addslashes("O'Reilly")` → `O\'Reilly` | Usado com cautela. |
| `mysqli_real_escape_string` | Escapa para SQL (MySQL). | `mysqli $link, string $escapestr` | `string` | `mysqli_real_escape_string($conn, $str)` | Use `prepared statements` preferencialmente. |

---

## 🔑 Hash & Criptografia (Filtros e Segurança)

| Função | Descrição | Parâmetros | Retorno | Exemplo | Observações |
|--------|-----------|-------------|---------|---------|-------------|
| `hash` | Gera hash de dados. | `string $algo, string $data` | `string` | `hash('sha256', 'abc')` | Ver lista `hash_algos()`. |
| `hash_algos` | Lista algoritmos suportados. | - | `array` | `hash_algos()` | |
| `hash_hmac` | Gera HMAC com chave. | `string $algo, string $data, string $key` | `string` | `hash_hmac('sha256', 'abc', 'secret')` | |
| `md5` | Gera hash MD5. | `string $string` | `string` | `md5('abc')` | Obsoleto para segurança real! |
| `sha1` | Gera SHA1. | `string $string` | `string` | `sha1('abc')` | Também obsoleto para senhas. |
| `openssl_encrypt` | Criptografa string. | `string $data, string $cipher_algo, string $passphrase` | `string|false` | `openssl_encrypt('abc','aes-256-cbc','pass')` | Use IVs adequados! |
| `openssl_decrypt` | Descriptografa string. | `string $data, string $cipher_algo, string $passphrase` | `string|false` | `openssl_decrypt(...)` | |
| `random_bytes` | Bytes aleatórios. | `int $length` | `string` | `random_bytes(16)` | Seguro para salt/nonce. |
| `random_int` | Int aleatório seguro. | `int $min, int $max` | `int` | `random_int(1, 100)` | |

---

## 🗝️ Senhas Seguras (Filtros e Segurança)

| Função | Descrição | Parâmetros | Retorno | Exemplo | Observações |
|--------|-----------|-------------|---------|---------|-------------|
| `password_hash` | Cria hash seguro. | `string $password, string $algo` | `string` | `password_hash('secret', PASSWORD_DEFAULT)` | Usa BCRYPT ou Argon2. |
| `password_verify` | Verifica senha. | `string $password, string $hash` | `bool` | `password_verify('secret', $hash)` | |
| `password_needs_rehash` | Verifica se hash é defasado. | `string $hash, string $algo` | `bool` | `password_needs_rehash($hash, PASSWORD_DEFAULT)` | |
| `password_get_info` | Infos do hash. | `string $hash` | `array` | `password_get_info($hash)` | |

---

## 🎲 Random Seguro (CSPRNG) (Filtros e Segurança)

| Função | Descrição | Parâmetros | Retorno | Exemplo | Observações |
|--------|-----------|-------------|---------|---------|-------------|
| `random_bytes` | Gera bytes aleatórios. | `int $length` | `string` | `bin2hex(random_bytes(16))` | |
| `random_int` | Número inteiro aleatório cripto-seguro. | `int $min, int $max` | `int` | `random_int(1, 100)` | |

---

## ⚙️ Práticas Extras (Filtros e Segurança)

| Função | Descrição | Parâmetros | Retorno | Exemplo | Observações |
|--------|-----------|-------------|---------|---------|-------------|
| `session_start` | Inicia sessão. | - | `bool` | `session_start()` | Sempre use cookies com `httponly`. |
| `setcookie` | Define cookie seguro. | `string $name, string $value` | `bool` | `setcookie('x', '1', ['httponly'=>true, 'secure'=>true])` | |
| `headers_sent` | Verifica se headers já foram enviados. | - | `bool` | `headers_sent()` | |
| `hash_equals` | Comparação segura. | `string $known, string $user` | `bool` | `hash_equals($a, $b)` | Evita ataque timing. |

---

## 🔒 Observações Fundamentais (Filtros e Segurança)

✅ Para **senha**, use `password_hash` + `password_verify` — nunca `md5` ou `sha1`.  
✅ Para tokens/session IDs, use `random_bytes` ou `random_int`.  
✅ Para SQL: **sempre prepared statements**, `mysqli` ou `PDO` com `bindParam`.  
✅ Para XSS: **sempre escape** com `htmlspecialchars`.  
✅ Para HTTPS: configure `cookies` como `secure` + `httponly`.

---

# ➗ Matemática

## ➕ Aritmética Básica (Matemática)

| Função | Descrição | Parâmetros | Retorno | Exemplo | Observações |
|--------|-----------|-------------|---------|---------|-------------|
| `abs` | Valor absoluto. | `number $num` | `int|float` | `abs(-5)` → `5` | |
| `min` | Retorna menor valor. | `mixed ...$values` | `number` | `min(1,2,3)` → `1` | Aceita array. |
| `max` | Retorna maior valor. | `mixed ...$values` | `number` | `max(1,2,3)` → `3` | |
| `intdiv` | Divisão inteira. | `int $num1, int $num2` | `int` | `intdiv(10,3)` → `3` | Sem resto. |
| `fmod` | Resto com float. | `float $num1, float $num2` | `float` | `fmod(5.7, 1.3)` | |
| `%` | Operador módulo. | `int $a % int $b` | `int` | `10 % 3` → `1` | Não é função, mas é base. |

---

## 🔢 Arredondamento & Precisão (Matemática)

| Função | Descrição | Parâmetros | Retorno | Exemplo | Observações |
|--------|-----------|-------------|---------|---------|-------------|
| `round` | Arredonda valor. | `float $num, int $precision = 0` | `float` | `round(3.14159, 2)` → `3.14` | |
| `floor` | Arredonda para baixo. | `float $num` | `float` | `floor(3.9)` → `3.0` | |
| `ceil` | Arredonda para cima. | `float $num` | `float` | `ceil(3.1)` → `4.0` | |
| `number_format` | Formata número. | `float $num, int $decimals` | `string` | `number_format(1234.567, 2)` → `'1,234.57'` | Para output amigável. |

---

## 📐 Trigonometria (Matemática)

| Função | Descrição | Parâmetros | Retorno | Exemplo | Observações |
|--------|-----------|-------------|---------|---------|-------------|
| `sin` | Seno. | `float $num` | `float` | `sin(pi()/2)` → `1` | |
| `cos` | Cosseno. | `float $num` | `float` | `cos(0)` → `1` | |
| `tan` | Tangente. | `float $num` | `float` | `tan(0)` → `0` | |
| `asin` | Arco seno. | `float $num` | `float` | `asin(1)` → `1.5708` | |
| `acos` | Arco cosseno. | `float $num` | `float` | `acos(1)` → `0` | |
| `atan` | Arco tangente. | `float $num` | `float` | `atan(1)` → `0.785` | |
| `atan2` | Arco tangente 2D. | `float $y, float $x` | `float` | `atan2(1,1)` → `0.785` | |
| `deg2rad` | Graus → radianos. | `float $degrees` | `float` | `deg2rad(180)` → `3.1415` | |
| `rad2deg` | Radianos → graus. | `float $radians` | `float` | `rad2deg(pi())` → `180` | |

---

## 📈 Exponenciais, Log & Potência (Matemática)

| Função | Descrição | Parâmetros | Retorno | Exemplo | Observações |
|--------|-----------|-------------|---------|---------|-------------|
| `pow` | Potência. | `number $base, number $exp` | `number` | `pow(2,3)` → `8` | |
| `exp` | Exponencial e^x. | `float $num` | `float` | `exp(1)` → `2.7182` | |
| `log` | Logaritmo natural. | `float $num` | `float` | `log(2.7182)` → `~1` | |
| `log10` | Log base 10. | `float $num` | `float` | `log10(100)` → `2` | |
| `sqrt` | Raiz quadrada. | `float $num` | `float` | `sqrt(16)` → `4` | |
| `hypot` | Hipotenusa. | `float $x, float $y` | `float` | `hypot(3,4)` → `5` | Pitágoras. |

---

## 🎲 Random Clássico & CSPRNG (Matemática)

| Função | Descrição | Parâmetros | Retorno | Exemplo | Observações |
|--------|-----------|-------------|---------|---------|-------------|
| `rand` | Inteiro aleatório. | `int $min, int $max` | `int` | `rand(1,10)` | |
| `mt_rand` | Mersenne Twister aleatório. | `int $min, int $max` | `int` | `mt_rand(1,10)` | Melhor que `rand`. |
| `random_int` | Int aleatório CSPRNG. | `int $min, int $max` | `int` | `random_int(1,100)` | Para segurança. |
| `random_bytes` | Bytes aleatórios CSPRNG. | `int $length` | `string` | `random_bytes(8)` | Salt, nonce. |

---

## ⚙️ Funções Especiais (Matemática)

| Função | Descrição | Parâmetros | Retorno | Exemplo | Observações |
|--------|-----------|-------------|---------|---------|-------------|
| `pi` | Retorna π. | - | `float` | `pi()` → `3.14159265` | |
| `deg2rad` | Graus → radianos. | `float $degrees` | `float` | `deg2rad(90)` | |
| `rad2deg` | Radianos → graus. | `float $radians` | `float` | `rad2deg(pi()/2)` | |

---

## 📌 Boas Práticas Matemáticas (Matemática)

✅ Prefira `random_int`/`random_bytes` em vez de `rand` para **segurança**.  
✅ Use `number_format` para **saída legível** de valores financeiros.  
✅ Para trigonometria, sempre converta **graus ↔ radianos** corretamente.  
✅ Para operações financeiras: combine **rounding** consistente (`bc*` extensions, se necessário).

---

# 🛠 Outras Utilidades 

## ⚙️ Sistema & Execução (Outras Utilidades )

| Função | Descrição | Parâmetros | Retorno | Exemplo | Observações |
|--------|-----------|-------------|---------|---------|-------------|
| `exec` | Executa comando shell. | `string $command` | `string` | `exec('ls -la')` | ⚠️ Use com cuidado. |
| `system` | Executa comando e exibe output. | `string $command` | `string` | `system('whoami')` | |
| `passthru` | Executa comando e passa output raw. | `string $command` | `void` | `passthru('ls')` | |
| `sleep` | Pausa execução. | `int $seconds` | `int` | `sleep(1)` | |
| `time` | Timestamp Unix atual. | - | `int` | `time()` | |
| `microtime` | Microsegundos. | `bool $as_float = false` | `string|float` | `microtime(true)` | |
| `memory_get_usage` | Memória usada. | - | `int` | `memory_get_usage()` | Bytes. |
| `getcwd` | Diretório atual. | - | `string` | `getcwd()` | |
| `chdir` | Muda diretório atual. | `string $directory` | `bool` | `chdir('/tmp')` | |

---

## 📂 Inclusão de Arquivo (Outras Utilidades )

| Função | Descrição | Parâmetros | Retorno | Exemplo | Observações |
|--------|-----------|-------------|---------|---------|-------------|
| `include` | Inclui script. | `string $filename` | `mixed` | `include 'config.php'` | Continua se falhar (warning). |
| `require` | Inclui script obrigatório. | `string $filename` | `mixed` | `require 'config.php'` | FATAL se falhar. |
| `include_once` | Inclui uma vez. | `string $filename` | `mixed` | `include_once 'config.php'` | |
| `require_once` | Idem `require`, mas só uma vez. | `string $filename` | `mixed` | `require_once 'config.php'` | |

---

## 🐞 Erros & Debug (Outras Utilidades )

| Função | Descrição | Parâmetros | Retorno | Exemplo | Observações |
|--------|-----------|-------------|---------|---------|-------------|
| `error_log` | Registra log de erro. | `string $message` | `bool` | `error_log('Erro crítico')` | |
| `trigger_error` | Dispara erro custom. | `string $message, int $error_type` | `bool` | `trigger_error('Ops!', E_USER_WARNING)` | |
| `debug_backtrace` | Pilha de execução. | - | `array` | `debug_backtrace()` | |
| `var_dump` | Dump variável. | `mixed $expression` | `void` | `var_dump($arr)` | |
| `print_r` | Imprime estrutura. | `mixed $expression` | `mixed` | `print_r($arr)` | |
| `var_export` | Exporta string representativa. | `mixed $expression` | `string` | `var_export($arr)` | |

---

## 🧩 Variáveis & Manipulação (Outras Utilidades )

| Função | Descrição | Parâmetros | Retorno | Exemplo | Observações |
|--------|-----------|-------------|---------|---------|-------------|
| `isset` | Existe e não null? | `mixed $var` | `bool` | `isset($_POST['x'])` | |
| `empty` | Vazia? | `mixed $var` | `bool` | `empty($arr)` | |
| `unset` | Destroi variável. | `mixed &$var` | `void` | `unset($x)` | |
| `eval` | Executa código PHP. | `string $code` | `mixed` | `eval('$x=1;')` | ⚠️ Usar com EXTREMA cautela. |
| `serialize` | Serializa variável. | `mixed $value` | `string` | `serialize($arr)` | |
| `unserialize` | Reverte serialize. | `string $string` | `mixed` | `unserialize($s)` | |
| `gettype` | Tipo da variável. | `mixed $var` | `string` | `gettype(10)` → `integer` | |
| `settype` | Força tipo. | `mixed &$var, string $type` | `bool` | `settype($x, 'string')` | |

---

## 🌐 Ambiente & Outras (Outras Utilidades )

| Função | Descrição | Parâmetros | Retorno | Exemplo | Observações |
|--------|-----------|-------------|---------|---------|-------------|
| `phpversion` | Versão do PHP. | - | `string` | `phpversion()` | |
| `phpinfo` | Info completa do PHP. | - | `bool` | `phpinfo()` | |
| `getenv` | Lê variável ambiente. | `string $varname` | `string|false` | `getenv('PATH')` | |
| `putenv` | Define variável env. | `string $assignment` | `bool` | `putenv('FOO=bar')` | |
| `die` ou `exit` | Termina script. | `string|int` | `void` | `exit('Bye')` | |

---

## ✅ Boas Práticas (Outras Utilidades )

- ⚠️ **`exec`, `system`, `passthru`, `eval`**: usar com **validação extrema**.
- Prefira **`require_once`** para configs e scripts **core**.
- Para debug, **`var_dump` + `debug_backtrace`** ajudam a rastrear bugs complexos.
- Mantenha **logs controlados** com `error_log` — nunca exponha dados sensíveis.
- `phpinfo` é ótimo para dev, mas **não deixe em produção**.

---

# ⚙️ Observações Finais

- Este arquivo é **dinâmico**: expanda com suas funções mais usadas.
- Consulte [PHP Manual](https://www.php.net/manual/pt_BR/) para detalhes avançados.
- Mantenha sempre atualizado conforme novas versões do PHP.

---
