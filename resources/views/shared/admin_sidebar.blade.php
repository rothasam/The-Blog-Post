    
<div class="">
    <!-- Section: Content -->
    <div class="mb-8">
        {{-- 
        
        <h2 class="text-sm font-bold text-gray-700 mb-4 flex items-center gap-2">
            <span class="flex items-center justify-center px-2 py-1 rounded">
                <img src="{{ asset('images/icons/analysis-seo-graph-svgrepo-com.svg') }}" alt="Icon" class="w-7 h-7 mr-1">
                Dashboard
            </span>
        </h2>

        --}}


        <ul class="space-y-2">
            <li class="h-[90px] flex justify-between items-center">
                <h2 class="text-2xl md:text-3xl font-bold  text-red-800 flex items-center gap-2">
                    🛠️Blog
                </h2>
            </li>
            <li>
                <a href="{{ route('admin.dashboard') }}"
                class="flex items-center gap-2 px-4 py-2 rounded-lg font-medium shadow-sm
                        {{ request()->routeIs('admin.dashboard') ? 'bg-indigo-500 text-white' : 'bg-white text-gray-700 hover:bg-indigo-100 transition' }}">
                    <img src="{{ asset('images/icons/analysis-seo-graph-svgrepo-com.svg') }}" alt="Icon" class="w-5 h-5 mr-1">
                    Dashboard
                </a>
            </li>

            <li>
                <a href="{{ route('admin.posts.index') }}"
                class="flex items-center gap-2 px-4 py-2 rounded-lg font-medium shadow-sm
                        {{ request()->routeIs('admin.posts.index') ? 'bg-indigo-500 text-white' : 'bg-white text-gray-700 hover:bg-indigo-100 transition' }}">
                    <img src="{{ asset('images/icons/content-marketing-management-seo-svgrepo-com.svg') }}" alt="Icon" class="w-5 h-5 mr-1">
                    Post 
                </a>
            </li>

            <li>
                <a href="{{ route('admin.users.index') }}"
                class="flex items-center gap-2 px-4 py-2 rounded-lg font-medium shadow-sm
                        {{ request()->routeIs('admin.users.index') ? 'bg-indigo-500 text-white' : 'bg-white text-gray-700 hover:bg-indigo-100 transition' }}">
                    <img src="{{ asset('images/icons/user-1-svgrepo-com.svg') }}" alt="Icon" class="w-5 h-5 mr-1">
                    User 
                </a>
            </li>

            <li>
                <a href="{{ route('admin.author_request.index') }}"
                class="flex items-center gap-2 px-4 py-2 rounded-lg font-medium shadow-sm
                        {{ request()->routeIs('admin.author_request.index') ? 'bg-indigo-500 text-white' : 'bg-white text-gray-700 hover:bg-indigo-100 transition' }}">
                    <img src="{{ asset('images/icons/mail-svgrepo-com.svg') }}" alt="Icon" class="w-5 h-5 mr-1">
                    Request 
                </a>
            </li>
            
            
            <li>
                <a href="{{ route('admin.categories.index') }}"
                class="flex items-center gap-2 px-4 py-2 rounded-lg font-medium shadow-sm
                        {{ request()->routeIs('admin.categories.index') ? 'bg-indigo-500 text-white' : 'bg-white text-gray-700 hover:bg-indigo-100 transition' }}">
                        <img src="{{ asset('images/icons/folder-svgrepo-com.svg') }}" alt="Icon" class="w-5 h-5 mr-1">
                    Categories 
                    
                </a>
            </li>
        </ul>
    </div>

    <!-- Section: Settings -->
    <div>
        {{-- 
        <h2 class="text-sm font-bold text-gray-700 mb-4 flex items-center gap-2">
            ⚙️ Settings
        </h2>

        --}}

        <ul class="space-y-2">
            <li>
                <a href="{{ route('admin.profile.index') }}"
                class="flex items-center gap-2 px-4 py-2 rounded-lg font-medium shadow-sm
                        {{ request()->routeIs('admin.profile.index') ? 'bg-indigo-500 text-white' : 'bg-white text-gray-700 hover:bg-indigo-100 transition' }}">
                    <img src="{{ asset('images/icons/user-account-person-avatar-svgrepo-com.svg') }}" alt="Icon" class="w-5 h-5 mr-1"> 
                    Profile
                    
                </a>
            </li>
        </ul>
    </div>
</div>
