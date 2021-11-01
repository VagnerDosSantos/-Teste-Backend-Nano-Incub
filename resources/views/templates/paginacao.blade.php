@php
$ultimaPagina = $paginator->lastPage();
@endphp
<div class="row rowPagination">
    <div class="col s12 center-align">
        <ul class="pagination">
            <li>
                <a href="{{ $paginator->previousPageUrl() }}">
                    <i class="material-icons">chevron_left</i>
                </a>
            </li>

            @if ($paginator->currentPage() > 3)
                <li>
                    <a href="{{ $paginator->url(1) }}">{{ 1 }}</a>
                </li>
            @endif

            @if ($paginator->currentPage() > 4)
                <li><span>...</span></li>
            @endif

            @foreach (range(1, $paginator->lastPage()) as $i)
                @if ($i >= $paginator->currentPage() - 2 && $i <= $paginator->currentPage() + 2)
                    @if ($i == $paginator->currentPage())
                        <li class="@php echo ($paginator->currentPage() == $i) ? 'active blue accent-4' : '' @endphp">
                            <a href="{{ $paginator->url($i) }}">{{ $i }}</a>
                        </li>
                    @else
                        <li><a href="{{ $paginator->url($i) }}">{{ $i }}</a></li>
                    @endif
                @endif
            @endforeach

            @if ($paginator->currentPage() < $paginator->lastPage() - 3)
                <li class="disabled"><span>...</span></li>
            @endif

            @if ($paginator->currentPage() < $paginator->lastPage() - 2)
                <li>
                    <a href="{{ $paginator->url($paginator->lastPage()) }}">
                        {{ $paginator->lastPage() }}
                    </a>
                </li>
            @endif

            <li class="waves-effect">
                <a href="{{ $paginator->nextPageUrl() }}">
                    <i class="material-icons">chevron_right</i>
                </a>
            </li>
        </ul>
    </div>
</div>
