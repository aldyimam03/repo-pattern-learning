<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Verifiy User</title>
</head>

<body>

    <h3>Halo, {{ $user->name }}</h3>
    <p>Silakan klik tombol berikut untuk memverifikasi akun Anda:</p>

    <button>
        <div class="bg-blue-500 text-white" >
            <a href="{{ $verificationUrl }}">Verifikasi Sekarang</a>
        </div>

    </button>

    <p>Link ini akan kedaluwarsa dalam 60 menit.</p>

</body>

</html>
