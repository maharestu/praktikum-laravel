<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Escape Blade Syntax</title>
</head>
<body>
    <P>Memanggil {{$nama}}, bukan kodenya.</P>
    <p>Memanggil @{{ $nama }}, pakai @ di depannya.</p>
    @if (true)
        <p>Ini syntax if pada blade.</p>
    @endif
    @verbatim
        <p><b> ini syntax if-nya di dalam verbatim:</b></p>
        @if (true)
            <p>Ini syntax if pada blade.</p>
        @endif
    @endverbatim
        
</body>
</html>