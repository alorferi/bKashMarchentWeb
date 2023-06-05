<x-admin-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Otcs') }}
        </h2>
    </x-slot>


    <div class="p-2">
        {!! $otcs->links() !!}
    </div>

    @foreach ($otcs as $item)
        <div class="row">
            <div class="col-sm-2">
                {{ $item->username }}
                <br>
                {{ $item->otcType->name }}
            </div>

            <div class="col-sm-2">
                {{ $item->ot_code }}
            </div>

            <div class="col-sm-4">

                Sent at: {{ $item->sent_at ? $item->sent_at->diffForHumans() : 'None' }}
                <br>
                @if ($item->verified_at)
                    @if ($item->sent_at)
                        Verified Delay: {{ $item->sent_at->diff($item->verified_at)->format('%h:%i:%s') }}
                    @endif
                    <br> Verified Time : {{ $item->verified_at->diffForHumans() }}
                @else
                    None
                @endif

            </div>

            <div class="col-sm-4">
                Expired at: {{ $item->expired_at }} <br>
                ({{ $item->expired_at ? $item->expired_at->diffForHumans() : 'None' }})
            </div>

        </div>
        <br>
    @endforeach

    <div class="p-2">
        {!! $otcs->links() !!}
    </div>

</x-admin-layout>
