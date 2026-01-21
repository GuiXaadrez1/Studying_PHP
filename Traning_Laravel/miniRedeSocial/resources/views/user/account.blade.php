@extends('partials.body')

@section('title', 'Alterar dados cadastrais')

@section('header')
    <style>
        .max-container {
            max-width: 600px;
        }

        .profile-img {
            width: 100px;
            height: 100px;
            object-fit: cover;
            border-radius: 50%;
            border: 2px solid #000;
        }
    </style>
@endsection

@section('body')
    <div class="container py-4 max-container">

        <div>
            @include('partials.alerts')
        </div>

        <!-- Form dados -->
        <div class="card border-danger mb-4">
            <div class="card-body">
                <h5 class="card-title">Dados cadastrais</h5>
                <form method="post" action="{{ route('user.update') }}">
                    @method('put')
                    @csrf

                    <input type="text" name="name" class="form-control mb-2" placeholder="Nome"
                        value="{{ $user['name'] }}">
                    <textarea name="bio" rows="3" class="form-control mb-3" placeholder="Bio">{{ $user['bio'] }}</textarea>
                    <button type="submit" class="btn btn-success">Salvar</button>
                </form>
            </div>
        </div>

        <!-- Form senha -->
        <div class="card border-danger mb-4">
            <div class="card-body">
                <h6 class="card-title">Alterar senha</h6>

                <form id="formSenha" onsubmit="return validarSenha()" method="post"
                    action="{{ route('user.update.password') }}">
                    @method('patch')
                    @csrf

                    <div class="d-flex gap-2 mb-2">
                        <input type="password" name="password" id="novaSenha" class="form-control"
                            placeholder="Digite a nova senha">
                        <input type="password" id="confirmarSenha" class="form-control" placeholder="Confirmar senha">
                        <button type="submit" class="btn btn-success">Alterar</button>
                    </div>
                    <div id="alertaSenha" class="alert alert-danger d-none" role="alert"></div>
                </form>

                <p class="alert alert-warning">Após alterar a sua senha, você será desconectado.</p>
            </div>
        </div>

        <script>
            function validarSenha() {
                const senha = document.getElementById('novaSenha').value.trim();
                const confirmar = document.getElementById('confirmarSenha').value.trim();
                const alerta = document.getElementById('alertaSenha');

                if (senha.length < 7) {
                    alerta.textContent = "A senha deve ter pelo menos 7 caracteres.";
                    alerta.classList.remove("d-none");
                    return false;
                }

                if (!senha || !confirmar) {
                    alerta.textContent = "Preencha ambos os campos.";
                    alerta.classList.remove("d-none");
                    return false;
                }

                if (senha !== confirmar) {
                    alerta.textContent = "As senhas não coincidem.";
                    alerta.classList.remove("d-none");
                    return false;
                }

                alerta.classList.add("d-none");
                return true;
            }
        </script>

        <!-- Form photo -->
        <div class="card border-danger mb-4">
            <div class="card-body">
                <h6 class="card-title">Alterar imagem (250x250)</h6>
                <form method="POST" action="{{ route('user.update.photo') }}" enctype="multipart/form-data">
                    @method('patch')
                    @csrf

                    <div class="d-flex gap-2 mb-3">
                        <input type="file" class="form-control" id="photoInput" name="photo" accept="image/*">
                        <button type="submit" class="btn btn-success">Alterar</button>
                    </div>

                    <div class="d-flex justify-content-around">
                        <div class="text-center">
                            <img src="{{ $user['photo'] }}" class="profile-img" id="fotoAtual">
                            <div class="mt-2">Atual</div>
                        </div>
                        <div class="text-center">
                            <img src="" class="profile-img" id="fotoNova">
                            <div class="mt-2">Nova</div>
                        </div>
                    </div>
                </form>
            </div>
        </div>

    </div>
@endsection

@section('footer')
    <script>
        document.getElementById('photoInput').addEventListener('change', function() {
            const input = this;
            const preview = document.getElementById('fotoNova');
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                };
                reader.readAsDataURL(input.files[0]);
            }
        });
    </script>
@endsection