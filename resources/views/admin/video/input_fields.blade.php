
<!-- Email Address -->
<div class="mt-4">
    <x-label for="url" :value="__('Url')" />
    {{ Form::url('url', Request::old('url'), ['class' => 'block mt-1 w-full']) }}
</div>

<div class="mt-4">
    <x-label for="caption" :value="__('Caption')" />
    {{ Form::text('caption', Request::old('caption'), ['class' => 'block mt-1 w-full']) }}
</div>


