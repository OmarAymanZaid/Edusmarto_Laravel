<x-teacherMain>
    <form action="{{ route('announcements.storeAnnouncement', $courseID) }}" method="POST">
    @csrf

    <h1 class="text-3xl font-medium mb-3">Send Announcement</h1>
    <hr class="mb-3">

        <div class="mb-3">
            <textarea class="form-control h-32" id="send-announcement" name="announcementText" required> {{ old('announcementText') }} </textarea>
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

</x-teacherMain>