<h5 class="mb-3">Cadastrar</h5>
<form action="{{route ('user.register')}}" method="post">
    @csrf <!-- token de seguranca do laravel -->
    <input name = "name" type="text" class="form-control mb-2" placeholder="Nome">
    <input name = "username" type="text" class="form-control mb-2" placeholder="Nome">
    <input name = "email" type="text" class="form-control mb-2" placeholder="Email">
    <input name = "password" type="text" class="form-control mb-2" placeholder="Senha">
    <button class = "btn btn-sucess w-100">Registrar</button>
</form>