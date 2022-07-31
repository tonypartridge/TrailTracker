{!! QrCode::size(300)->generate(env('APP_URL') . '/qr-record/' . sha1($record->id)) !!}
URL would be:
{{ env('APP_URL') . '/qr-record/' . sha1($record->id) }}
<Br>Decoded URL would be:
{{ env('APP_URL') . '/qr-record/' . $record->id }}
