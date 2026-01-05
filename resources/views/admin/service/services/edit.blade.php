@extends('layouts.admin')

@section('title', 'Edit Service')

@section('content')
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-primary mb-2">Edit Service</h1>
        <p class="text-secondary">Update service information</p>
    </div>

    <form action="{{ route('admin.service.services.update', $service) }}" method="POST" enctype="multipart/form-data" class="max-w-4xl">
        @csrf
        @method('PUT')

        <div class="bg-surface border border-border rounded-xl p-6 mb-6">
            <h2 class="text-lg font-bold text-primary mb-6">Basic Information</h2>

            <div class="space-y-6">
                <!-- Category -->
                <div>
                    <label for="service_category_id" class="block text-sm font-medium text-primary mb-2">Category *</label>
                    <select id="service_category_id" name="service_category_id" required class="w-full px-4 py-3 rounded-lg border border-border bg-background text-primary focus:outline-none focus:ring-2 focus:ring-primary/20 @error('service_category_id') border-red-500 @enderror">
                        <option value="">Select Category</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ old('service_category_id', $service->service_category_id) == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                        @endforeach
                    </select>
                    @error('service_category_id')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Name -->
                <div>
                    <label for="name" class="block text-sm font-medium text-primary mb-2">Service Name *</label>
                    <input type="text" id="name" name="name" value="{{ old('name', $service->name) }}" required class="w-full px-4 py-3 rounded-lg border border-border bg-background text-primary focus:outline-none focus:ring-2 focus:ring-primary/20 @error('name') border-red-500 @enderror">
                    @error('name')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Short Description -->
                <div>
                    <label for="short_description" class="block text-sm font-medium text-primary mb-2">Short Description</label>
                    <input type="text" id="short_description" name="short_description" value="{{ old('short_description', $service->short_description) }}" maxlength="255" class="w-full px-4 py-3 rounded-lg border border-border bg-background text-primary focus:outline-none focus:ring-2 focus:ring-primary/20">
                </div>

                <!-- Description -->
                <div>
                    <label for="description" class="block text-sm font-medium text-primary mb-2">Full Description *</label>
                    <textarea id="description" name="description" rows="6" required class="w-full px-4 py-3 rounded-lg border border-border bg-background text-primary focus:outline-none focus:ring-2 focus:ring-primary/20 @error('description') border-red-500 @enderror">{{ old('description', $service->description) }}</textarea>
                    @error('description')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Icon & Image -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="icon" class="block text-sm font-medium text-primary mb-2">Icon (Emoji)</label>
                        <input type="text" id="icon" name="icon" value="{{ old('icon', $service->icon) }}" maxlength="10" placeholder="🚀" class="w-full px-4 py-3 rounded-lg border border-border bg-background text-primary focus:outline-none focus:ring-2 focus:ring-primary/20">
                    </div>

                    <div>
                        <label for="image" class="block text-sm font-medium text-primary mb-2">Image</label>
                        @if($service->image)
                            <div class="mb-3">
                                <img src="{{ Storage::url($service->image) }}" alt="{{ $service->name }}" class="w-32 h-24 object-cover rounded-lg">
                            </div>
                        @endif
                        <input type="file" id="image" name="image" accept="image/*" class="w-full px-4 py-3 rounded-lg border border-border bg-background text-primary focus:outline-none focus:ring-2 focus:ring-primary/20">
                        <p class="mt-1 text-xs text-secondary">Leave empty to keep current image</p>
                    </div>
                </div>

                <!-- Price -->
                <div>
                    <label for="price_starting_from" class="block text-sm font-medium text-primary mb-2">Starting Price</label>
                    <div class="relative">
                        <span class="absolute left-4 top-1/2 -translate-y-1/2 text-secondary">$</span>
                        <input type="number" id="price_starting_from" name="price_starting_from" value="{{ old('price_starting_from', $service->price_starting_from) }}" step="0.01" min="0" class="w-full pl-8 pr-4 py-3 rounded-lg border border-border bg-background text-primary focus:outline-none focus:ring-2 focus:ring-primary/20">
                    </div>
                </div>

                <!-- Features -->
                <div>
                    <label class="block text-sm font-medium text-primary mb-2">Features</label>
                    <div id="features-container" class="space-y-2">
                        @if($service->features && count($service->features) > 0)
                            @foreach($service->features as $feature)
                                <div class="flex gap-2">
                                    <input type="text" name="features[]" value="{{ $feature }}" class="flex-1 px-4 py-3 rounded-lg border border-border bg-background text-primary focus:outline-none focus:ring-2 focus:ring-primary/20">
                                    <button type="button" onclick="this.parentElement.remove()" class="px-4 py-3 text-red-400 hover:text-red-300">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                                    </button>
                                </div>
                            @endforeach
                        @else
                            <div class="flex gap-2">
                                <input type="text" name="features[]" placeholder="Feature 1" class="flex-1 px-4 py-3 rounded-lg border border-border bg-background text-primary focus:outline-none focus:ring-2 focus:ring-primary/20">
                                <button type="button" onclick="this.parentElement.remove()" class="px-4 py-3 text-red-400 hover:text-red-300">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                                </button>
                            </div>
                        @endif
                    </div>
                    <button type="button" onclick="addFeature()" class="mt-2 text-sm text-primary hover:underline">+ Add Feature</button>
                </div>

                <!-- Featured & Order -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="flex items-center gap-3">
                        <input type="checkbox" id="is_featured" name="is_featured" value="1" {{ old('is_featured', $service->is_featured) ? 'checked' : '' }} class="w-4 h-4 rounded border-border bg-background text-primary focus:ring-2 focus:ring-primary/20">
                        <label for="is_featured" class="text-sm font-medium text-primary">Featured Service</label>
                    </div>

                    <div>
                        <label for="order" class="block text-sm font-medium text-primary mb-2">Display Order</label>
                        <input type="number" id="order" name="order" value="{{ old('order', $service->order) }}" min="0" class="w-full px-4 py-3 rounded-lg border border-border bg-background text-primary focus:outline-none focus:ring-2 focus:ring-primary/20">
                    </div>
                </div>
            </div>
        </div>

        <!-- Actions -->
        <div class="flex items-center gap-4">
            <button type="submit" class="bg-primary text-background px-6 py-3 rounded-lg font-medium hover:opacity-90 transition-opacity">
                Update Service
            </button>
            <a href="{{ route('admin.service.services.index') }}" class="text-secondary hover:text-primary transition-colors">Cancel</a>
        </div>
    </form>

    <script>
        function addFeature() {
            const container = document.getElementById('features-container');
            const div = document.createElement('div');
            div.className = 'flex gap-2';
            div.innerHTML = `
                <input type="text" name="features[]" placeholder="Feature ${container.children.length + 1}" class="flex-1 px-4 py-3 rounded-lg border border-border bg-background text-primary focus:outline-none focus:ring-2 focus:ring-primary/20">
                <button type="button" onclick="this.parentElement.remove()" class="px-4 py-3 text-red-400 hover:text-red-300">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            `;
            container.appendChild(div);
        }
    </script>
@endsection
