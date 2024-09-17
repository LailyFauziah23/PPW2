<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Categories</title>
</head>
<body>
    <header>
        <h1>Categories</h1>
    </header>

    <!-- Form untuk menambahkan kategori baru -->
    <section>
        <h2>Add New Category</h2>
        <form action="{{ route('categories.store') }}" method="POST">
            @csrf
            <div style="margin-bottom: 1rem;">
                <label for="name">Category Name:</label>
                <input type="text" id="name" name="name" placeholder="Category Name" required style="display: block; width: 100%; padding: 0.5rem; border: 1px solid #ccc; border-radius: 4px;">
            </div>
            <div style="margin-bottom: 1rem;">
                <label for="description">Description:</label>
                <textarea id="description" name="description" placeholder="Description" rows="4" style="display: block; width: 100%; padding: 0.5rem; border: 1px solid #ccc; border-radius: 4px;"></textarea>
            </div>
            <button type="submit" style="padding: 0.5rem 1rem; border: none; background-color: #007bff; color: white; border-radius: 4px; cursor: pointer;">
                Add Category
            </button>
        </form>
    </section>

    <!-- Daftar semua kategori -->
    <section>
        <h2>All Categories</h2>
        <ul style="padding-left: 1rem;">
            @foreach ($categories as $category)
                <li style="margin-bottom: 0.5rem; padding: 0.5rem; border: 1px solid #ddd; border-radius: 4px;">
                    <strong>{{ $category->name }}</strong> - {{ $category->description }}
                </li>
            @endforeach
        </ul>
    </section>
    <section>
        <table class="table table-stripped">
            <thead>
                <tr>
                    <th>id</th>
                    <th>Judul Buku</th>
                    <th>Penulis</th>
                    <th>Harga</th>
                    <th>Tanggal Terbit</th>
                    <th>Aksi</th>
            </thead>
            <tbody>
                @foreach($data_buku as $buku)
                <tr>
                    <td>{{$buku->id}}</td>
                    <td>{{$buku->judul}}</td>
                    <td>{{$buku->penulis}}</td>
                    <td>{{"Rp. ".number_format($buku->harga, 2, ',', '.')}}</td>
                    <td>{{$buku->tgl_terbit->format(d/m/Y)}}</td>
                </tr>
                @endforeach
            </tbody>
    </section>
</body>
</html>
