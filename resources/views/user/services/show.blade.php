<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Details</title>

    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>
    <x-user-navbar></x-user-navbar>
    <div class="container p-5 my-3">
        <div class="row">
            <div class="col-sm-5 mb-2 mx-auto">
                <div class="card text-center">
                    <div class="card-header">
                        <h5>{{ $services->name }}</h5>
                    </div>
                    <div class="card-body">
                        <p class="card-text">Rp {{number_format($services->price, 0, ',', '.')}}</p>
                        <p class="card-text">{{ $services->description }}</p>
                        <a href="{{ route('user.services.index') }}" class="btn btn-secondary">Back to Services</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
