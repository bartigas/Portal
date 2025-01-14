<x-app-layout>
    <x-slot:content>
        <div class="container mx-auto px-4 sm:px-8 max-w-3xl">
            <div class="py-8">
                <h2 class="text-2xl font-semibold leading-tight text-gray-800 mb-6">
                    Manage Permissions for {{ $user->name }}
                </h2>

                <form 
                    action="{{ route('users.permissions', $user) }}" 
                    method="POST" 
                    class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4"
                >
                    @csrf

                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2">
                            Available Permissions
                        </label>
                        <div class="flex flex-wrap">
                            @foreach($permissions as $permission)
                                <label class="inline-flex items-center mr-4 mb-2">
                                    <input 
                                        type="checkbox" 
                                        name="permissions[]" 
                                        value="{{ $permission->name }}"
                                        class="form-checkbox"
                                        {{ $user->hasPermissionTo($permission->name) ? 'checked' : '' }}
                                    >
                                    <span class="ml-2">{{ $permission->name }}</span>
                                </label>
                            @endforeach
                        </div>
                    </div>

                    <div class="flex items-center justify-between">
                        <button 
                            class="btn btn-primary" 
                            type="submit"
                        >
                            Update Permissions
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