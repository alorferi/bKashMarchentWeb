       <!-- Name -->
       <div>
        <x-label for="term_name" :value="__('Title')" />
        {{ Form::text('term_name', Request::old('term_name'), array('class' => 'block mt-1 w-full')) }}
    </div>

    <!-- Email Address -->
    <div class="mt-4">
        <x-label for="term_value" :value="__('Body')" />
        {{ Form::text('term_value', Request::old('term_value'), array('class' => 'block mt-1 w-full')) }}
    </div>

