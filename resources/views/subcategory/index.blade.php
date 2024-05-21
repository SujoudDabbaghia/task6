<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>SubCategory</title>
</head>
<body>
    <nav class="navbar bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand">Search for subcategories</a>
            <form class="d-flex" role="search" action="{{route('str')}}" method="GET">
            <input  class="form-control me-2" type="search" name="str" placeholder="Search" aria-label="Search">
            <input class="btn btn-outline-success" type="submit" value="Search">
            </form>
        </div>
    </nav>
    <div class=mt-3>
        <div class="text-center">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Category</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach($sub_categories as $sub_category)
                        <tr>
                            <td>{{$sub_category->id}}</td>
                            <td>{{$sub_category->name}}</td>
                            <td>{{$sub_category->category->name}}</td>
                            <td>
                                <a href="{{route('subcategory.edit' , $sub_category->id)}}" class="btn btn-outline-success">Edit</a>
                                <form style="display: inline;" method='POST' action="{{route('subcategory.destroy' , $sub_category->id)}}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-outline-danger">Delete</button>
                                </form>
                            </td>                     
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <a href="{{route('subcategory.create')}}"  class="btn btn-outline-primary">Add SubCategory</a>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>