<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>unless, isset, dan empty</title>
</head>
<body>
    <h2>@@unless</h2>

    @unless ($isLogin)  
        <p>Silakan login terlebih dahulu.</p>
    @endunless

    <h2>@@isset</h2>

    @isset($nama)   
        <p>Nama tersedia: {{ $nama }}</p>
    @endisset

    <h2>@@empty</h2>

    @empty($produk) 
        <p>Produk kosong.</p>
    @else
        <p>Produk tersedia.</p>
    @endempty
</body>
</html>