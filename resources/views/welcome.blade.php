<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laravel-Crud</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
</head>

<body>
    <div class="container mt-3">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="d-flex ms-auto justify-content-between p-4">
                    <button class="btn btn-success ms-auto" data-bs-toggle="modal" data-bs-target="#exampleModal">Add
                        Product</button>
                </div>

                <div class="card shadow">
                    <div class="card-body">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">SR.NO</th>
                                    <th scope="col">Image</th>
                                    <th scope="col">Product Name</th>
                                    <th scope="col">Category</th>
                                    <th scope="col">Price</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($products as $key => $item)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>

                                        <td>
                                            <img src="{{ asset($item->product_image) }}" width="60px" height="60px"
                                                alt="">
                                        </td>

                                        <td>{{ $item->product_name }}</td>

                                        <td>{{ $item->category }}</td>

                                        <td>{{ $item->price }}</td>

                                        <td>
                                            <a href="" class="btn btn-primary">Edit</a>
                                            <button class="btn btn-danger">Delete</button>
                                        </td>
                                        <td>
                                            <a href="{{ route('cart.add', $item->id) }}" class="btn btn-warning">Add to
                                                Cart</a>
                                            <a href="#" class="btn btn-primary">Edit</a>
                                            <button class="btn btn-danger">Delete</button>
                                        </td>

                                    </tr>
                                @endforeach


                            </tbody>
                        </table>


                        <!----- Modal Starts-------->



                        <!-- Modal -->
                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title fs-5 text-center" id="exampleModalLabel">Add Product</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{ route('store.product') }}" method="post"
                                            enctype="multipart/form-data">
                                            @csrf


                                            <input type="hidden" name="email" value="shivambaranwal367@gmail.com">

                                            <div class="mb-3">
                                                <input class="form-control" type="text" name="product_name"
                                                    id="" placeholder="Products Name">
                                            </div>
                                            <div class="mb-3">
                                                <input class="form-control" type="text" name="category"
                                                    id="" placeholder="Category">
                                            </div>
                                            <div class="mb-3">
                                                <input class="form-control" type="text" name="price" id=""
                                                    placeholder="Price">
                                            </div>
                                            <div class="mb-3">
                                                <input type="file" name="product_image" id="">
                                            </div>
                                            <div class="mb-3">
                                                <button type="submit" class="btn btn-primary">Add Product</button>
                                            </div>

                                        </form>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <!----- Modal Ends-------->

                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>
