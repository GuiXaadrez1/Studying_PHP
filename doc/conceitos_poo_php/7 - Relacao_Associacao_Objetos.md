# ASSOCIAÇÃO ENTRE OBJETOS

Associação é uma relação estrutural fraca entre objetos, na qual:

- Um objeto conhece outro objeto

- Não há dependência de ciclo de vida

- Os objetos existem de forma independente

- A relação pode ser temporária ou permanente

- Em termos de engenharia de software, associação indica colaboração, não pertencimento.

### Formalmente:

"Dado dois objetos A e B, existe associação se A mantém uma referência lógica para B, mas não controla sua existência."

## Características formais da Associação

| Aspecto                | Associação    |
| ---------------------- | ------------- |
| Dependência de vida    | ❌ Não         |
| Controle de criação    | ❌ Não         |
| Controle de destruição | ❌ Não         |
| Reuso                  | ✅ Alto        |
| Acoplamento            | Baixo a médio |
| Cardinalidade          | 1–1, 1–N, N–N |

## Representação conceitual (UML):

```bash
Professor --------> Disciplina
```

A seta indica navegabilidade
Não há losango (diamante)

## Associação em PHP (forma canônica)

Exemplo: Professor e Disciplina

```php
<?ph
    // definindo a class Disciplina
    class Disciplina
    {   
        // definindo metodo construtor bem como os atributos, propriedades que devem
        // inicializar inicialmente ao instanciar a class
        public function __construct(
            private string $nome
        ) {}

        // getter
        public function getNome(): string
        {
            return $this->nome;
        }
    }

    // definido class Professor ao qual vamos fazer a associacao

    class Professor
    {
        // definindo uma propriedade que rescebe uma isntância da class Disciplina
        private Disciplina $disciplina;

        // Setando e Materializando uma class disciplina no metodo setter
        public function setDisciplina(Disciplina $disciplina): void
        {
            $this->disciplina = $disciplina;
        }

        // pegando o objeto disciplina da da class Professor ao ser definida pelo Set
        public function getDisciplina(): Disciplina
        {
            return $this->disciplina;
        }
    }

    // Exemplo de uso!

    $disciplina = new Disciplina("POO Avançada");
    $professor = new Professor();

    $professor->setDisciplina($disciplina);

?>
```

- Professor não cria Disciplina

- Disciplina pode existir sem Professor

- O vínculo pode ser removido sem destruir objetos

- Isso é associação pura.

## Associação por injeção de dependência (lembre-se que esse conceito esta ligado diretamente com IoC - inversão de controle)

Essa é a forma mais madura de associação:

```php
<?php
class Professor
{
    public function __construct(
        private Disciplina $disciplina
    ) {}
}
?>
```

📌 Observação importante

Mesmo passando no construtor, continua sendo associação, pois o objeto não é dono da instância.

## Tipos de associação

- Associação unidirecional: A conhece B, B não conhece A.

- Associação bidirecional: Ambos se conhecem (cuidado com acoplamento).

- Associação N–N: Muito comum em sistemas reais (ex: aluno ↔ disciplinas).