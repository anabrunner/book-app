<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      What are you reading?
    </h2>
  </x-slot>

  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 text-gray-900">
          <form action="{{ route('v1.books.store') }}" method="post" enctype="multipart/form-data"
            class="flex flex-col items-center gap-3">
            @csrf
            <div class="grid grid-cols-2 gap-3 items-center max-w-lg">
              <label for="title">Title</label>
              <input type="text" id="title" name="title" class="input input-bordered w-full max-w-xs" required>

              <label for="author">Author</label>
              <input type="text" id="author" name="author" class="input input-bordered w-full max-w-xs" required>

              <label for="date_read">Date Read</label>
              <input type="date" id="date_read" name="date_read" class="input input-bordered w-full max-w-xs">

              <label for="shelf">Shelf</label>
              <input type="text" id="shelf" name="shelf" class="input input-bordered w-full max-w-xs">

              <label for="cover">Cover</label>
              <input type="file" accept=".jpeg,.png,.jpg,.gif" id="cover" name="cover"
                class="file-input file-input-bordered w-full max-w-xs">

              <label for="rating">Rating</label>
              <div class="rating">
                <input type="radio" name="rating" class="mask mask-star" id="1" value="1">
                <input type="radio" name="rating" class="mask mask-star" id="2" value="2">
                <input type="radio" name="rating" class="mask mask-star" id="3" value="3"
                  checked="checked">
                <input type="radio" name="rating" class="mask mask-star" id="4" value="4">
                <input type="radio" name="rating" class="mask mask-star" id="5" value="5">
              </div>
            </div>
            <div class="flex gap-3">
              <button type="submit" class="btn btn-neutral">Save</button>
              <button type="reset" class="btn">Reset</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</x-app-layout>
