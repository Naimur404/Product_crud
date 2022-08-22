<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">

    <link rel="icon" type="image/png" href="uploads/favicon.png">

    <title>User</title>

    @include('admin.components.head')
</head>

<body>
<div id="app">
    <div class="main-wrapper">
       @yield('form')
    </div>
</div>
@include('admin.components.script_footer')
</body>
</html>
