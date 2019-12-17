<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>書物管理</title>
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">

</head>
<body>
    <div id="app">
        <router-view></router-view>
    </div>


<script src="{{ mix('js/app.js') }}"></script> 
</body>
</html>