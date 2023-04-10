  <div class="card p-6 m-6 bg-white border-b border-gray-200">



      <iframe width="420" height="315" src="{{ $video->url }}">
      </iframe>


      <p class="text-gray-700 text-base"> {{ $video->caption }}</p>


      <p class="text-gray-600">{{ $video->created_at->diffForhumans() }}</p>


      <a class="bg-blue-500 text-white font-bold py-2 px-4" href="{{ route('admin.videos.edit', $video->id) }}">Edit</a>


  </div>
