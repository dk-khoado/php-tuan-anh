@extends('master')
@section('content')
    <div class="row">

        <div class="col-lg-3">

            <h1 class="my-4">Tìm kiếm</h1>
            <form action="javascript:void(0)" onsubmit="return search()">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text">@</span>
                    </div>
                    <input type="text" class="form-control" id="nameBooks" placeholder="tên sách hoặc tác giả">
                </div>
            </form>
        </div>
        <!-- /.col-lg-3 -->

        <div class="col-lg-9 my-4">
            <div class="row" id="books">

                @foreach ($books as $item)
                    <div class="col-lg-4 col-md-6 mb-4 ">
                        <div class="card h-100">
                        <a href="#"><img class="card-img-top" onerror="this.src = 'http://placehold.it/700x400' " src="/storage/{{$item->image_book}}" alt="" width="200px" height="150"></a>
                            <div class="card-body">
                                <h4 class="card-title">
                                    <a href="#">{{ $item->title }}</a>
                                </h4>
                                <h5>{{ $item->price }} VNĐ</h5>
                                <p style=" width: 100%;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;" class="card-text">{{ $item->description }}</p>
                            </div>
                            <div class="card-footer">
                                <button class="btn btn-primary" onclick="addToCart({{$item->id}})">Thêm vào giỏ hàng</button>
                            </div>
                        </div>
                    </div>
                @endforeach


            </div>

            {{ $books->links() }}
            <!-- /.row -->

        </div>
        <!-- /.col-lg-9 -->

    </div>
    <!-- /.row -->
    <script>
      function search() {
        $.get("/books/find?name="+$("#nameBooks").val(), (data)=>{
          $("#books").html(data)
        })
      }
      
    </script>
@endsection
