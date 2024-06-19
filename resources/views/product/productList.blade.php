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
            <a href="{{route('product.create')}}" class="btn btn-dark" >Create</a>
        </div>
    </div>
    <div class="row d-flex justify-content-center" >
        @if (Session::has('success'))
            <div class="col-md-10 mt-4">
                <div class="alert alert-success">
                    {{ Session::get('success') }}
                </div>
            </div>
        @endif
        <div class="col-md-10" >
            <div class="card border-o shadow-lg" >
                <div class="card-header" >
                    <h3>Products</h3>
                </div>
                <div class="card-body">

                        <table class="table">

                            <tr>
                                <th>ID</th>
                                <th>IMAGE</th>
                                <th>NAME</th>
                                <th>SKU</th>
                                <th>DESCRIPTION</th>
                                <th>PRICE</th>
                                <th>CREATED_AT</th>
                                <th>ACTION</th>
                            </tr>

                            @if($products->isNotEmpty())
                                @foreach($products as $item)
                                    <tr>
                                        <td>{{$item->id}}</td>
                                        <td>
                                            @if($item->image!="")
                                                    <img width="50px" src="{{asset('upload/product/'.$item->image)}}">
                                            @endif
                                        </td>
                                        <td>{{$item->name}}</td>
                                        <td>{{$item->SKU}}</td>
                                        <td width="300px ">{{$item->description}}</td>
                                        <td>{{$item->price}}</td>
                                        <td>{{ \carbon\carbon::parse($item->created_at)->format('d M,Y') }}</td>
                                        <td>
                                            <a href="{{route('product.edit',$item->id)}}" class="btn btn-dark">Edit</a>
                                            <a href="#" onclick="deleteProduct({{$item->id}});" class="btn btn-danger">Delete</a>

                                            <form id="delete-product-from-{{$item->id}}" action="{{route('product.delete',$item->id)}}" method="post">
                                                @csrf
                                                @method('delete')
                                            </form>

                                        </td>
                                    </tr>
                                @endforeach
                            @endif

                        </table>




                </div>
            </div>
        </div>
    </div>
</div>







<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>
</html>

<script>
    function deleteProduct(id){
        if(confirm("Are you sure ! You want to delete this Product?")){
    document.getElementById("delete-product-from-"+id).submit();
        }
    }
</script>
