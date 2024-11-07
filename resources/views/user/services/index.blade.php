<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Services</title>

    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>

<body>
    <x-user-navbar></x-user-navbar>
    <div class="container p-5 my-3">
        <div class="row">
            @foreach($services as $s)
                <div class="col-sm-2 mb-2">
                    <div class="card text-center">
                        <div class="card-body">
                            <h5 class="card-title">{{ $s->name }}</h5>
                            <p class="text-cp-dark-blue">Rp {{number_format($s->price, 0, ',', '.')}}</p>
                            <a href="#" class="btn btn-primary">Detail</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

</body>

</html>
