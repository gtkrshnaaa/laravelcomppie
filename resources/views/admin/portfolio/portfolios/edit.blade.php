@extends('layouts.admin')

@section('title', 'Edit Project')

@section('content')
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-primary mb-2">Edit Project</h1>
        <p class="text-secondary">Update project information</p>
    </div>

    <form action="{{ route('admin.portfolio.portfolios.update', $portfolio) }}" method="POST" enctype="multipart/form-data" class="max-w-4xl">
        @csrf
        @method('PUT')

        <div class="bg-surface border border-border rounded-xl p-6 mb-6">
            <h2 class="text-lg font-bold text-primary mb-6">Project Information</h2>

            <div class="space-y-6">
                <!-- Category -->
                <div>
                    <label for="portfolio_category_id" class="block text-sm font-medium text-primary mb-2">Category *</label>
                    <select id="portfolio_category_id" name="portfolio_category_id" required class="w-full px-4 py-3 rounded-lg border border-border bg-background text-primary focus:outline-none focus:ring-2 focus:ring-primary/20">
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ $portfolio->portfolio_category_id == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Title -->
                <div>
                    <label for="title" class="block text-sm font-medium text-primary mb-2">Project Title *</label>
                    <input type="text" id="title" name="title" value="{{ $portfolio->title }}" required class="w-full px-4 py-3 rounded-lg border border-border bg-background text-primary focus:outline-none focus:ring-2 focus:ring-primary/20">
                </div>

                <!-- Description -->
                <div>
                    <label for="description" class="block text-sm font-medium text-primary mb-2">Description *</label>
                    <textarea id="description" name="description" rows="6" required class="w-full px-4 py-3 rounded-lg border border-border bg-background text-primary focus:outline-none focus:ring-2 focus:ring-primary/20">{{ $portfolio->description }}</textarea>
                </div>

                <!-- Client Info -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="client_name" class="block text-sm font-medium text-primary mb-2">Client Name</label>
                        <input type="text" id="client_name" name="client_name" value="{{ $portfolio->client_name }}" class="w-full px-4 py-3 rounded-lg border border-border bg-background text-primary focus:outline-none focus:ring-2 focus:ring-primary/20">
                    </div>

                    <div>
                        <label for="client_company" class="block text-sm font-medium text-primary mb-2">Client Company</label>
                        <input type="text" id="client_company" name="client_company" value="{{ $portfolio->client_company }}" class="w-full px-4 py-3 rounded-lg border border-border bg-background text-primary focus:outline-none focus:ring-2 focus:ring-primary/20">
                    </div>
                </div>

                <!-- Image & URL -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="image" class="block text-sm font-medium text-primary mb-2">Project Image</label>
                        @if($portfolio->image)
                            <div class="mb-3">
                                <img src="{{ Storage::url($portfolio->image) }}" alt="{{ $portfolio->title }}" class="w-40 h-28 object-cover rounded-lg">
                            </div>
                        @endif
                        <input type="file" id="image" name="image" accept="image/*" class="w-full px-4 py-3 rounded-lg border border-border bg-background text-primary focus:outline-none focus:ring-2 focus:ring-primary/20">
                        <p class="mt-1 text-xs text-secondary">Leave empty to keep current image</p>
                    </div>

                    <div>
                        <label for="project_url" class="block text-sm font-medium text-primary mb-2">Project URL</label>
                        <input type="url" id="project_url" name="project_url" value="{{ $portfolio->project_url }}" placeholder="https://" class="w-full px-4 py-3 rounded-lg border border-border bg-background text-primary focus:outline-none focus:ring-2 focus:ring-primary/20">
                    </div>
                </div>

                <!-- Technologies -->
                <div>
                    <label class="block text-sm font-medium text-primary mb-2">Technologies Used</label>
                    <div id="technologies-container" class="space-y-2">
                        @if($portfolio->technologies && count($portfolio->technologies) > 0)
                            @foreach($portfolio->technologies as $tech)
                                <div class="flex gap-2">
                                    <input type="text" name="technologies[]" value="{{ $tech }}" class="flex-1 px-4 py-3 rounded-lg border border-border bg-background text-primary focus:outline-none focus:ring-2 focus:ring-primary/20">
                                    <button type="button" onclick="this.parentElement.remove()" class="px-4 py-3 text-red-400 hover:text-red-300">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                                    </button>
                                </div>
                            @endforeach
                        @else
                            <div class="flex gap-2">
                                <input type="text" name="technologies[]" placeholder="Technology 1" class="flex-1 px-4 py-3 rounded-lg border border-border bg-background text-primary focus:outline-none focus:ring-2 focus:ring-primary/20">
                                <button type="button" onclick="this.parentElement.remove()" class="px-4 py-3 text-red-400 hover:text-red-300">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                                </button>
                            </div>
                        @endif
                    </div>
                    <button type="button" onclick="addTechnology()" class="mt-2 text-sm text-primary hover:underline">+ Add Technology</button>
                </div>

                <!-- Project Date & Featured -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="project_date" class="block text-sm font-medium text-primary mb-2">Project Date</label>
                        <input type="date" id="project_date" name="project_date" value="{{ $portfolio->project_date ? $portfolio->project_date->format('Y-m-d') : '' }}" class="w-full px-4 py-3 rounded-lg border border-border bg-background text-primary focus:outline-none focus:ring-2 focus:ring-primary/20">
                    </div>

                    <div class="flex items-center gap-3 pt-8">
                        <input type="checkbox" id="is_featured" name="is_featured" value="1" {{ $portfolio->is_featured ? 'checked' : '' }} class="w-4 h-4 rounded border-border bg-background text-primary focus:ring-2 focus:ring-primary/20">
                        <label for="is_featured" class="text-sm font-medium text-primary">Featured Project</label>
                    </div>
                </div>
            </div>
        </div>

        <!-- Actions -->
        <div class="flex items-center gap-4">
            <button type="submit" class="bg-primary text-background px-6 py-3 rounded-lg font-medium hover:opacity-90 transition-opacity">
                Update Project
            </button>
            <a href="{{ route('admin.portfolio.portfolios.index') }}" class="text-secondary hover:text-primary transition-colors">Cancel</a>
        </div>
    </form>

    <script>
        function addTechnology() {
            const container = document.getElementById('technologies-container');
            const div = document.createElement('div');
            div.className = 'flex gap-2';
            div.innerHTML = `
                <input type="text" name="technologies[]" placeholder="Technology ${container.children.length + 1}" class="flex-1 px-4 py-3 rounded-lg border border-border bg-background text-primary focus:outline-none focus:ring-2 focus:ring-primary/20">
                <button type="button" onclick="this.parentElement.remove()" class="px-4 py-3 text-red-400 hover:text-red-300">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            `;
            container.appendChild(div);
        }
    </script>
@endsection
