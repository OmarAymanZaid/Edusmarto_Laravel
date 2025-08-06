<x-layout>

    <x-slot name="nav">
        <nav class="flex-1 p-4 space-y-2">
            <a href="{{ route('courses.enrolledCourses') }}" class="flex items-center px-4 py-2 rounded hover:bg-blue-100 ">
                 <i class="fa-solid fa-book"></i> <span class="ml-2">Courses</span>
            </a>
            <a href="{{ route('teachers.index') }}" class="flex items-center px-4 py-2 rounded hover:bg-blue-100">
                <i class="fa-solid fa-user-plus"></i> <span class="ml-2">Teachers</span>
            </a>
            <a href="{{ route('courses.assignments') }}" class="flex items-center px-4 py-2 rounded hover:bg-blue-100">
                <i class="fa-solid fa-clipboard-check"></i> <span class="ml-2">Assignments</span>
            </a>
        </nav>
    </x-slot>

    {{ $slot }}
    
</x-layout>