<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    @yield('title')  

    @vite(['resources/css/app.css','resources/css/main.css'])  

    @yield('styling') 

</head>
<body>

    <!-- Header section -->
    <header>
       @yield('header') 
    </header>
    
    <!-- main content -->
    <main>
        @yield('content')
    </main>

    <!-- footer -->
    <footer>
        @yield('footer')
    </footer>

    @vite('resources/js/app.js')   

    @yield('scripting')   

</body>
</html>