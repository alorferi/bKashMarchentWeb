<div class="form-group">
    <div class="p-2">
        {{-- <img id="postImage" src="{{ asset("$book->cover_url")}}" width="100"/> --}}
        <img id="userPhoto" src="" width="100"/>
    </div>

    <div>
        {{-- {{ Form::label('cover', 'Cover') }} --}}
        {{ Form::file('photo',['accept'=>'.gif, .jpg, .jpeg, .png','onchange' => "showImageFromSelectedLocalFile(this,'bookCoverImg')"]) }}
    </div>

</div>

   <!-- Name -->
       <div>
        <x-label for="user_title" :value="__('Title')" />
        {{ Form::text('name', Request::old('name'), array('class' => 'block mt-1 w-full')) }}
        {{-- <x-input id="user_title" class="block mt-1 w-full" type="text" name="user_title"
            :value="{{$user->user_title}}" required autofocus /> --}}
    </div>

    <!-- Email Address -->
    <div class="mt-4">
        <x-label for="user_content" :value="__('Body')" />
        {{ Form::text('email', Request::old('email'), array('class' => 'block mt-1 w-full')) }}
        {{-- <x-input id="user_content" class="block mt-1 w-full" type="text" name="user_content"
            :value="{{$user->user_content}}" required /> --}}
    </div>

