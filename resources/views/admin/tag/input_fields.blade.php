<div class="mt-4">
    <x-label for="name" :value="__('Name')" />
    {{ Form::text('name', Request::old('name'), ['class' => 'block mt-1 w-full']) }}
</div>


