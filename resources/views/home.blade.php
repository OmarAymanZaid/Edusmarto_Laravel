<x-layout>
  <form method="POST" action="{{ route('logout') }}">
        @csrf
        
        <button type="submit" style="color: white" class="btn btn-info">Logout</button>
  </form>
</x-layout>