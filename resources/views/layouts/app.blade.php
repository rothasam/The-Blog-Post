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

    {{-- 
    
    @auth
        @if(auth()->user()->role_id == 1)
            <header>
                @include('shared.admin_header')
            </header>
        @else
            <header>
            @yield('header') 
            </header>
        @endif

    @endauth

    --}}
    
    @auth
        @if(auth()->user()->role_id != 1 )
            {{-- <header>
                @yield('header') 
            </header> --}}

            @include('shared.header')
        @endif

    @endauth


    <!-- main content -->
    @if(auth()->check())
        @if(auth()->user()->role_id == 1)
            <main class="grid grid-cols-12 h-screen">
                <section class="col-span-3 bg-[#f5f7ff] px-8 shadow-md">
                    @include('shared.admin_sidebar')
                </section>
                <section class="col-span-9 bg-white h-screen overflow-y-scroll">
                    @include('shared.admin_header')
                    @yield('content')
                </section>
            </main>

        @elseif(auth()->user()->role_id == 2 || auth()->user()->role_id == 3)
            <main>
                @yield('content')
            </main>
            @include('shared.footer')
        @endif

    @else
        @if (!Request::is('login') && !Request::is('register'))
            @include('shared.header')
            <main>
                @yield('content')
            </main>
            @include('shared.footer')
        @else
            <main>
                @yield('content')
            </main>
        @endif
    @endif


    <!-- footer -->

   {{--  @yield('footer') --}}
   


    @vite('resources/js/app.js')   

    <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
    @yield('scripting')   

</body>
</html>