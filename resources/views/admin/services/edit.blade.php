<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Service</title>

    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>
    <x-admin-navbar></x-admin-navbar>

    <div class="container p-5 my-3">
        <h1>Edit Service</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.services.update', $service->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $service->name) }}" required>
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea name="description" id="description" class="form-control" required>{{ old('description', $service->description) }}</textarea>
            </div>

            <div class="mb-3">
                <label for="price" class="form-label">Price</label>
                <input type="number" name="price" id="price" class="form-control" value="{{ old('price', $service->price) }}" step="0.01" required>
            </div>

            <div class="mb-3">
                <label for="duration" class="form-label">Duration</label>
                <input type="text" name="duration" id="duration" class="form-control" value="{{ old('duration', $service->duration) }}" required>
            </div>

            <button type="submit" class="btn btn-success">Update Service</button>
            <a href="{{ route('admin.services.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</body>
</html>
