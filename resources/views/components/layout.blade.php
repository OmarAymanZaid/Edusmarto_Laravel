<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
  <script src="https://cdn.tailwindcss.com"></script>
  <title>{{ $title ?? 'EduSmarto LMS' }}</title>
</head>
<body class="bg-gray-100 text-gray-900 flex h-screen">

    {{-- Sidebar --}}
    <aside class="w-64 bg-white shadow-md flex flex-col">

        <div class="p-6 border-b flex items-center justify-center">
            <img src="{{ asset('images/edusmarto-logo2_2.png') }}" alt="Logo" class="h-15">
        </div>

        {{ $nav }}

    </aside>

    {{-- Main Content --}}
    <div class="flex-1 flex flex-col">

      <header class="navbar">
        {{-- Search bar --}}
        <div class="search-container">
          <input type="text" placeholder="Search here…" class="search-input">
        </div>

        {{-- Right navbar icons --}}
        <div class="navbar-icons">

          <div class="icons d-flex" style="gap: 6px;">

              <div class="dropdown-wrapper">

                <div class="icon-container" id="announcementToggle">
                    <i class="fa-solid fa-envelope"></i>
                </div>

                <div class="dropdown-menu" id="announcementDropdown">
                  <p>No new announcements</p>
                </div>

              </div>

              <div class="dropdown-wrapper">

                <div class="icon-container" id="notificationToggle">
                    <i class="fa-solid fa-bell"></i>
                </div>

                <div class="dropdown-menu" id="notificationDropdown">
                  <p>No new notifications</p>
                </div>
              </div>

          </div>

          <div class="dropdown-wrapper">
            <div class="user-toggle" id="userToggle">
              <img class="user-photo" src="{{ asset('storage/' . Auth::user()->photo) }}" alt="User Photo">
              <span class="user-name">{{ Auth::user()->name }}</span>
            </div>

            <div class="dropdown-menu" id="userDropdown">

              <a href="{{ route('user.profile') }}">View Profile</a>
              <a>
                <form method="POST" action="{{ route('logout') }}" style="inline">
                      @csrf
                      <button type="submit" style="width:100%; text-align:start;">Logout</button>
                </form>
              </a>
            </div>

          </div>
        </div>
      </header>

      <main class="flex-1 p-6">
        {{ $slot }}        
      </main>

      <script src="{{ asset('js/master.js') }}"></script>
      <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    </div>
</body>
</html>
