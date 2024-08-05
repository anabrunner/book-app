<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      My Shelves
    </h2>
  </x-slot>

  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 text-gray-900">
          <ul class="grid gap-3 grid-cols-1 md:grid-cols-2 xl:grid-cols-3">
            @if (!count($shelves))
              You don't have any shelves yet!
            @else
              @foreach ($shelves as $shelf)
                @php
                  $book = $shelfBooks[$shelf];
                @endphp
                <li class="card card-side bg-base-100 shadow-xl">
                  <figure class="max-w-40">
                    <img src="{{ Storage::url($book->cover) }}" alt="{{ $book->title }}" class="rounded-lg" />
                  </figure>
                  <div class="card-body">
                    <h2 class="card-title">{{ $shelf }}</h2>
                    <p></p>
                    <div class="card-actions justify-end">
                      <a href="{{ route('v1.shelves.showBooks', ['shelf' => $shelf]) }}" class="btn btn-neutral">
                        View Shelf
                      </a>
                    </div>
                  </div>
                </li>
              @endforeach
            @endif
          </ul>
        </div>
      </div>
    </div>
  </div>
</x-app-layout>
