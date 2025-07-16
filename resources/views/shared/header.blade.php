


<header class="bg-gradient-to-r from-indigo-600 to-purple-600 shadow-md " >
    <nav class="mx-auto flex max-w-7xl items-center justify-between p-4 lg:px-8 text-white" aria-label="Global">
        <!-- Logo -->
        <div class="flex items-center gap-3 ">
            <a href="{{ route('posts.index') }}" class="flex items-center gap-2">
                <!-- <img class="h-8 w-auto" src="https://tailwindcss.com/plus-assets/img/logos/mark.svg?color=indigo&shade=600" alt="Logo"> -->
                <span class="font-bold text-lg">BlogFlow</span>
            </a>
        </div>

        <!-- Main Navigation -->
        <div class="hidden lg:flex gap-6">
            <!-- <a href="{{ route('posts.index') }}" class="text-sm font-medium hover:text-gray-200">🏠 Home</a>
            <a href="{{ route('bookmarks.index') }}" class="text-sm font-medium hover:text-gray-200">🔖 Bookmarks</a> -->
           
            <input type="text" placeholder="Search post and user" class="w-[500px] px-5 py-3 rounded-full bg-white/15 border border-white/20 backdrop-blur-md placeholder-white text-white focus:outline-none">
            

           
            
        </div>

        <!-- Action Buttons -->
        <div class="flex items-center gap-3">
            <!-- Become Author Button -->
            @auth
            @if(auth()->user()->role_id == 3)
                <a href="{{ route('author_request.create') }}"
                  class="inline-flex items-center px-3 py-1.5 bg-white text-indigo-700 font-medium rounded-full hover:bg-indigo-100 text-sm shadow">
                  <img src="{{ asset('images/icons/sparkles.svg') }}" alt="Icon" class="w-5 h-5 mr-1">
                   Become an Author
              </a>
            @endif

            @endauth

            @auth
              @if(auth()->user()->role_id != 3)
              
                    <a href="{{ route('posts.create') }}"
                        class="inline-flex items-center px-3 py-1.5 bg-white text-indigo-700 font-medium rounded-full hover:bg-indigo-100 text-sm shadow">
                        <img src="{{ asset('images/icons/writing-hand-svgrepo-com.svg') }}" alt="Icon" class="w-5 h-5 mr-1">
                        Create Post
                    </a>
              @endif
           @endauth

            <!-- Profile Dropdown -->
@if(auth()->check())
            <div class="relative">
            <button id="profileDropdownButton" data-dropdown-toggle="profileDropdown"
                class="flex items-center space-x-2 bg-white/10 hover:bg-white/20 rounded-full px-4 py-2 text-white transition focus:outline-none focus:ring-2 focus:ring-white">
                <img src="{{ asset('images/icons/user-1-svgrepo-com.svg') }}" alt="Profile" class="w-8 h-8 rounded-full object-cover">
                <span class="hidden sm:block font-medium">{{ auth()->user()->first_name }}</span>
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2"
                     viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"></path>
                </svg>
            </button>

            <!-- Dropdown Menu -->
            <div id="profileDropdown"
                class="hidden absolute right-0 z-10 mt-2 w-48 bg-white rounded-lg shadow-lg border border-gray-200">
                <div class="px-4 py-3 text-sm text-gray-900 border-b">
                    <div class="font-medium">{{ auth()->user()->first_name . ' ' . auth()->user()->last_name}}</div>
                    <div class="text-xs text-gray-500">{{ auth()->user()->email }}</div>
                </div>
                <ul class="py-2 text-sm text-gray-700">
                    <li>
                        <a href="{{ route('profile') }}" class="flex px-4 py-2 hover:bg-gray-100">
                            <img src="{{ asset('images/icons/user-account-person-avatar-svgrepo-com.svg') }}" alt="Icom" class="w-5 h-5 mr-2">
                             Profile
                        </a>
                    </li>
                    <li>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class=" flex w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-gray-100">
                                <img src="{{ asset('images/icons/logout.svg') }}" alt="Icom" class="w-5 h-5 mr-2">
                                Logout
                            </button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
@else
    <a href="{{ route('login') }}"
        class="inline-flex items-center px-3 py-1.5 bg-white text-indigo-700 font-medium rounded-full hover:bg-indigo-100 text-sm shadow">
        <img src="{{ asset('images/icons/login-svgrepo-com.svg') }}" alt="icon" class="w-5 h-5 mr-2"> Login
    </a>
    <a href="{{ route('register') }}"
    class="inline-flex items-center px-3 py-1.5 bg-white text-indigo-700 font-medium rounded-full hover:bg-indigo-100 text-sm shadow">
    <img src="{{ asset('images/icons/add-user-7-svgrepo-com.svg') }}" alt="icon" class="w-5 h-5 mr-2"> 
        Register
    </a>
@endif
        </div>
    </nav>
</header>
