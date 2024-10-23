<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Category') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h1 class="heading-1 mb-5">You're in category create page!</h1>


                    <form action="{{ route('category.store') }}" method="POST">
                    @csrf

                    <!-- Category Name -->
                    <div class="mb-3">
                        <label for="name" class="form-label">Category Name</label>
                        <input type="text" name="name" class="form-control" id="name" placeholder="Enter category name" value="{{ old('name') }}" required>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" class="btn btn-primary">Create Category</button>
                </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
