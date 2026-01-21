<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Social Books</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: #f0f2f5;
            font-family: 'Segoe UI', sans-serif;
            min-height: 100vh;
        }

        .logo {
            font-size: 2.5rem;
            font-weight: bold;
            color: #5c47d1;
        }

        .search-form input {
            border-radius: 30px 0 0 30px;
        }

        .search-form button {
            border-radius: 0 30px 30px 0;
        }

        .card-custom {
            border-radius: 16px;
            box-shadow: 0 0 30px rgba(0, 0, 0, 0.05);
            min-height: 320px;
        }

        .fixed-side {
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }
    </style>
</head>

<body>
    <div class="container-fluid vh-100 d-flex align-items-center">
        <div class="container">
            <div class="row align-items-center justify-content-between">
                <!-- Lado Esquerdo Fixo -->
                <div class="col-md-6 fixed-side">
                    <div>
                        <div class="logo mb-3">Social Books</div>
                        <form class="search-form d-flex" onsubmit="event.preventDefault()">
                            <input type="text" class="form-control" placeholder="@nomeusuario">
                            <button class="btn btn-primary px-4">Buscar</button>
                        </form>
                    </div>
                </div>

                <!-- Lado Direito com abas -->
                <div class="col-md-5">
                    <div class="card card-custom p-4">
                        <ul class="nav nav-tabs mb-3" id="formTabs" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="login-tab" data-bs-toggle="tab"
                                    data-bs-target="#login" type="button" role="tab">Entrar</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="signup-tab" data-bs-toggle="tab" data-bs-target="#signup"
                                    type="button" role="tab">Cadastrar</button>
                            </li>
                        </ul>
                        <div class="tab-content" id="formTabsContent">
                            <div class="tab-pane fade show active" id="login" role="tabpanel">
                                @include('home.login')
                            </div>
                            <div class="tab-pane fade" id="signup" role="tabpanel">
                                @include('home.register')
                            </div>
                        </div>

                        <!-- Espaço para mensagens de erro -->
                        <div>
                            @include('partials.alerts')
                        </div>
                    </div>
                </div>
                <!-- Fim col-md-5 -->
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>