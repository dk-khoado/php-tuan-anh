@extends('masterAdmin')
@section('content')
    <form action="/books/edit/{{ $book->id }}" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="usr">Hình Ảnh:</label>
            <img id="blah" src="#" alt="your image" width="140px" height="80px"/>
            <input type="file" class="form-control" id="image_book" name="image_book" required>
        </div>
        {{ csrf_field() }}
        <div class="form-group">
            <label for="usr">Tiêu đề:</label>
            <input type="text" class="form-control" id="usr" name="title" value="{{ $book->title }}" required>
        </div>
        <div class="form-group">
            <label for="pwd">giá:</label>
            <input type="number" class="form-control" name="price" value="{{ $book->price }}" required>
        </div>
        <div class="form-group">
            <label for="pwd">Miêu tả:</label>
            <textarea class="form-control" name="description" required>{{ $book->description }}</textarea>
        </div>
        <div class="form-group">
            <label for="pwd">Tác Giả:</label>
            <input type="text" class="form-control" name="tac_gia" value="{{ $book->tac_gia }}" required>
        </div>
        <div class="form-group">
            <label for="pwd">Loại sách:</label>
            <select class="form-control" name="loai_sach" value="{{ $book->loai_sach }}">
                @foreach ($book_type as $item)
                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-success">Lưu</button>
    </form>
    <script>
        $("#image_book").change(function() {
            readURL(this);
        });

    </script>
@endsection
