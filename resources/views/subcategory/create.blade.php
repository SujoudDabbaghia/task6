<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Add SubCategory</title>
</head>
<body>
    <div class="container">
        <from action="{{route('subcategory.store')}}"  method="POST">
            @csrf
            <div class="mb-3">
                <label class="form-label">name</label>
                <input type="text" class="form-control" name="name" placeholder="name">
                <select class="form-select" aria-label="Default select example" name="category_id">
                    @foreach($categories as $category)
                    <option value="{{$category->id}}">{{$category->name}}</option>
                    @endforeach
                </select>
                <button type="submit" class="mt-5">Save</button>
            </div>
        </form>   
    </div>
</body>
</html>