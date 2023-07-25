<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        .b{
            color: blue;
            padding: 10px 15px 10px 15px;
        }
    </style>
</head>
<body>
    <p>
        Halo <b>{{$details['name']}}</b>!
    </p>
    <p>
        Berikut ini adalah data anda:
    </p>
    <table class="table">
        <tr>
            <td>Username</td>
            <td>:</td>
            <td>{{$details['name']}}</td>
        </tr>
        <tr>
            <td>Role</td>
            <td>:</td>
            <td>{{$details['role']}}</td>
        </tr>
        <tr>
            <td>Website</td>
            <td>:</td>
            <td>{{$details['website']}}</td>
        </tr>
        <tr>
            <td>Tanggal Register</td>
            <td>:</td>
            <td>{{$details['datetime']}}</td>
        </tr>
    </table>
    <center>
        <h3>
            Klik link di bawah ini untuk verivikas akun anda
        </h3>
        <button><b class="b"><a href="http://{{$details['url']}}">Link</a></b></button>
    </center>
    <p>
        Terima kasih telah melakukan registrasi
    </p>
</body>
</html>
