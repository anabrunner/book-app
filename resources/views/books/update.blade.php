<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      Edit Book
    </h2>
  </x-slot>

  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 text-gray-900">
          <form action="{{ route('v1.books.update', ['book' => $book]) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PATCH')
            <label for="title">Title:</label>
            <input type="text" id="title" name="title" value="{{ $book->title }}" required>

            <label for="author">Author:</label>
            <input type="text" id="author" name="author" value="{{ $book->author }}" required>

            <label for="date_read">Date Read:</label>
            <input type="date" id="date_read" name="date_read" value="{{ $book->date_read }}">

            <label for="shelf">Shelf:</label>
            <input type="text" id="shelf" name="shelf" value="{{ $book->shelf }}">

            <label for="cover">Cover:</label>
            <input type="file" accept=".jpeg,.png,.jpg,.gif" id="cover" name="cover">

            <label for="rating">Rating:</label>
            <input type="number" id="rating" name="rating" value="{{ $book->rating }}">

            <button type="submit">Update</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</x-app-layout>