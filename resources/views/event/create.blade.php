<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Event') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                <form action="{{ route('event.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <!-- Event Name -->
                <div class="mb-3">
                    <label for="name" class="form-label">Event Name</label>
                    <input type="text" name="name" class="form-control" id="name" placeholder="Enter event name" value="{{ old('name') }}" required>
                </div>

                <!-- Event Description -->
                <div class="mb-3">
                    <label for="description" class="form-label">Event Description</label>
                    <textarea name="description" class="form-control" id="description" rows="4" placeholder="Enter event description" required>{{ old('description') }}</textarea>
                </div>

                <div class="mb-3">
                    <label for="start_date" class="form-label">Start Date</label>
                    <input type="date" class="form-control" id="start_date" name="start_date" required>
                </div>

                <div class="mb-3">
                    <label for="end_date" class="form-label">End Date</label>
                    <input type="date" class="form-control" id="end_date" name="end_date" required>
                </div>

                <!-- Event Image -->
                <div class="mb-3">
                    <label for="image" class="form-label">Event Image</label>
                    <input type="file" name="image" class="form-control" id="image" required>
                </div>

                <!-- Event Category -->
                <div class="mb-3">
                    <label for="category" class="form-label">Event Category</label>
                    <select name="category_id" id="category" class="form-select" required>
                        <option value="" disabled selected>Select Category</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Enable/Disable Event -->
                <div class="mb-3 form-check">
                    <input type="checkbox" name="is_enabled" class="form-check-input" id="is_enabled" {{ old('enabled') ? 'checked' : '' }}>
                    <label class="form-check-label" for="is_enabled">Enable Event</label>
                </div>

                <!-- Mark as Featured -->
                <div class="mb-3 form-check">
                    <input type="checkbox" name="is_featured" class="form-check-input" id="is_featured" {{ old('featured') ? 'checked' : '' }}>
                    <label class="form-check-label" for="is_featured">Mark as Featured</label>
                </div>

                <!-- Submit Button -->
                <button type="submit" class="btn btn-primary">Create Event</button>
            </form>
                    
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
