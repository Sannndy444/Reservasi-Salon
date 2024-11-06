<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stylist</title>

    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>
    <x-user-navbar></x-user-navbar>
    <div class="container p-5 my-3">
        <div class="row">
            @foreach($stylists as $stylist)
                <div class="col-md-3">
                    <div class="card mb-3" style="width: 15rem;">
                        @if ($stylist->photo)
                                <img src="{{ asset('storage/' . $stylist->photo) }}" alt="" class="card-img-top" width="50">
                            @else
                                No Image
                            @endif
                        <div class="card-body">
                            <h5 class="card-title">{{ $stylist->name }}</h5>
                            <p class="card-text">{{ $stylist->speciality }}</p>
                            <a href="#" class="btn btn-primary">View</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

</body>
</html>
