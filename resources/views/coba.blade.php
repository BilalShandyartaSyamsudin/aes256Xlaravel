<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <div class="mx-auto my-auto w-full h-full">
        <form action="{{ route('coba.submit') }}" method="POST">
            @csrf
            <input type="text" name="coba" id="coba" value="coba">
            <button>Submit</button>
        </form>

        <textarea rows="10" cols="100" readonly>{{ json_encode($coba, JSON_PRETTY_PRINT) }}</textarea>
    </div>
</body>
</html>