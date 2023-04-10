<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Terms') }}
        </h2>
    </x-slot>



            <a href="{{ route('terms.index') }}"
                class="bg-blue-500 text-white font-bold py-2 px-4 mx-4 my-4 rounded-full">Back</a>



                    {{ Html::ul($errors->all(), ['class' => 'text-danger']) }}

                    {{ Form::open(['route' => 'terms.store', 'files' => true]) }}

                    @csrf


                    @include('term.input_fields')

                    <div class="flex items-center justify-end mt-4">

                        {{ Form::submit('Save', ['class' => 'ml-4']) }}

                        {{ Form::close() }}

                        {{-- <x-button class="ml-4">
                                {{ __('Save') }}
                            </x-button> --}}
                    </div>
                    </form>

</x-admin-layout>
