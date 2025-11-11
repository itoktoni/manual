<!doctype html>
<html lang="en" moznomarginboxes mozdisallowselectionprint>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<head>
    @if($print == 'report')
    <link rel="stylesheet" href="{{ asset('css/report.css') }}" type="text/css">
    @else
    <link rel="stylesheet" href="{{ asset('css/print.css') }}" type="text/css">
    @endif
</head>

<body>

    {{ $slot }}

</body>

</html>
