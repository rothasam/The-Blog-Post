
<div class="bg-gradient-to-r  from-indigo-500 via-purple-600 to-indigo-700 shadow-md sticky top-0 z-30 mb-12">
    <div class="max-w-7xl mx-auto px-9 flex items-center justify-between h-[90px] ">
        <!-- Title -->
         @php
            $route = Route::currentRouteName();

            $titles = [
                'admin.dashboard' => ['icon' => 'analysis-seo-graph-svgrepo-com.svg', 'title' => 'Dashboard Overview'],
                'admin.posts.index' => ['icon' => 'content-marketing-management-seo-svgrepo-com.svg', 'title' => 'Post Management'],
                'admin.posts.show' => ['icon' => 'writing-hand-svgrepo-com.svg', 'title' => 'Detail Blog'],
                'admin.users.index' => ['icon' => 'user-1-svgrepo-com.svg', 'title' => 'User Management'],
                'admin.author_request.index' => ['icon' => 'mail-svgrepo-com.svg', 'title' => 'Author Request'],
                'admin.categories.index' => ['icon' => 'folder-svgrepo-com.svg', 'title' => 'Category Management'],
                'admin.profile.index' => ['icon' => 'user-account-person-avatar-svgrepo-com.svg', 'title' => 'Profile'],
            ];

            $current = $titles[$route] ?? ['icon' => 'default.svg', 'title' => 'Admin Panel']; // null or not found use the right which is the default one
        @endphp

            <h1 class="flex items-center justify-center gap-3 text-white text-3xl font-semibold tracking-wide">
                <img src="{{ asset('images/icons/' . $current['icon']) }}" alt="Icon" class="w-7 h-7">
                {{ $current['title'] }}
            </h1>

        

        <!-- Profile Dropdown -->
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
                    <div class="font-medium">{{ auth()->user()->first_name . ' ' . auth()->user()->last_name }}</div>
                    <div class="text-xs text-gray-500">{{ auth()->user()->email }}</div>
                </div>
                <ul class="py-2 text-sm text-gray-700">
                    <li>
                        <a href="#" class="px-4 py-2 hover:bg-gray-100 flex">
                            <img src="{{ asset('images/icons/user-account-person-avatar-svgrepo-com.svg') }}" alt="Icom" class="w-5 h-5 mr-2">
                            Profile
                        </a>
                    </li>
                    <li>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="flex w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-gray-100">
                                <img src="{{ asset('images/icons/logout.svg') }}" alt="Icom" class="w-5 h-5 mr-2">
                                🔓 Logout
                            </button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
