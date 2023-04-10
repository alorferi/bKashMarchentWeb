<div class="form-group">
    <div class="p-2">

        @if ( isset($image) && $image != null)
            <img id="postImage" src="{{ asset($image->url) }}" />
        @endif

    </div>

    <div>
        {{ Form::file('image', ['accept' => '.gif, .jpg, .jpeg, .png', 'onchange' => "showImageFromSelectedLocalFile(this,'bookCoverImg')"]) }}
    </div>

</div>

<div class="mt-4">
    <x-label for="caption" :value="__('Caption')" />
    {{ Form::text('caption', Request::old('caption'), ['class' => 'block mt-1 w-full']) }}
</div>


