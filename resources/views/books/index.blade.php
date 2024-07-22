<div>
  <ul>
    @if (!$books)
    You haven't added any books yet!
    @else
    @foreach ($books as $book)
    <li>{{ $book->title }} <a href="{{ route('edit-book', ['book' => $book->id]) }}">update book</a></li>
    @endforeach
    @endif
  </ul>
</div>