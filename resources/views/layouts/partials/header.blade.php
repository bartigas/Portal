<div class="flex items-center justify-between h-16 px-4 sm:px-6 lg:px-8">
    <!-- Mobile menu button -->
    <button 
        type="button" 
        class="lg:hidden -ml-0.5 -mt-0.5 h-12 w-12 inline-flex items-center justify-center rounded-md text-gray-500 hover:text-gray-900"
        @click="mobileMenuOpen = !mobileMenuOpen"
    >
        <span class="sr-only">Open sidebar</span>
        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
        </svg>
    </button>

    <!-- Project Name -->
    <div class="flex-1 min-w-0 ml-4 lg:ml-0">
        <h1 class="text-lg font-medium leading-7 text-gray-900 sm:truncate">
            <a href="{{ route('dashboard') }}" class="hover:underline">
                {{ config('app.name', 'Portal') }}
            </a>
        </h1>
    </div>

    <!-- User menu -->
    <div class="ml-4 flex items-center lg:ml-6">
        <div class="relative" x-data="{ userMenuOpen: false }">
            <button 
                type="button" 
                @click="userMenuOpen = !userMenuOpen"
                class="max-w-xs bg-white flex items-center text-sm rounded-full focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500"
            >
                <span class="sr-only">Open user menu</span>
                @auth
                    <img 
                        class="h-8 w-8 rounded-full" 
                        src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=0D8ABC&color=fff" 
                        alt="{{ Auth::user()->name }}"
                    >
                @else
                    <svg class="h-8 w-8 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a4 4 0 00-4-4H8a4 4 0 00-4 4v2a2 2 0 002 2h8a2 2 0 002-2v-2a4 4 0 00-4-4z" />
                    </svg>
                @endauth
            </button>

            @auth
            <div 
                x-show="userMenuOpen"
                x-transition:enter="transition ease-out duration-100"
                x-transition:enter-start="transform opacity-0 scale-95"
                x-transition:enter-end="transform opacity-100 scale-100"
                x-transition:leave="transition ease-in duration-75"
                x-transition:leave-start="transform opacity-100 scale-100"
                x-transition:leave-end="transform opacity-0 scale-95"
                class="origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg py-1 bg-white ring-1 ring-black ring-opacity-5 focus:outline-none z-50"
                role="menu" 
                aria-orientation="vertical" 
                aria-labelledby="user-menu-button" 
                tabindex="-1"
                @click.outside="userMenuOpen = false"
            >
                <div class="px-4 py-3" role="none">
                    <p class="text-sm" role="none">
                        Signed in as
                    </p>
                    <p class="text-sm font-medium text-gray-900 truncate" role="none">
                        {{ Auth::user()->name }}
                    </p>
                </div>
                <div class="border-t border-gray-200" role="none">
                    {{-- Temporarily removed profile edit link
                    <a 
                        href="{{ route('profile.edit') }}" 
                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" 
                        role="menuitem" 
                        tabindex="-1"
                    >
                        Profile
                    </a>
                    --}}
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button 
                            type="submit" 
                            class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                            role="menuitem" 
                            tabindex="-1"
                        >
                            Sign out
                        </button>
                    </form>
                </div>
            </div>
            @endauth
        </div>
    </div>
</div>
