<div class="p-2">
    {!! $posts->links() !!}
</div>

@php
    $i = 0;
@endphp

@forelse($posts as $post)
    @if ($i == 0)
        <div class="flex justify-between flex-wrap">
    @endif

    @include('post.post_v_card_item')

    @if ($i == 3)
        </div>
    @endif

    @php
        $i++;

        if ($i == 4) {
            $i = 0;
        }

    @endphp


@empty
    <p>No Posts</p>
@endforelse


<div class="p-2">
    {!! $posts->links() !!}
</div>
