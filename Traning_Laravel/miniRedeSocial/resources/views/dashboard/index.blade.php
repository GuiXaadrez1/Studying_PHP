@extends('partials.body')

@section('title', 'Bem-vindo de volta')

@section('body')
    <!-- Form -->
    <div class="card p-3 mb-4">
        <form method="POST" action="{{ route('book.store') }}" enctype="multipart/form-data">
            @csrf
            <label class="mb-2">O que você está lendo?</label>
            <div class="d-flex gap-2 mb-2">
                <input type="text" class="form-control" placeholder="Título" name="title">
                <input type="text" class="form-control" placeholder="Autor" name="author">
            </div>

            <div class="d-flex gap-3 mb-3">
                <!-- Div da imagem - 50% -->
                <div class="w-50">
                    <label for="cover" class="form-label">Imagem</label><br>
                    <label for="cover" class="btn btn-outline-primary w-100">Selecionar imagem</label>
                    <input id="cover" name="cover" style="display:none;" type="file">
                </div>

                <!-- Div do select - 50% -->
                <div class="w-50">
                    <label for="category_id" class="form-label">Gênero</label>
                    <select name="category_id" id="category_id" class="form-control">
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <textarea class="form-control mb-2" rows="3" placeholder="Observações" name="description"></textarea>
            <div class="d-flex align-items-center gap-3 mb-2">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="completo" name="complete">
                    <label class="form-check-label" for="completo">Completou</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="favorito" name="favorite">
                    <label class="form-check-label" for="favorito">Favoritar</label>
                </div>
                <label class="ms-auto me-1 mb-0">Estrelas</label>
                <input type="number" class="form-control" value="5" style="width: 60px;" min="1" max="5"
                    name="stars">
            </div>

            <div>
                @include('partials.alerts')
            </div>

            <button class="btn btn-success">Postar</button>
        </form>
    </div>

    <div>
        @foreach ($books as $book)
            <div class="mt-3">
                @include('dashboard.card', ['book' => $book])
            </div>
        @endforeach

        <div class="books-link mt-5">
            {{ $paginator->links('pagination::bootstrap-4') }}
        </div>
    </div>
@endsection