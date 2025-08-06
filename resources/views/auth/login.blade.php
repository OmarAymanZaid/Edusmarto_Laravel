<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">
  <title>LMS Login Form</title>
</head>
<body class="form-body">
  <form class="register-form" method="POST" action="{{ route('login') }}">
    @csrf

    <h2>Login</h2>

    <div class="form-group">
      <label for="email">Email Address</label>
      <input type="email" id="email" name="email" placeholder="you@example.com" value="{{ old('email') }}" required />
    </div>

    <div class="form-group">
      <label for="password">Password</label>
      <input type="password" id="password" name="password" placeholder="Enter a strong password" required />
    </div>

    <button type="submit" class="submit-btn">Login</button>

    <div class="login-link">
      Don't have an account? <a href="{{ route('register.show') }}">Register here</a>
    </div>

  </form>

  @if ($errors->any())
    <div class="alert alert-danger" role="alert">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
  @endif

</body>
</html>
