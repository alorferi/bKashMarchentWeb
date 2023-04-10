       <!-- Name -->
       <div>
        <x-label for="comment_title" :value="__('Title')" />
        {{ Form::text('comment_title', Request::old('comment_title'), array('class' => 'block mt-1 w-full')) }}
        {{-- <x-input id="comment_title" class="block mt-1 w-full" type="text" name="comment_title"
            :value="{{$comment->comment_title}}" required autofocus /> --}}
    </div>

    <!-- Email Address -->
    <div class="mt-4">
        <x-label for="comment_content" :value="__('Body')" />
        {{ Form::text('comment_content', Request::old('comment_content'), array('class' => 'block mt-1 w-full')) }}
        {{-- <x-input id="comment_content" class="block mt-1 w-full" type="text" name="comment_content"
            :value="{{$comment->comment_content}}" required /> --}}
    </div>

