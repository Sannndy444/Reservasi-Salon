<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Stylist</title>

    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>

<body>
    <x-admin-navbar></x-admin-navbar>

    <div class="container p-5 my-3">
        <div class="row">
            <div class="col">
                <h1>Edit Stylist</h1>
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

        <form action="{{ route('admin.stylists.update', $stylist->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $stylist->name) }}" required>
            </div>

            <div class="mb-3">
                <label for="speciality" class="form-label">Speciality</label>
                <input type="text" class="form-control" id="speciality" name="speciality" value="{{ old('speciality', $stylist->speciality) }}" required>
            </div>

            <div class="mb-3">
                <label for="phone" class="form-label">Phone</label>
                <input type="text" class="form-control" id="phone" name="phone" value="{{ old('phone', $stylist->phone) }}" required>
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $stylist->email) }}" required>
            </div>

            <div class="mb-3">
                <label for="photo" class="form-label">Photo</label>
                <input type="file" class="form-control" id="photo" name="photo" value="{{ old('photo', $stylist->photo) }}">
                <!-- Display existing photo -->
                @if ($stylist->photo)
                    <div class="mt-2">
                        <img src="{{ asset('storage/photos/' . $stylist->photo) }}" alt="Current Photo" width="100" >
                    </div>
                @endif
            </div>

            <button type="submit" class="btn btn-primary">Update Stylist</button>
            <a href="{{ route('admin.stylists.index') }}" class="btn btn-secondary ms-2">Cancel</a>
        </form>
    </div>
</body>

</html>
