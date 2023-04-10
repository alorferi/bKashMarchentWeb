<div class="form-group">
    <div class="p-2">

        @if (isset($post) && $post->image != null)
            <img id="postImage" src="{{ asset($post->image->url) }}" />
        @endif

    </div>

    <div>
        {{ Form::file('image', ['accept' => '.gif, .jpg, .jpeg, .png', 'onchange' => "showImageFromSelectedLocalFile(this,'bookCoverImg')"]) }}
    </div>

</div>

<!-- Name -->
<div>
    <x-label for="post_title" :value="__('Title')" />
    {{ Form::text('post_title', Request::old('post_title'), ['class' => 'block mt-1 w-full']) }}
    {{-- <x-input id="post_title" class="block mt-1 w-full" type="text" name="post_title"
            :value="{{$post->post_title}}" required autofocus /> --}}
</div>

<!-- Email Address -->
<div class="mt-4">
    <x-label for="post_content" :value="__('Body')" />
    {{ Form::textarea('post_content', Request::old('post_content'), ['class' => 'block mt-1 w-full']) }}
    {{-- <x-input id="post_content" class="block mt-1 w-full" type="text" name="post_content"
            :value="{{$post->post_content}}" required /> --}}
</div>

<div class="mt-4">
    {{ Form::label('post_author', 'Author') }}
    {{ Form::select('post_author', $authors, Request::old('post_author'), [''], ['class' => 'form-control']) }}
</div>

@php

    if (isset($post)) {
        $post_date = $post->post_date->format('Y-m-d');
    } else {
        $post_date = date('Y-m-d');
    }

@endphp

<div class="mt-4">
    <x-label for="post_date" :value="__('Posted at')" />
    {{ Form::date('post_date', $post_date, ['class' => 'block mt-1 w-full']) }}
</div>

<div class="mt-4">
    {{ Form::label('post_tag_ids', 'Tags') }}

    {{ Form::select('post_tag_ids[]', $tags, $post->tags()->pluck('id'), ['id' => 'post_tag_ids', 'multiple' => 'multiple']) }}
</div>

<div class="mt-4">
    {{ Form::label('post_status', 'Post status') }}
    {{ Form::select('post_status', ['draft' => 'Draft', 'publish' => 'Publish', 'inherit' => 'Inherit', 'auto-draft' => 'Auto-draft'], Request::old('post_status'), [''], ['class' => 'form-control']) }}
</div>
