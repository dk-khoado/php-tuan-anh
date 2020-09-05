<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Shop Homepage - Start Bootstrap Template</title>

    <!-- Bootstrap core CSS -->
    <link href="/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="/css/shop-homepage.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="/fontawesome/css/all.min.css" rel="stylesheet">

</head>

<body>

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
        <div class="container">
            <a class="navbar-brand" href="#">Start Bootstrap</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive"
                aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ml-auto">
                    @if ($username == '')
                        <li class="nav-item active">
                            <a class="nav-link" href="/">Home
                                <span class="sr-only">(current)</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/login">Login</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/register">Register</a>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link">Hello!, {{ $username }}</a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link" href="#" onclick="loadCart()" data-toggle="modal" data-target="#myModal">
                                <i class="fas fa-shopping-cart"></i> Cart
                                <span class="badge" id="cart_count">{{ $cart_count ?? 0 }}</span></a>                          
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="/logout">logout</a>
                        </li>
                    @endif

                </ul>
            </div>
        </div>
    </nav>

    <div class="modal fade" id="myModal" data-backdrop="static" >
        <div class="modal-dialog">
          <div class="modal-content">
      
            <!-- Modal Header -->
            <div class="modal-header">
              <h4 class="modal-title">Giỏ hàng</h4>
              <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
      
            <!-- Modal body -->
            <div class="modal-body" id="cart">              
            </div>
      
            <!-- Modal footer -->
            <div class="modal-footer">
                <small></small>
              <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>
      
          </div>
        </div>
      </div>

    <!-- Page Content -->
    <div class="container">
        @yield('content')
    </div>


    <!-- Bootstrap core JavaScript -->
    <script src="/vendor/jquery/jquery.min.js"></script>
    <script src="/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script href="/fontawesome/js/all.min.js" rel="stylesheet"></script>
    <script>
        function addToCart(id) {
          $.get("/cart/add/"+id, (data)=>{
            if (data.is_success) {
                window.location.reload();
            }
          })
        }
        function loadCart() {
          $.get("/cart", (data)=>{
            $("#cart").html(data);
            $("#cart_count").text($('.cart-count').length)
          })
        }
        function removeCart(id) {
          $.get("/cart/remove/"+id, (data)=>{
            if (data.is_success) {
                loadCart()
            }
          })
        }
      </script>
</body>

</html>
