<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Guide Details</title>
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        /* Custom CSS for styling */
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        .table-responsive {
            overflow-x: auto;
        }
        th, td {
            text-align: center;
        }
        img {
            max-width: 100%;
            height: auto;
        }
    </style>
</head>
<body>
      @include("layouts.navigation")
    <div class="container mt-5">
        <h1 class="mt-4 mb-4">Guide Details</h1>
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead class="thead-dark">
                    <tr>
                        <th>Guide ID</th>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Age</th>
                        <th>Experience</th>
                        <th>Price</th>
                        <th>Description</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($guides as $guide)
                    <tr>
                        <td>{{ $guide->guide_id }}</td>
                        <td><img src="/images/{{ $guide->image }}" alt="{{ $guide->name }}"></td>
                        <td>{{ $guide->name }}</td>
                        <td>{{ $guide->age }}</td>
                        <td>{{ $guide->experience }}</td>
                        <td>{{ $guide->price }}</td>
                        <td>{{ $guide->description }}</td>
                        <td>
                            <form method="POST" action="{{ route('book_guide.book', ['id' => $guide->id]) }}">
                                @csrf
                                <input type="hidden" name="guide_id" value="{{ $guide->guide_id }}">
                                <input type="hidden" name="name" value="{{ $guide->name }}">
                                <input type="hidden" name="age" value="{{ $guide->age }}">
                                <input type="hidden" name="experience" value="{{ $guide->experience }}">
                                <input type="hidden" name="image" value="{{ $guide->image }}">
                                <input type="hidden" name="price" value="{{ $guide->price }}">
                                <input type="hidden" name="description" value="{{ $guide->description }}">
                                <!-- Include other necessary fields here -->
                                <button type="submit" class="btn btn-primary">Book</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
