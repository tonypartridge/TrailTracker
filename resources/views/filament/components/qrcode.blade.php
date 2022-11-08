@php
    use Hashids\Hashids;
    $hasher = new Hashids();
    $hashedId = $hasher->encodeHex($record->id + 1000000000);
@endphp

{!! QrCode::size(300)->generate(env('APP_URL') . '/qr-record/' . $hashedId) !!}
URL would be:
{{ env('APP_URL') . '/qr-record/' . $hashedId }}
<Br>Decoded URL would be:
{{ env('APP_URL') . '/qr-record/' . $record->id }}
