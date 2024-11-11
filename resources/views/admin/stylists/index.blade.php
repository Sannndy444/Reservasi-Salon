<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stylist</title>

    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>

<body>
    <x-admin-navbar></x-admin-navbar>

    <div class="container p-5 my-3">
        <div class="row">
            <div class="col">
                <h1>Stylist</h1>
            </div>
            <div class="col">
                <div class="position-relative">
                    <div class="position-absolute top-50 end-0 translate-bottom-y">
                        <button type="button" class="btn btn-primary">
                            <a href="{{ route('admin.stylists.create') }}" class="text-decoration-none text-light">Add
                                New Stylist</a>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>
        </div>

        <div class="row">
            <div class="col">
                <hr>
            </div>
        </div>

        <table class="table table-sm">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Name</th>
                    <th>Speciality</th>
                    <th>Phone</th>
                    <th>Email</th>
                    <th>Photo</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($stylists as $stylist)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $stylist->name }}</td>
                        <td>{{ $stylist->speciality }}</td>
                        <td>{{ $stylist->phone }}</td>
                        <td>{{ $stylist->email }}</td>
                        <td>
                            @if ($stylist->photo)
                                <img src="{{ asset('storage/photos/' . $stylist->photo) }}" alt="kontol" width="100">
                            @else
                                No Image
                            @endif
                        </td>
                        <td>
                            <div class="p-2 d-flex align-items-center">
                                <form action="{{ route('admin.stylists.destroy', $stylist->id) }}" method="POST" onsubmit="return confirm('Are you sure to delete category?')" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                                <a href="{{ route('admin.stylists.edit', $stylist->id) }}" class="btn btn-primary ms-2">Edit</a>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>

</html>
