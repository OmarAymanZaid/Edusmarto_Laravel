<x-adminMain>
    <form action="{{ route('notifications.update', $userID) }}" method="POST">
    @csrf
    @method('PUT')

    <h1 class="text-3xl font-medium mb-3">Send Notification</h1>
    <hr class="mb-3">

        <div class="mb-3">
            <label for="send-notification" class="form-label">Text</label>
            <input type="text" class="form-control h-32" id="send-notification" name="notificationText" value="{{ old('notificationText') }}" required>
        </div>     

        <button type="submit" class="btn btn-primary">Send</button>
    </form>

    @if ($errors->any())
        <div class="alert alert-danger mt-3">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

</x-adminMain>