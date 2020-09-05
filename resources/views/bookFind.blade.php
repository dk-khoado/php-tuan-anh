@foreach ($books as $item)
  <div class="col-lg-4 col-md-6 mb-4 ">
    <div class="card h-100">
      <a href="#"><img class="card-img-top" onerror="this.src = 'http://placehold.it/700x400' " src="/storage/{{$item->image_book}}" alt="" width="200px" height="150"></a>
      <div class="card-body">
        <h4 class="card-title">
          <a href="#">{{$item->title}}</a>
        </h4>
        <h5>{{$item->price}} VNĐ</h5>
        <p style=" width: 100%;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;" class="card-text">{{$item->description}}</p>
      </div>
      <div class="card-footer">
        <button class="btn btn-primary" onclick="addToCart({{$item->id}})">Thêm vào giỏ hàng</button>
      </div>
    </div>
  </div> 
@endforeach
{{ $books->links() }}
