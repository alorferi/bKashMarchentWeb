<div class="flex items-center justify-between px-4 py-4 m-4 border-gray-200 sm:px-6">
  <div class="flex justify-between flex-1 sm:hidden">
    <a href="#" class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-50">Previous</a>
    <a href="#" class="relative inline-flex items-center px-4 py-2 ml-3 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-50">Next</a>
  </div>
  <div class="hidden sm:flex sm:flex-1 sm:items-center sm:justify-between">
    <div>
      <p class="text-sm text-gray-700">


        @php

        $currentTotalItems = ($page+1) * $subscriptions->size;

        if ($currentTotalItems > $subscriptions->totalElements) {
            $currentTotalItems = $subscriptions->totalElements;
        }

    @endphp

        Showing

        <span class="font-medium">
            {{ $currentTotalItems }}
        </span>
        of
        <span class="font-medium">{{ $subscriptions->totalElements }}</span>
        results | Total Pages: {{$subscriptions->totalPages}}
      </p>
    </div>
    <div>
      <nav class="inline-flex -space-x-px rounded-md shadow-sm isolate" aria-label="Pagination">
        <a href="{{route("admin.subscriptions.index")}}?source={{$source}}&page={{($page-1)<0? 0 : ($page-1) }}" class="relative inline-flex items-center px-2 py-2 text-gray-400 rounded-l-md ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus:z-20 focus:outline-offset-0">

            <svg class="w-5 h-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                <path fill-rule="evenodd" d="M12.79 5.23a.75.75 0 01-.02 1.06L8.832 10l3.938 3.71a.75.75 0 11-1.04 1.08l-4.5-4.25a.75.75 0 010-1.08l4.5-4.25a.75.75 0 011.06.02z" clip-rule="evenodd" />
              </svg>

            <span class="sr-only">Previous</span>

        </a>
        <a href="{{route("admin.subscriptions.index")}}?source={{$source}}&page={{($page+1)>$subscriptions->totalPages-1?$subscriptions->totalPages-1: ($page+1)}}" class="relative inline-flex items-center px-2 py-2 text-gray-400 rounded-r-md ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus:z-20 focus:outline-offset-0">
          <span class="sr-only">Next</span>
          <svg class="w-5 h-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
            <path fill-rule="evenodd" d="M7.21 14.77a.75.75 0 01.02-1.06L11.168 10 7.23 6.29a.75.75 0 111.04-1.08l4.5 4.25a.75.75 0 010 1.08l-4.5 4.25a.75.75 0 01-1.06-.02z" clip-rule="evenodd" />
          </svg>
        </a>
      </nav>
    </div>
  </div>
</div>
