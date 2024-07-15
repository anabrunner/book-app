<div>
  <ul>
    @if (!$books)
    You haven't added any books yet!
    @else
    @foreach ($books as $book)
    <li>{{ $book->title }}</li>
    @endforeach
    @endif
  </ul>
</div>