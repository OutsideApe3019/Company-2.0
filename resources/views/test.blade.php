@php
    use Illuminate\Support\Facades\Storage;
    
    $file = Storage::get('logs/app.log');
    $html = '';
    
    foreach (preg_split("/((\r?\n)|(\r\n?))/", $file) as $line) {
        $msg = Str::afterLast($line, ':');
        $date = Str::betweenFirst($line, '[', ']');
        $typeFix = Str::afterLast($line, '.');
        $type = Str::before($typeFix, ':');
        if ($line == '') {
            continue;
        }
        $html .= "$date [$type] $msg<br>";
    }
@endphp

<!DOCTYPE html>
<html>
    <head>
        <title>{{ config('app.name') }} test page</title>
        @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    </head>
<body>
    {!! $html !!}
</body>
</html>