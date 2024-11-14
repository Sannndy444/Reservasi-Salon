<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Login</title>
  <meta name="description" content="">
  <meta name="keywords" content="">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">

  <!-- Main CSS File -->
  <link href="assets/css/main.css" rel="stylesheet">
</head>

<body>

  <main class="main">
    <!-- Login Section -->
    <section id="contact" class="contact section">
      <div class="container" data-aos="fade-up" data-aos-delay="100">
        <div class="col-lg-6 mx-auto mt-5">
          <!-- Card Layout for the Form -->
          <div class="card shadow-lg">
            <div class="card-body">
              <h4 class="card-title text-center mb-4">Login</h4><hr>

              <!-- Session Status -->
              @if(session('status'))
                <div class="mb-4 text-success">
                  {{ session('status') }}
                </div>
              @endif

              <form method="POST" action="{{ route('login') }}" data-aos="fade-up" data-aos-delay="200">
                @csrf

                <div class="row gy-4">
                  <!-- Email Address -->
                  <div class="col-md-12">
                    <label for="email" class="pb-2">Your Email</label>
                    <input id="email" class="form-control" type="email" name="email" value="{{ old('email') }}" required autofocus>
                    @error('email')
                      <div class="text-danger mt-2">{{ $message }}</div>
                    @enderror
                  </div>

                  <!-- Password -->
                  <div class="col-md-12 mt-4">
                    <label for="password" class="pb-2">Password</label>
                    <input id="password" class="form-control" type="password" name="password" required>
                    @error('password')
                      <div class="text-danger mt-2">{{ $message }}</div>
                    @enderror
                  </div>

                  <!-- Remember Me -->
                  <div class="col-md-12 mt-4">
                    <label for="remember_me" class="inline-flex items-center">
                      <input id="remember_me" type="checkbox" class="form-check-input" name="remember">
                      <span class="ms-2 text-sm text-gray-600">Remember me</span>
                    </label>
                  </div>

                  <!-- Submit and Additional Links -->
                  <div class="col-md-12 text-center mt-4">
                    <p>Don't have an account? <a href="{{ route('register') }}" class="text-primary">Sign up here</a></p>
                    <button type="submit" class="btn btn-primary ms-3">
                      Log in
                    </button>
                  </div>
                </div>
              </form>
            </div>
          </div>
          <!-- /Card Layout -->
        </div>
      </div>
    </section>
    <!-- /Login Section -->
  </main>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>
