@props(['visibility' => true])

@if ($visibility)
    <div class="my-2 overflow-hidden rounded shadow-sm">
        <div class="flex px-2 py-1">
            <div class="flex-1">
                {{ $label }}:&nbsp;
            </div>
            <div class="flex-none font-bold text-right text-gray-700">
                {{ $slot }}
            </div>
        </div>
    </div>
@endif
