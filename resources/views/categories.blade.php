<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Categories</title>
</head>
<body>
    <h1>Categories</h1>

    <!-- Form untuk menambahkan kategori baru -->
    <form action="{{ route('categories.store') }}" method="POST">
        @csrf
        <input type="text" name="name" placeholder="Category Name" required>
        <textarea name="description" placeholder="Description"></textarea>
        <button type="submit">Add Category</button>
    </form>

    <!-- Daftar semua kategori -->
    <h2>All Categories</h2>
    <ul>
        @foreach ($categories as $category)
            <li>{{ $category->name }} - {{ $category->description }}</li>
        @endforeach
    </ul>
</body>
</html>
