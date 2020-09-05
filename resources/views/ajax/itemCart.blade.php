@foreach ($carts as $item)
    <div class="row cart-count">
        <div class="col-2"><img src="/storage/{{$item->image_book}}" width="50px" height="50px"></div>
        <div class="col-8">
            <b>{{$item->title}}</b>
            <p>{{$item->price}}</p>
        </div>
        <div class="col-2">
            <button type="button" onclick="removeCart({{$item->cart_id}})" class="btn btn-danger"><i class="fas fa-times"></i></button>
        </div>
    </div>
@endforeach
