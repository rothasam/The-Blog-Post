<header class="bg-white">
  <nav class="mx-auto flex max-w-7xl items-center justify-between p-6 lg:px-8" aria-label="Global">
    <div class="flex lg:flex-1">
      <a href="#" class="-m-1.5 p-1.5">
        <span class="sr-only">Your Company</span>
        <img class="h-8 w-auto" src="https://tailwindcss.com/plus-assets/img/logos/mark.svg?color=indigo&shade=600" alt="" />
      </a>
    </div>
    
    <div class="lg:flex lg:gap-x-12">
     

      <a href="#" class="text-sm/6 font-semibold text-gray-900">Home</a>
      <a href="#" class="text-sm/6 font-semibold text-gray-900">Marketplace</a>
      <a href="{{ route('posts.create') }}" class="text-sm/6 font-semibold text-gray-900">CREATE POST</a>
    </div>
    <div class="lg:flex lg:flex-1 lg:justify-end">
      <a href="{{ url('auth/login') }}" class="text-sm/6 font-semibold text-gray-900">Log in <span aria-hidden="true">&rarr;</span></a>
    </div>
  </nav>
</header>
