<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mentol - Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="/CSS/adminStyle.css">
    <script src="https://kit.fontawesome.com/9e886f53f9.js" crossorigin="anonymous"></script>
</head>
<body>
    <section id="box">
        <nav class="navbar navbar-light">
            <div class="container-fluid">
              <img id="logo" src="../assets/MentolLogo.png">
              <div class="content-nav">
                <label id="greetings"></label>
                <div class="droppudown">
                    <i class="fas fa-user-circle fa-4x" id="user-icon"></i>
                    <label id="arrowDown" for="user-icon"><i class="fas fa-caret-down"></i></label>
                    <div class="dropdown-content">
                        <a href="#">Logout</a>
                    </div>
                </div>
            </div>
        </nav>
        <div class="addbtn">
            <button id="add" type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addModal">
                Add
            </button>

            <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">What to add?</h5>
                        </div>
                        <form action="{{ route('product.store') }}" method="POST">
                            @csrf
                            <div class="modal-body">
                                <div class="addInput">
                                    <label>Product Category</label>
                                    <input type="text" class="input-box">
                                </div>
                                <div class="addInput">
                                    <label>Product Name</label>
                                    <input type="text" class="input-box">
                                </div>
                                <div class="addInput">
                                    <label>Product Price</label>
                                    <div class="harga">
                                        <label>Rp.</label>
                                        <input type="number" min="1" class="input-price">
                                    </div>
                                </div>
                                <div class="addInput">
                                    <label> Product Stock</label>
                                    <input type="number" min="0" class="input-box">
                                </div>
                                <div class="addInput-pic">
                                    <label>Image</label>
                                    <input type="file" accept="image/x-png, image/jpeg, image/jpg">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">Upload</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="content">
            @foreach ($products as $product)
            <div class="user">
                <div class="top">
                    <a href="{{ route('product.show', $product->id) }}"><img src="https://foto.wartaekonomi.co.id/files/arsip_foto_2020_08_28/danone-aqua_140327_big.jpg" alt=""></a>
                    <div class="labelProduct">{{ $product->name }}</div>
                    <h6>Stock: {{ $product->stock }}</h6>
                </div>
                <div class="bott">
                    <button id="leftb" type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#stockModal{{$product->id}}">
                        Stock
                    </button>
        
                    <div class="modal fade" id="stockModal{{$product->id}}" tabindex="-1" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLongTitle">{{ $product->name }}</h5>
                                </div>
                                <form action="{{ route('product.update', $product->id) }}" method="POST">
                                    <div class="modal-body" id="stock-body">
                                        <label>Total Stock</label>
                                        <input type="number" min="0" value="0" id="stock-input">
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-primary">Upload</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <form action="{{ route('product.delete', $product->id) }}">
                        @csrf
                        @method('DELETE')
                        <button id="rightb" type="submit">Delete</button>
                    </form>                
                </div>
            </div>
            @endforeach
        </div>
    </section>
    <script src="/js/user.js"></script>
</body>
</html>