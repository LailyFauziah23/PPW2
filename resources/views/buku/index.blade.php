<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <title>Buku</title>
</head>
<body>
    <table class="table table-stripped">
    <thead>
        <tr>
            <th>id</th>
            <th>Judul Buku</th>
            <th>Penulis</th>
            <th>Harga</th>
            <th>Tanggal Terbit</th>
            <th>Tanggal Edit</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach($data_buku as $index => $buku)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $buku->judul }}</td>
                <td>{{ $buku->penulis }}</td>
                <td>{{ "Rp. ".number_format($buku->harga, 2, ',', '.') }}</td>
                <td>{{ \Carbon\Carbon::parse($buku->tgl_terbit)->format('d-m-Y') }}</td>
                <td>{{ \Carbon\Carbon::parse($buku->tgl_terbit)->format('d/m/Y') }}</td>
                <td> 
                    <form action="{{ route('buku.destroy', $buku->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button onclick="return confirm('Yakin mau di hapus?')" 
                        type="submit" class="btn btn-danger">Hapus</button> 
                    </form>
                </td>
                <td>
                     <a href="{{ route('buku.edit', $buku->id) }}" class="btn btn-warning">Edit</a>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

<p><strong>Jumlah Buku:</strong> {{ $jumlah_buku }}</p>

<p><strong>Total Harga Semua Buku:</strong> Rp. {{ number_format($total_harga, 2, ',', '.') }}</p>

<!-- pertemuan 6 -->
 <!-- resources> views> buku> index.blade.php -->
<a href = "{{ route ('buku.create') }}" class = "btn btn-primary float-end">Tambah Buku </a>
<table class = "table table-stripped">
    <thead>
        <tr>
            <!-- <th>id</th> -->
        </tr>
    </thead>
</table>

</body>
</html>