<x-adminMain>
    <h1 class="text-4xl font-medium">Notifications</h1> <br>

    @if ($notifications->count() === 0)
        No Notifications Sent
    
    @else
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Text</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>

                @foreach ($notifications as $index => $notification)
                    <tr>
                        <th scope="row">{{ $index + 1 }}</th>
                        <td>{{ $notification->notificationText }}</td>
                        <td>
                            <div style="display: inline-block">
                                <button type="button"
                                        class="btn btn-danger open-delete-modal"
                                        data-form="#deleteNotificationForm{{ $notification->ID }}"
                                        data-name="this notification"
                                        >
                                    Delete
                                </button>
                                <form id="deleteNotificationForm{{ $notification->ID }}" action="{{ route('notifications.destroy', $notification->ID) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <x-deleteModal />
    
</x-adminMain>