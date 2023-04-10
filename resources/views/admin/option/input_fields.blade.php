       <!-- Name -->
       <div>
        <x-label for="option_name" :value="__('Title')" />
        {{ Form::text('option_name', Request::old('option_name'), array('class' => 'block mt-1 w-full')) }}
    </div>

    <!-- Email Address -->
    <div class="mt-4">
        <x-label for="option_value" :value="__('Body')" />
        {{ Form::text('option_value', Request::old('option_value'), array('class' => 'block mt-1 w-full')) }}
    </div>

