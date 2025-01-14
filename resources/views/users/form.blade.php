<x-app-layout>
    <x-slot:content>
        <div class="container mx-auto px-4 sm:px-8 max-w-3xl">
            <div class="py-8">
                <h2 class="text-2xl font-semibold leading-tight text-gray-800 mb-6">
                    {{ isset($user) ? 'Edit User' : 'Create New User' }}
                </h2>

                <form 
                    action="{{ isset($user) ? route('users.update', $user) : route('users.store') }}" 
                    method="POST" 
                    class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4"
                >
                    @csrf
                    @if(isset($user))
                        @method('PUT')
                    @endif

                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="name">
                            Name
                        </label>
                        <input 
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" 
                            id="name" 
                            type="text" 
                            name="name" 
                            value="{{ old('name', $user->name ?? '') }}"
                            required
                        >
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="email">
                            Email
                        </label>
                        <input 
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" 
                            id="email" 
                            type="email" 
                            name="email" 
                            value="{{ old('email', $user->email ?? '') }}"
                            required
                        >
                    </div>

                    @if(!isset($user))
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="password">
                                Password
                            </label>
                            <input 
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" 
                                id="password" 
                                type="password" 
                                name="password"
                                required
                            >
                        </div>

                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="password_confirmation">
                                Confirm Password
                            </label>
                            <input 
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" 
                                id="password_confirmation" 
                                type="password" 
                                name="password_confirmation"
                                required
                            >
                        </div>
                    @endif

                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2">
                            Roles
                        </label>
                        <div class="flex flex-wrap">
                            @foreach($roles as $role)
                                <label class="inline-flex items-center mr-4 mb-2">
                                    <input 
                                        type="checkbox" 
                                        name="roles[]" 
                                        value="{{ $role->name }}"
                                        class="form-checkbox"
                                        {{ isset($user) && $user->hasRole($role->name) ? 'checked' : '' }}
                                    >
                                    <span class="ml-2">{{ $role->name }}</span>
                                </label>
                            @endforeach
                        </div>
                    </div>

                    <div class="flex items-center justify-between">
                        <button 
                            class="btn btn-primary" 
                            type="submit"
                        >
                            {{ isset($user) ? 'Update User' : 'Create User' }}
                        </button>
                        <a 
                            href="{{ route('users.index') }}" 
                            class="inline-block align-baseline font-bold text-sm text-blue-500 hover:text-blue-800"
                        >
                            Cancel
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </x-slot:content>
</x-app-layout>