resources/views/vendor/pagination/bootstrap-4.blade.php

@if ($paginator->hasPages())
    <?php
    $items_count = 3;
    $show_first_item = false;
    $show_last_item = false;

    $limit_start= 1;
    $limit_end= 1;
    //   echo 'var_dump($elements)::' . ( var_dump($elements) ) . "<br>";
    //   echo 'count($elements)::' . ( count($elements[0]) ) . "<br>";
    if (count($elements[0]) > $items_count*2) {
        $limit_start= $paginator->currentPage() - 1;
        $limit_end= $limit_start + 2;
    }

    if($paginator->currentPage() >= $items_count) {
        $show_first_item= true;
    }
    if($paginator->lastPage() > $paginator->currentPage() + 1) {
        $show_last_item= true;
    }
    //   echo '$limit_start::' . $limit_start."<br>";
    //   echo '<b>$paginator->currentPage()</b>::' . $paginator->currentPage()."<br>";
    //   echo '<b>$paginator->lastPage()</b>::' . $paginator->lastPage()."<br>";
    //   echo '$limit_end::' . $limit_end."<br>";
    //
    //
    //   echo '$show_first_item::' . $show_first_item."<br>";
    //   echo '$show_last_item::' . $show_last_item."<br>";
    ?>
    <div class="forum-article__comments-pagination pagination">

        @if (!$paginator->onFirstPage())
            <a href="{{ $paginator->previousPageUrl() }}" class="pagination__nav pagination__nav--prev">
                <span>Предыдущая</span>
                <svg viewBox="0 0 19 8" xmlns="http://www.w3.org/2000/svg">
                    <path d="M18.3536 4.35355C18.5488 4.15829 18.5488 3.84171 18.3536 3.64645L15.1716 0.464467C14.9763 0.269205 14.6597 0.269205 14.4645 0.464467C14.2692 0.65973 14.2692 0.976312 14.4645 1.17157L17.2929 4L14.4645 6.82843C14.2692 7.02369 14.2692 7.34027 14.4645 7.53554C14.6597 7.7308 14.9763 7.7308 15.1716 7.53554L18.3536 4.35355ZM-4.37114e-08 4.5L18 4.5L18 3.5L4.37114e-08 3.5L-4.37114e-08 4.5Z"></path>
                </svg>
            </a>
        @endif

        <ul class="pagination__list">


            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <li class="disabled"><span class="">{{ $element }}</span></li>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))

                    @foreach ($element as $page => $url)

                        @if($show_first_item and $page == 1)
                            <li class=""><a class="" href="{{ $url }}">{{ $page }}</a></li>
                            @if($paginator->currentPage()!= 3)
                                <li class="disabled"><a class="">...</a></li>
                            @endif
                        @endif

                        @if($page >= $limit_start and $page <= $limit_end)
                            @if ($page == $paginator->currentPage())
                                <li class="active"><a href=""><span class="">{{ $page }}</span></a></li>
                            @else
                                <li class=""><a class="" href="{{ $url }}">{{ $page }}</a></li>
                            @endif
                        @endif

                        @if($show_last_item and $page == $paginator->lastPage())
                            @if($paginator->currentPage()!= $paginator->lastPage()-2)
                                <li class="disabled"><a class="">...</a></li>
                            @endif
                            <li class=""><a class="" href="{{ $url }}">{{ $page }}</a></li>
                        @endif

                    @endforeach

                @endif
            @endforeach
        </ul>


        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" class="pagination__nav pagination__nav--next">
                <span>Следующая</span>
                <svg viewBox="0 0 19 8" xmlns="http://www.w3.org/2000/svg">
                    <path d="M18.3536 4.35355C18.5488 4.15829 18.5488 3.84171 18.3536 3.64645L15.1716 0.464467C14.9763 0.269205 14.6597 0.269205 14.4645 0.464467C14.2692 0.65973 14.2692 0.976312 14.4645 1.17157L17.2929 4L14.4645 6.82843C14.2692 7.02369 14.2692 7.34027 14.4645 7.53554C14.6597 7.7308 14.9763 7.7308 15.1716 7.53554L18.3536 4.35355ZM-4.37114e-08 4.5L18 4.5L18 3.5L4.37114e-08 3.5L-4.37114e-08 4.5Z"></path>
                </svg>
            </a>
        @endif

    </div>

@endif
