<h5 class="mb-3">Entrar</h5>
<form action="{{route ('user.login')}}" method="post">
    @csrf
    <input type="text" class="form-control mb-2" placeholder="Username" name="username">
    <input type="password" class="form-control mb-2" placeholder="Senha" name="password">
    <button class="btn btn-primary w-100">Acessar</button>
</form>