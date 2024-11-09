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
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header text-center">
                    <h4>{{ $stylists->name }}</h4>
                </div>
                <div class="card-body text-center">
                    @if ($stylists->photo)
                        <img src="{{ asset('storage/' . $stylists->photo) }}" alt="stylists Photo" class="img-fluid mb-3" style="width: 2000px; height: auto;">
                    @else
                        <p>No Image Available</p>
                    @endif
                    <p><strong>Speciality:</strong> {{ $stylists->speciality }}</p>
                    <p><strong>Phone:</strong> {{ $stylists->phone }}</p>
                    <p><strong>Email:</strong> {{ $stylists->email }}</p>
                    <a href="{{ route('user.stylists.index') }}" class="btn btn-secondary mt-3">Back to Stylists</a>
                </div>
            </div>
        </div>
    </div>
</div>

</body>

</html>
