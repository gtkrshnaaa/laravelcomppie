@extends('layouts.admin')

@section('title', 'Services')

@section('content')
    <div class="mb-8">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-bold text-primary mb-2">Services</h1>
                <p class="text-secondary">Manage your service offerings</p>
            </div>
            <a href="{{ route('admin.service.services.create') }}" class="bg-primary text-background px-6 py-3 rounded-lg font-medium hover:opacity-90 transition-opacity">
                Add New Service
            </a>
        </div>
    </div>

    <!-- Filters -->
    <div class="bg-surface border border-border rounded-xl p-6 mb-6">
        <div class="flex gap-4">
            <a href="{{ route('admin.service.categories.index') }}" class="text-sm text-secondary hover:text-primary transition-colors">
                Manage Categories
            </a>
        </div>
    </div>

    <!-- Services Table -->
    <div class="bg-surface border border-border rounded-xl overflow-hidden">
        <table class="w-full">
            <thead class="bg-background border-b border-border">
                <tr>
                    <th class="px-6 py-4 text-left text-xs font-medium text-secondary uppercase tracking-wider">Service</th>
                    <th class="px-6 py-4 text-left text-xs font-medium text-secondary uppercase tracking-wider">Category</th>
                    <th class="px-6 py-4 text-left text-xs font-medium text-secondary uppercase tracking-wider">Price</th>
                    <th class="px-6 py-4 text-left text-xs font-medium text-secondary uppercase tracking-wider">Featured</th>
                    <th class="px-6 py-4 text-right text-xs font-medium text-secondary uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-border">
                @forelse($services as $service)
                    <tr class="hover:bg-background/50 transition-colors">
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                @if($service->image)
                                    <img src="{{ Storage::url($service->image) }}" alt="{{ $service->name }}" class="w-12 h-12 rounded-lg object-cover">
                                @else
                                    <div class="w-12 h-12 rounded-lg bg-primary/10 flex items-center justify-center text-xl">
                                        {{ $service->icon ?? '📦' }}
                                    </div>
                                @endif
                                <div>
                                    <p class="text-sm font-medium text-primary">{{ $service->name }}</p>
                                    <p class="text-xs text-secondary">{{ Str::limit($service->short_description, 50) }}</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <span class="px-2 py-1 rounded text-xs bg-primary/10 text-primary">{{ $service->category->name }}</span>
                        </td>
                        <td class="px-6 py-4 text-sm text-primary">
                            @if($service->price_starting_from)
                                ${{ number_format($service->price_starting_from, 2) }}
                            @else
                                <span class="text-secondary">-</span>
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            @if($service->is_featured)
                                <span class="px-2 py-1 rounded text-xs bg-green-900/30 text-green-400">Featured</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-right">
                            <div class="flex items-center justify-end gap-2">
                                <a href="{{ route('admin.service.services.edit', $service) }}" class="text-blue-400 hover:text-blue-300">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                    </svg>
                                </a>
                                <form action="{{ route('admin.service.services.destroy', $service) }}" method="POST" onsubmit="return confirm('Are you sure?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-400 hover:text-red-300">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-6 py-12 text-center">
                            <div class="text-secondary">
                                <svg class="w-12 h-12 mx-auto mb-4 opacity-30" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/>
                                </svg>
                                <p class="text-primary font-medium mb-2">No services yet</p>
                                <p class="text-sm">Get started by adding your first service</p>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($services->hasPages())
        <div class="mt-6">
            {{ $services->links() }}
        </div>
    @endif
@endsection
