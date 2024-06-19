<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CRUD_PROJECT</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>
<body>

<div class="bg-dark py-1" >
    <h1 class="text-center text-white" >CRUD_PROJECT</h1>
</div>

<div class="container my-5">
    <div class="row d-flex justify-content-center" >
        <div class="col-md-10 d-flex justify-content-end pb-3" >
            <a href="{{route('products.index')}}" class="btn btn-dark" >Back</a>
        </div>
    </div>
    <div class="row d-flex justify-content-center" >
        <div class="col-md-10" >
            <div class="card border-0 shadow-lg" >
                <div class="card-header">
                    <h3>Edit Product</h3>
                </div>
                <form enctype="multipart/form-data" action="{{route('product.update',$product->id)}}" method="post">
                    @method('PUT')
                    @csrf
                    <div class="card-body" >

                        <div class="mb-3">
                            <label for="name" class="pb-2 h6">Name</label>
                            <input type="text" value="{{old('name',$product->name)}}" name="name" placeholder="Product Name" class="@error('name') is-invalid @enderror form-control form-control-md">
                            @error('name')
                            <p class="invalid-feedback" >{{$message}}</p>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="sku" class="pb-2 h6">SKU</label>
                            <input type="text" value="{{old('sku',$product->SKU)}}" name="sku" placeholder="Product SKU" class="@error('sku') is-invalid @enderror form-control form-control-md">
                            @error('sku')
                            <p class="invalid-feedback" >{{$message}}</p>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="price" class="pb-2 h6" >Price</label>
                            <input type="text" value="{{old('price',$product->price)}}" name="price" placeholder="Product Price" class=" @error('price') is-invalid @enderror form-control form-control-md">
                            @error('price')
                            <p class="invalid-feedback" >{{$message}}</p>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="description" class="pb-2 h6">Description</label>
                            <textarea  name="description" placeholder="Product Description" cols="20" rows="5" class="form-control form-control-md">{{old('description',$product->description)}} </textarea>
                        </div>

                        <div class="mb-3">
                            <label for="image" class="pb-2 h6" >Image</label>
                            <input type="file" name="image" class="form-control form-control-md">
                            @if($product->image!="")
                                <img class="w-50px my-2" src="{{asset('upload/product/'.$product->image)}}" alt="">
                            @endif
                        </div>

                        <div class="d-grid pb-2">
                            <button type="submit" class="btn btn-lg btn-primary">Update</button>
                        </div>


                    </div>
                </form>
            </div>
        </div>
    </div>
</div>







<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>
</html>
