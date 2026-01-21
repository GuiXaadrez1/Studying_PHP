<?php

namespace App\Http\Controllers;

// Com esse devemos criar toda a lógica para lidar com requisições HTTP
// importando Validator e etc...
use Illuminate\Http\Request;

// Class responsável por representar o usuário dentro da estrutura padrão do laravel
use Illuminate\Support\Facades\Auth;

/* Para captar os dados vindo da nossa Custom Request */
// Com esse o validator já vem aplicado automaticamente, pois é embutido na logica
// de validacao do custom request
use App\Http\Requests\RegisterUserRequest;

// Vamos passar nossa class Repository por DI (Depedêncy Injection)

use App\Repositories\Contracts\UserRepositoryInterface;

// use App\Repositories\User\UserRepository;

// Class ao qual aplicamos o Resource para filtragem de campos retornados do banco de dados
use App\Http\Resources\UserAccountResource;

class UserController extends Controller
{

    // bind manual, passagem de objeto por composição (acoplamento forte)
    // private UserRepository $userRepository;

    // criando um atributo para conter 
    private UserRepositoryInterface $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        // materializnado o objeto repository por composição manual 
        // $this->userRepository = new UserRepository();


        // após ter feito o bind em AppProvidersService no metodo register
        // temos polimorfismo real entre o contrato e a class 
        $this->userRepository = $userRepository;
    }

    public function register(RegisterUserRequest $request){
        
        // fazendo teste
        // perceba que rescebemos um token crf específic do laravel
        // lembrando que os dados enviados devem seguir a ordem da coluna
        // caso nao siga as ordem das colunas do banco de dados, podemos
        // ter erros de integridade referencial
        // com isso, reordene ou acesse por index do array associativo
        // dd($request->all());


        // Esse dd() é o que estamos usando o custom requests
        //dd($request->validated());

        // fazendo um copy-on-write dos dados validados
        // tanto form como request apontam para o mesmo local na memória
        $form = $request->validated();

        //dd($form);

        if(!$this->userRepository->create($form)){
            
            // vamos fazer um redirecionamento

            return redirect()->back()->withErrors([
                'Houve um erro ao criar o usuário. Por favor, tente novamente.'
            ]);

            // redirect -> redireciona para alguma lugar
            // back -> redireciona para o mesmo lugar
            // withErrors -> se acontecer algum erro devolva essa mensagem
        };

        // se deu certo, vamos fazer a mesma coisa, a diferença é que vamos enviar uma mensagem de sucesso

        return redirect()->back()->with('sucess','Usuário criado com sucesso!');

    }

    public function index(Request $request){


        $userResource = new UserAccountResource(
            $this->userRepository->find(
                Auth::user()->id
            )
        );

        return view('user.account',[
            // esse user é a variável que pode ser acessada pelo nosso view usando {{}}
            // com basse nessa variável podemos puxar os dados qeu estao em suas 
            // respectivas chabes, exemplo: {{$user['name']}}
            'user' => $userResource->toArray(request())
        ]);
    }

    public function update(){

        $userId = Auth::user()->id;
        
        return null;
    }

    public function updatePassword(){
        
        return null;
    }

    public function updatePhoto(){
        
        return null;
    }

}
