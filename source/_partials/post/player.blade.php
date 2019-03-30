<section class="player-card">
    <audio class="player-card__player" controls preload="none">
        <source src="{{ $page->audioUrl }}">
    </audio>

    <p class="player-card__subscribe">
        Podcast:
        <a title="Reproduzir em uma nova janela" href="{{ $page->audioUrl }}" class="link player-card__subscribe-link" target="_blank">
            Reproduzir em uma nova janela
        </a> |
        <a title="Baixar" href="{{ $page->audioUrl }}" class="link player-card__subscribe-link">
            Baixar
        </a>
    </p>
</section>

