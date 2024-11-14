<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Register</title>
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
    <!-- Register Section -->
    <section id="register" class="register section">
      <div class="container" data-aos="fade-up" data-aos-delay="100">
        <div class="col-lg-6 mx-auto">
          <div class="card p-4">
            <h3 class="text-center mb-4">Create an Account</h3><hr>

            <!-- Session Status -->
            @if(session('status'))
              <div class="mb-4 text-success">
                {{ session('status') }}
              </div>
            @endif

            <form method="POST" action="{{ route('register') }}" data-aos="fade-up" data-aos-delay="200">
              @csrf

              <div class="row gy-4">
                <!-- Name -->
                <div class="col-md-12">
                  <label for="name" class="pb-2">Your Name</label>
                  <input id="name" class="form-control" type="text" name="name" value="{{ old('name') }}" required autofocus>
                  @error('name')
                    <div class="text-danger mt-2">{{ $message }}</div>
                  @enderror
                </div>

                <!-- Email Address -->
                <div class="col-md-12 mt-4">
                  <label for="email" class="pb-2">Your Email</label>
                  <input id="email" class="form-control" type="email" name="email" value="{{ old('email') }}" required>
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

                <!-- Confirm Password -->
                <div class="col-md-12 mt-4">
                  <label for="password_confirmation" class="pb-2">Confirm Password</label>
                  <input id="password_confirmation" class="form-control" type="password" name="password_confirmation" required>
                  @error('password_confirmation')
                    <div class="text-danger mt-2">{{ $message }}</div>
                  @enderror
                </div>

                <!-- Already have an account? -->
                <div class="col-md-12 mt-4 text-center">
                  <p>Already have an account? <a href="{{ route('login') }}" class="text-primary">Login here</a></p>
                </div>

                <!-- Submit Button -->
                <div class="col-md-12 text-center mt-4">
                  <button type="submit" class="btn btn-primary">
                    Register
                  </button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </section>
    <!-- /Register Section -->
  </main>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- Main JS File -->
  <script src="assets/js/main.js"></script>

</body>
</html>
