<!DOCTYPE html>
<html>
<head>
    <title>WEbsite</title>
</head>
<body>
    <h1>WEbsite</h1>
    <p> {{ $subject }}</p>
    <p>{{ $emailMessage }}</p>
    @if($attachmentName)
    <p><strong>Tệp đính kèm:</strong></p>
    <p><a href="{{ asset('storage/'. $attachmentName) }}">{{ $attachmentName }}</a></p>
    @endif
</body>
</html>
