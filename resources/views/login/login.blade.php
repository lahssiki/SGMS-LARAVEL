<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login | Security Guard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<style>
.gradient-custom {
    background: linear-gradient(to right, #fefefe, #7c7c7c);
}
</style>

<body>
<section class="vh-100 gradient-custom">
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-md-6 col-lg-5">
        <div class="card bg-dark text-white shadow" style="border-radius: 1rem;">
          <div class="card-body p-4 text-center">

            <h2 class="fw-bold mb-2 text-uppercase">Login</h2>
            <p class="text-white-50 mb-4">Connectez-vous à votre compte</p>

            {{-- Errors --}}
            @if ($errors->any())
                <div class="alert alert-danger text-start">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('login.login') }}" method="POST">
                @csrf

                <!-- Email -->
                <div class="form-outline mb-3 text-start">
                    <label class="form-label">Email</label>
                    <input
                        type="email"
                        name="email"
                        class="form-control form-control-lg"
                        value="{{ old('email') }}"
                        required
                    >
                </div>

                <!-- Password -->
                <div class="form-outline mb-3 text-start">
                    <label class="form-label">Password</label>
                    <input
                        type="password"
                        name="password"
                        class="form-control form-control-lg"
                        required
                    >
                </div>

                <!-- Remember me -->
                <div class="form-check mb-3 text-start">
                    <input class="form-check-input" type="checkbox" name="remember" id="remember">
                    <label class="form-check-label" for="remember">
                        Remember me
                    </label>
                </div>

                <button class="btn btn-outline-light btn-lg w-100">
                    Login
                </button>
            </form>

            <hr class="my-4">

            <p class="small text-white-50">
                © {{ date('Y') }} Security Guard System
            </p>

          </div>
        </div>
      </div>
    </div>
  </div>
</section>
</body>
</html>
