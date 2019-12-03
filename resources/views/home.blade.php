<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>書物管理</title>
<link rel="stylesheet" href="{{ mix('css/app.css') }}">
</head>
<body>
    <div id="app">
        <all-book-component books="{{ json_encode($books) }}"></all-book-component>
    </div>


<script src="{{ mix('js/app.js') }}"></script> 
</body>
</html>