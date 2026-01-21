<!-- Card Post -->
<div class="card card-post shadow-sm">
    <div class="position-relative">
        <img id="imagem-post" src="{{ $book['cover'] }}" class="w-100" alt="The Witcher">
        <button class="icon-btn edit-icon"
            onclick="abrirModalImagem(
            '{{ $book['cover'] }}', 
            '{{ route('book.update.photo', $book['id']) }}')
            ">
            <i class="bi bi-pencil-square"></i>
        </button>
    </div>
    <div class="p-3">
        <h5 class="mb-1">{{ $book['title'] }}</h5>
        <small class="text-muted">{{ $book['author'] }} - {{ $book['category_name'] }}<br>Publicado em:
            {{ $book['created_at'] }}</small>
        <p class="mt-2 mb-3">{{ $book['description'] }}</p>
        <div class="d-flex align-items-center justify-content-between">
            <div>
                <i class="bi {{ $book['favorite'] ? 'bi-hand-thumbs-up' : 'bi-hand-thumbs-down' }}"></i>
                {{ $book['favorite'] ? 'Gostou' : 'Não gostou' }}

                <span class="ms-3">
                    <i class="bi {{ $book['complete'] ? 'bi-check2-circle' : 'bi-x-circle' }}"></i>
                    {{ $book['complete'] ? 'Finalizado' : 'Não finalizado' }}
                </span>
            </div>

            <div class="text-warning">
                @for ($i = 1; $i <= 5; $i++)
                    {{ $i <= $book['stars'] ? '★' : '☆' }}
                @endfor
            </div>
        </div>
        <div class="text-center mt-3">
            <button class="btn btn-secondary btn-sm" onclick="abrirModalEdicao(this)" data-id="{{ $book['id'] }}"
                data-title="{{ $book['title'] }}" data-author="{{ $book['author'] }}"
                data-description="{{ $book['description'] }}" data-complete="{{ $book['complete'] }}"
                data-favorite="{{ $book['favorite'] }}" data-stars="{{ $book['stars'] }}"
                data-action="{{ route('book.update', $book['id']) }}">
                Editar
            </button>

            <a class="btn btn-danger btn-sm" onclick="return confirm('Deseja realmente remover a postagem?')"
                href="{{ route('book.delete', $book['id']) }}">
                Remover
            </a>
        </div>
    </div>
</div>

<!-- Modal Alterar Imagem -->
<div class="modal fade" id="modalImagem" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form action="" method="post" id="frmUpdatePhoto" enctype="multipart/form-data">
                @csrf
                @method('patch')
                <div class="modal-header">
                    <h5 class="modal-title">Alterar Imagem</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
                </div>
                <div class="modal-body">
                    <img id="previewImagem" src="" class="img-fluid mb-3" alt="Preview">
                    <input type="file" id="cover" name="cover" accept="image/*" class="form-control">
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Salvar</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Editar Livro -->
<div class="modal fade" id="modalEdicao" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" action="">
                @csrf
                @method('put')
                <div class="modal-header">
                    <h5 class="modal-title">Editar Livro</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
                </div>
                <div class="modal-body">
                    <input type="text" name="title" class="form-control mb-2" placeholder="Título"
                        value="The Witcher">
                    <input type="text" name="author" class="form-control mb-2" placeholder="Autor"
                        value="Fulano de tal">
                    <textarea name="description" class="form-control mb-2" rows="3">Lorem Ipsum is simply dummy text...</textarea>
                    <div class="d-flex align-items-center gap-3 mb-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="edit-completo" name="complete" checked>
                            <label class="form-check-label" for="edit-completo">Completou</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="edit-favorito" name="favorite">
                            <label class="form-check-label" for="edit-favorito">Favorito</label>
                        </div>
                        <label class="ms-auto me-1 mb-0">Estrelas</label>
                        <input type="number" name="stars" class="form-control" value="4"
                            style="width: 60px;">
                    </div>
                </div>
                <div class="modal-footer d-flex justify-content-between">
                    <div>
                        <button type="submit" class="btn btn-primary">Salvar</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function abrirModalImagem(imagemAtual, postURL) {
        document.getElementById('previewImagem').src = imagemAtual;
        document.querySelector('#frmUpdatePhoto').action = postURL;
        const modal = new bootstrap.Modal(document.getElementById('modalImagem'));
        modal.show();
    }

    function trocarImagem() {
        const novaUrl = document.getElementById('novaImagemUrl').value;
        document.getElementById('imagem-post').src = novaUrl;
        bootstrap.Modal.getInstance(document.getElementById('modalImagem')).hide();
    }

    function abrirModalEdicao(botao) {
        const modal = document.getElementById('modalEdicao');

        modal.querySelector('[name="title"]').value = botao.dataset.title;
        modal.querySelector('[name="author"]').value = botao.dataset.author;
        modal.querySelector('[name="description"]').value = botao.dataset.description;
        modal.querySelector('[name="complete"]').checked = botao.dataset.complete === '1';
        modal.querySelector('[name="favorite"]').checked = botao.dataset.favorite === '1';
        modal.querySelector('[name="stars"]').value = botao.dataset.stars;
        modal.querySelector('form').action = botao.dataset.action;

        new bootstrap.Modal(modal).show();
    }
</script>