  <div class="card p-6 m-6 bg-white border-b border-gray-200">

            <img src="{{ asset($image->url) }}" width="258" height="100" />

        <p class="text-gray-700 text-base"> {{ $image->caption }}</p>


        <p class="text-gray-600">{{ $image->created_at->diffForhumans() }}</p>


            <a class="bg-blue-500 text-white font-bold py-2 px-4" href="{{ route('admin.images.edit', $image->id) }}">Edit</a>


    </div>
