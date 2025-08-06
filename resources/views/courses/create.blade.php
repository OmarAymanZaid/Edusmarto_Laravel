<x-adminMain>

    <form action="{{ route('courses.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <h1 class="text-3xl font-medium mb-3">Add Course</h1>
    <hr class="mb-3">

        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <input type="text" class="form-control" id="description" name="description" value="{{ old('description') }}" required>
        </div>

        <div class="form-group">
            <label for="category">Category</label>
            <select id="category" name="categoryID" required>
                <option value="" disabled selected>Select Category</option>
                @foreach($categories as $category)
                    <option @selected(old('categoryID') == $category->ID) value='{{ $category->ID }}'>{{ $category->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="formFile" class="form-label">Upload Image</label>
            <input class="form-control" type="file" id="formFile" name='image'>
        </div>        

        <button type="submit" class="btn btn-success">Add</button>
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