<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PRODOVI</title>
     <link rel="stylesheet" href="{{ asset('css/welcome.css') }}">
     <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Rowdies:wght@300;400;700&family=Varela+Round&display=swap" rel="stylesheet">
     
</head>
<body >
    @include('componentes.navbar')
    @include('componentes.container1')
    @include('componentes.footer')


    <script src="{{ asset('js/welcome.js') }}"></script>
    @include('a.css.hero.container1')
    @include('a.js.hero.welcome')
    
</body>
</html>
