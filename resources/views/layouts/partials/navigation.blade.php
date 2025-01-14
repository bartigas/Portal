{{ $activeSection = $activeSection ?? null }}

<nav 
    x-data="{ 
        mobileMenuOpen: false,
        activeSection: null,
        toggleSection(section) {
            this.activeSection = (this.activeSection === section) ? null : section;
        },
        toggleMobileMenu() {
            this.mobileMenuOpen = !this.mobileMenuOpen;
        }
    }" 
    class="relative"
>
    <!-- Mobile Menu Toggle (Hidden on Desktop) -->
    <button 
        @click="toggleMobileMenu()"
        class="md:hidden fixed top-4 right-4 z-50 p-2 text-gray-600 hover:bg-gray-100 rounded-md"
    >
        <span class="sr-only">Toggle Mobile Menu</span>
        <svg 
            x-show="!mobileMenuOpen"
            class="h-6 w-6" 
            fill="none" 
            viewBox="0 0 24 24" 
            stroke="currentColor"
        >
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
        </svg>
        <svg 
            x-show="mobileMenuOpen"
            x-cloak
            class="h-6 w-6" 
            fill="none" 
            viewBox="0 0 24 24" 
            stroke="currentColor"
        >
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
        </svg>
    </button>

    <!-- Navigation Container -->
    <div class="flex">
        <!-- Desktop Navigation (Hidden on Mobile) -->
        <div 
            class="hidden md:block w-64 fixed left-0 top-0 bottom-0 bg-white border-r overflow-y-auto"
        >
            <div class="px-4 py-6">
                <!-- Logo or Brand -->
                <div class="flex items-center justify-center mb-8">
                    <span class="text-2xl font-bold text-gray-800">Portal</span>
                </div>

                <!-- Dashboard Link at the Top -->
                <a 
                    href="{{ route('dashboard') }}" 
                    class="group flex items-center px-2 py-2 text-sm font-medium rounded-md 
                    {{ request()->routeIs('dashboard') ? 'bg-gray-100 text-gray-900' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}"
                >
                    <svg 
                        class="mr-3 h-5 w-5 text-gray-400 group-hover:text-gray-500" 
                        fill="none" 
                        viewBox="0 0 24 24" 
                        stroke="currentColor"
                    >
                        <path 
                            stroke-linecap="round" 
                            stroke-linejoin="round" 
                            stroke-width="2" 
                            d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" 
                        />
                    </svg>
                    Dashboard
                </a>

                <div class="mt-4 border-t border-gray-200 pt-4">
                <!-- Desktop Navigation Items -->
                <div class="space-y-1">
                    <!-- Applications Section -->
                    <div class="space-y-1">
                        <button 
                            @click="toggleSection('applications')"
                            class="group w-full flex items-center pl-2 pr-1 py-2 text-sm font-medium rounded-md text-gray-600 hover:bg-gray-50 hover:text-gray-900"
                            :aria-expanded="activeSection === 'applications'"
                        >
                            <svg 
                                class="mr-3 h-5 w-5 text-gray-400 group-hover:text-gray-500 transition-transform duration-200" 
                                fill="none" 
                                viewBox="0 0 24 24" 
                                stroke="currentColor"
                                :class="{ 'rotate-90': activeSection === 'applications' }"
                            >
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                            Applications
                        </button>

                        <div 
                            x-show="activeSection === 'applications'" 
                            x-collapse 
                            class="space-y-1 pl-6"
                        >
                            <a 
                                href="{{ route('dashboard') }}" 
                                class="group flex items-center px-2 py-2 text-sm font-medium rounded-md {{ request()->routeIs('dashboard') ? 'bg-gray-100 text-gray-900' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}"
                            >
                                Dashboard
                            </a>
                            <!-- Add more application links here -->
                        </div>
                    </div>

                    <!-- Tools Section -->
                    <div class="space-y-1">
                        <button 
                            @click="toggleSection('tools')"
                            class="group w-full flex items-center pl-2 pr-1 py-2 text-sm font-medium rounded-md text-gray-600 hover:bg-gray-50 hover:text-gray-900"
                            :aria-expanded="activeSection === 'tools'"
                        >
                            <svg 
                                class="mr-3 h-5 w-5 text-gray-400 group-hover:text-gray-500 transition-transform duration-200" 
                                fill="none" 
                                viewBox="0 0 24 24" 
                                stroke="currentColor"
                                :class="{ 'rotate-90': activeSection === 'tools' }"
                            >
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                            Tools
                        </button>

                        <div 
                            x-show="activeSection === 'tools'" 
                            x-collapse 
                            class="space-y-1 pl-6"
                        >
                            <!-- Add tools links here -->
                        </div>
                    </div>

                    <!-- Admin Settings Section -->
                    <div class="space-y-1">
                        <button 
                            @click="toggleSection('admin')"
                            class="group w-full flex items-center pl-2 pr-1 py-2 text-sm font-medium rounded-md text-gray-600 hover:bg-gray-50 hover:text-gray-900"
                            :aria-expanded="activeSection === 'admin'"
                        >
                            <svg 
                                class="mr-3 h-5 w-5 text-gray-400 group-hover:text-gray-500 transition-transform duration-200" 
                                fill="none" 
                                viewBox="0 0 24 24" 
                                stroke="currentColor"
                                :class="{ 'rotate-90': activeSection === 'admin' }"
                            >
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                            Admin Settings
                        </button>

                        <div 
                            x-show="activeSection === 'admin'" 
                            x-collapse 
                            class="space-y-1 pl-6"
                        >
                            <!-- Add admin settings links here -->
                            <a 
                                href="{{ route('users.index') }}" 
                                class="group flex items-center px-2 py-2 text-sm font-medium rounded-md {{ request()->routeIs('users.index') ? 'bg-gray-100 text-gray-900' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}"
                            >
                                User Management
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Mobile Navigation Overlay (Visible on Mobile) -->
        <div 
            x-show="mobileMenuOpen"
            x-cloak
            @click.outside="mobileMenuOpen = false"
            class="fixed inset-0 z-40 md:hidden bg-gray-600 bg-opacity-50 overflow-y-auto"
        >
            <div 
                class="fixed inset-y-0 left-0 max-w-xs w-full bg-white shadow-xl py-4 px-4 overflow-y-auto"
                x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 transform -translate-x-full"
                x-transition:enter-end="opacity-100 transform translate-x-0"
                x-transition:leave="transition ease-in duration-200"
                x-transition:leave-start="opacity-100 transform translate-x-0"
                x-transition:leave-end="opacity-0 transform -translate-x-full"
            >
                <!-- Mobile Navigation Items -->
                <div class="space-y-1">
                    <!-- Mobile Logo -->
                    <div class="flex items-center justify-between mb-6">
                        <span class="text-2xl font-bold text-gray-800">Portal</span>
                        <button 
                            @click="mobileMenuOpen = false"
                            class="text-gray-600 hover:text-gray-900"
                        >
                            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>

                    <!-- Applications Section -->
                    <div class="space-y-1">
                        <button 
                            @click="toggleSection('applications')"
                            class="group w-full flex items-center pl-2 pr-1 py-2 text-sm font-medium rounded-md text-gray-600 hover:bg-gray-50 hover:text-gray-900"
                            :aria-expanded="activeSection === 'applications'"
                        >
                            <svg 
                                class="mr-3 h-5 w-5 text-gray-400 group-hover:text-gray-500 transition-transform duration-200" 
                                fill="none" 
                                viewBox="0 0 24 24" 
                                stroke="currentColor"
                                :class="{ 'rotate-90': activeSection === 'applications' }"
                            >
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                            Applications
                        </button>

                        <div 
                            x-show="activeSection === 'applications'" 
                            x-collapse 
                            class="space-y-1 pl-6"
                        >
                            <a 
                                href="{{ route('dashboard') }}" 
                                class="group flex items-center px-2 py-2 text-sm font-medium rounded-md {{ request()->routeIs('dashboard') ? 'bg-gray-100 text-gray-900' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}"
                            >
                                Dashboard
                            </a>
                            <!-- Add more application links here -->
                        </div>
                    </div>

                    <!-- Tools Section -->
                    <div class="space-y-1">
                        <button 
                            @click="toggleSection('tools')"
                            class="group w-full flex items-center pl-2 pr-1 py-2 text-sm font-medium rounded-md text-gray-600 hover:bg-gray-50 hover:text-gray-900"
                            :aria-expanded="activeSection === 'tools'"
                        >
                            <svg 
                                class="mr-3 h-5 w-5 text-gray-400 group-hover:text-gray-500 transition-transform duration-200" 
                                fill="none" 
                                viewBox="0 0 24 24" 
                                stroke="currentColor"
                                :class="{ 'rotate-90': activeSection === 'tools' }"
                            >
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                            Tools
                        </button>

                        <div 
                            x-show="activeSection === 'tools'" 
                            x-collapse 
                            class="space-y-1 pl-6"
                        >
                            <!-- Add tools links here -->
                        </div>
                    </div>

                    <!-- Admin Settings Section -->
                    <div class="space-y-1">
                        <button 
                            @click="toggleSection('admin')"
                            class="group w-full flex items-center pl-2 pr-1 py-2 text-sm font-medium rounded-md text-gray-600 hover:bg-gray-50 hover:text-gray-900"
                            :aria-expanded="activeSection === 'admin'"
                        >
                            <svg 
                                class="mr-3 h-5 w-5 text-gray-400 group-hover:text-gray-500 transition-transform duration-200" 
                                fill="none" 
                                viewBox="0 0 24 24" 
                                stroke="currentColor"
                                :class="{ 'rotate-90': activeSection === 'admin' }"
                            >
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                            Admin Settings
                        </button>

                        <div 
                            x-show="activeSection === 'admin'" 
                            x-collapse 
                            class="space-y-1 pl-6"
                        >
                            <!-- Add admin settings links here -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</nav>
