<x-layout>

    <x-slot name="nav">
        <nav class="flex-1 p-4 space-y-2">
            <a href="{{ route('courses.assignedCourses') }}" class="flex items-center px-4 py-2 rounded hover:bg-blue-100 ">
                <i class="fa-solid fa-book"></i> <span class="ml-2">Courses</span>
            </a>
            <a href="{{ route('fellowTeachers.index') }}" class="flex items-center px-4 py-2 rounded hover:bg-blue-100">
                <i class="fa-solid fa-star"></i> <span class="ml-2">Evaluation</span>
            </a>
            <a href="{{ route('materials.coursesToUploadeMaterialFor') }}" class="flex items-center px-4 py-2 rounded hover:bg-blue-100">
                <i class="fa-solid fa-note-sticky"></i> <span class="ml-2">Material</span>
            </a>
            <a href="{{ route('courses.submittedAssignments') }}" class="flex items-center px-4 py-2 rounded hover:bg-blue-100">
                <i class="fa-solid fa-clipboard"></i> <span class="ml-2">Assignments</span>
            </a>
        </nav>
    </x-slot>

    {{ $slot }}
    
</x-layout>