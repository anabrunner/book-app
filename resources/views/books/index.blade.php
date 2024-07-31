<div>
  <ul class="flex flex-col gap-3">
    @if (!$books)
      You haven't added any books yet!
    @else
      @foreach ($books as $book)
        <li class="flex gap-3 justify-between">
          <div class="flex gap-3">
            <img src="{{ Storage::url($book->cover) }}" alt="{{ $book->title }}" class="max-w-40 rounded-lg">
            <div>
              <p class="text-3xl">{{ $book->title }}</p>
              <p class="text-xl">{{ $book->author }}</p>
              @if ($book->date_read)
                <p class="text-sm">Date read: {{ $book->date_read }}</p>
              @endif
              @if ($book->shelf)
                <p class="text-sm">Shelved under: {{ $book->shelf }}</p>
              @endif
              @if ($book->rating)
                <p class="text-sm">Rating:</p>
                <div class="rating">
                  {!! str_repeat(
                      '<svg width="20" height="20" class="mask mask-star"><rect width="20" height="20" style="fill:black" /></svg>',
                      $book->rating,
                  ) !!}
                  {!! str_repeat(
                      '<svg width="20" height="20" class="mask mask-star"><rect width="20" height="20" style="fill:lightgray" /></svg>',
                      5 - $book->rating,
                  ) !!}
                </div>
              @endif
            </div>
          </div>
          <div class="flex gap-2">
            <a href="{{ route('v1.books.edit', ['book' => $book->id]) }}">Edit</a>
            <form action="{{ route('v1.books.destroy', ['book' => $book->id]) }}" method="post">
              @csrf
              @method('DELETE')
              <button type="submit">
                <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" stroke="red"
                  fill="red">
                  <path
                    d="M3 6v18h18v-18h-18zm5 14c0 .552-.448 1-1 1s-1-.448-1-1v-10c0-.552.448-1 1-1s1 .448 1 1v10zm5 0c0 .552-.448 1-1 1s-1-.448-1-1v-10c0-.552.448-1 1-1s1 .448 1 1v10zm5 0c0 .552-.448 1-1 1s-1-.448-1-1v-10c0-.552.448-1 1-1s1 .448 1 1v10zm4-18v2h-20v-2h5.711c.9 0 1.631-1.099 1.631-2h5.315c0 .901.73 2 1.631 2h5.712z" />
                </svg>
              </button>
            </form>
          </div>
        </li>
      @endforeach
    @endif
  </ul>
</div>
