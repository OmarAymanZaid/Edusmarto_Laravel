<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">
  <title>LMS Register Form</title>
</head>
<body class="form-body">
  <form class="register-form" method="POST" action="{{ route('register') }}">
    @csrf

    <h2>Register</h2>

    <div class="form-group">
      <label for="fullname">Name</label>
      <input type="text" id="fullname" name="name" placeholder="John Doe" value="{{ old('name') }}"  required />
    </div>

    <div class="form-group">
      <label for="email">Email Address</label>
      <input type="email" id="email" name="email" placeholder="you@example.com" value="{{ old('email') }}"  required />
    </div>

    <div class="form-group">
      <label for="password">Password</label>
      <input type="password" id="password" name="password" placeholder="Enter a strong password" required />
    </div>

    <div class="form-group">
      <label for="password">Confirm Password</label>
      <input type="password" id="password" name="password_confirmation" placeholder="Enter a strong password" required />
    </div>

    <div class="form-group">
      <label for="roleID">Role</label>
      <select id="roleID" name="roleID" required>
        <option value="" disabled selected>Select your role</option>
        <option {{ old('roleID') == '1' ? 'selected' : '' }} value="1">Admin</option>
        <option {{ old('roleID') == '2' ? 'selected' : '' }} value="2">Student</option>
        <option {{ old('roleID') == '3' ? 'selected' : '' }} value="3">Teacher</option>
      </select>
    </div>

    <button type="submit" class="submit-btn">Register</button>

    <div class="login-link">
      Already have an account? <a href="{{ route('login.show') }}">Login here</a>
    </div>

    <br>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

  </form>
</body>
</html>
