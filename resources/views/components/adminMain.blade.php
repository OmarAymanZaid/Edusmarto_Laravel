<x-layout>

    <x-slot name="nav">
        <nav class="flex-1 p-4 space-y-2">
            <a href="{{ route('user.index') }}" class="flex items-center px-4 py-2 rounded hover:bg-blue-100 ">
                <i class="fa-solid fa-user-plus"></i> <span class="ml-2">Manage Users</span>
            </a>
            <a href="{{ route('courses.index') }}" class="flex items-center px-4 py-2 rounded hover:bg-blue-100">
                <i class="fa-solid fa-book"></i> <span class="ml-2">Manage Courses</span>
            </a>
            <a href="{{ route('questions.index') }}" class="flex items-center px-4 py-2 rounded hover:bg-blue-100">
                <i class="fa-solid fa-clipboard-check"></i> <span class="ml-2">Manage Evaluation</span>
            </a>
            <a href="{{ route('notifications.index') }}" class="flex items-center px-4 py-2 rounded hover:bg-blue-100">
                <i class="fa-solid fa-envelope-open"></i> <span class="ml-2">View Notifications</span>
            </a>
        </nav>
    </x-slot>

    {{ $slot }}
    
</x-layout>