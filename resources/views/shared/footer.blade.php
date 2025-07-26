<footer class="bg-gradient-to-r from-indigo-600 to-purple-600 text-white mt-15">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-10 pb-5">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 ">

            <!-- Logo & Description -->
            <div>
                <div class="flex items-center gap-2 mb-3">
                     <img src="{{ asset('images/logo.png') }}" alt="" class="w-[100px] mb-4">
                </div>
                <p class="text-sm text-white/80">Your voice matters 📝 — Publish, explore, and engage with the community.</p>
            </div>

            <!-- Quick Links -->
            <div>
                <h4 class="text-md font-semibold mb-3">Quick Links</h4>
                <ul class="space-y-2 text-sm">
                    <li><a href="{{ route('posts.index') }}" class="hover:underline">🏠 Home</a></li>

                    @auth
                        @if(auth()->user()->role_id != 3)
                            <li><a href="{{ route('posts.create') }}" class="hover:underline">✍️ Create Post</a></li>
                        @endif

                        @if(auth()->user()->role_id == 3)
                            <li><a href="{{ route('author_request.create') }}" class="hover:underline">✨ Become Author</a></li>
                        @endif
                    @endauth
                    <li><a href="{{ route('bookmarks.index') }}" class="hover:underline">🔖 Bookmarks</a></li>
                    
                </ul>
            </div>

            <!-- Contact Info -->
            <div>
                <h4 class="text-md font-semibold mb-3">Contact Us</h4>
                <ul class="space-y-2 text-sm">
                    <li>Email: <a href="mailto:support@blogflow.com" class="hover:underline">support@blogflow.com</a></li>
                    <li>Location: Phnom Penh, Cambodia</li>
                </ul>
            </div>
        </div>

        <!-- Bottom -->
        <div class="border-t border-white/20 mt-8 pt-4 text-center text-sm text-white/80">
            &copy; {{ date('Y') }} BlogFlow. All rights reserved.
        </div>
    </div>
</footer>
