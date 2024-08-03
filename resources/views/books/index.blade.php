<div>
  <ul class="grid gap-3 grid-cols-1 md:grid-cols-2 xl:grid-cols-3">
    @if (!$books)
      You haven't added any books yet!
    @else
      @foreach ($books as $book)
        <li class="flex gap-3">
          <img src="{{ Storage::url($book->cover) }}" alt="{{ $book->title }}" class="max-w-40 rounded-lg">
          <div class="flex flex-col justify-around p-2">
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
            <div class="flex gap-2 items-center">
              <a href="{{ route('v1.books.edit', ['book' => $book->id]) }}">Edit</a>
              <form action="{{ route('v1.books.destroy', ['book' => $book->id]) }}" method="post">
                @csrf
                @method('DELETE')
                <button type="submit">Delete</button>
              </form>
            </div>
          </div>
        </li>
      @endforeach
    @endif
  </ul>
  @if ($books)
    {{ $books->links() }}
  @endif
</div>
