<div>
  <ul>
    @if (!$books)
    You haven't added any books yet!
    @else
    @foreach ($books as $book)
    <li>{{ $book->title }}
      <img src="{{ Storage::url($book->cover) }}" alt="{{ $book->title }}">
      <a href="{{ route('v1.books.edit', ['book' => $book->id]) }}">update book</a>
      <form action="{{ route('v1.books.destroy', ['book' => $book->id]) }}" method="post">
        @csrf
        @method('DELETE')
        <button type="submit">delete book</button>
      </form>
    </li>
    @endforeach
    @endif
  </ul>
</div>