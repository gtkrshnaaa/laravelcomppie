@extends('layouts.admin')

@section('title', 'Portfolio Projects')

@section('content')
    <div class="mb-8">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-bold text-primary mb-2">Portfolio Projects</h1>
                <p class="text-secondary">Manage your portfolio showcase</p>
            </div>
            <a href="{{ route('admin.portfolio.portfolios.create') }}" class="bg-primary text-background px-6 py-3 rounded-lg font-medium hover:opacity-90 transition-opacity">
                Add New Project
            </a>
        </div>
    </div>

    <!-- Filters -->
    <div class="bg-surface border border-border rounded-xl p-6 mb-6">
        <div class="flex gap-4">
            <a href="{{ route('admin.portfolio.categories.index') }}" class="text-sm text-secondary hover:text-primary transition-colors">
                Manage Categories
            </a>
        </div>
    </div>

    <!-- Projects Table -->
    <div class="bg-surface border border-border rounded-xl overflow-hidden">
        <table class="w-full">
            <thead class="bg-background border-b border-border">
                <tr>
                    <th class="px-6 py-4 text-left text-xs font-medium text-secondary uppercase tracking-wider">Project</th>
                    <th class="px-6 py-4 text-left text-xs font-medium text-secondary uppercase tracking-wider">Category</th>
                    <th class="px-6 py-4 text-left text-xs font-medium text-secondary uppercase tracking-wider">Client</th>
                    <th class="px-6 py-4 text-left text-xs font-medium text-secondary uppercase tracking-wider">Date</th>
                    <th class="px-6 py-4 text-right text-xs font-medium text-secondary uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-border">
                @forelse($portfolios as $portfolio)
                    <tr class="hover:bg-background/50 transition-colors">
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                @if($portfolio->image)
                                    <img src="{{ Storage::url($portfolio->image) }}" alt="{{ $portfolio->title }}" class="w-16 h-12 rounded-lg object-cover">
                                @else
                                    <div class="w-16 h-12 rounded-lg bg-primary/10 flex items-center justify-center text-xs text-secondary">
                                        No Image
                                    </div>
                                @endif
                                <div>
                                    <p class="text-sm font-medium text-primary">{{ $portfolio->title }}</p>
                                    <p class="text-xs text-secondary">{{ Str::limit($portfolio->description, 50) }}</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <span class="px-2 py-1 rounded text-xs bg-primary/10 text-primary">{{ $portfolio->category->name }}</span>
                        </td>
                        <td class="px-6 py-4 text-sm text-primary">
                            {{ $portfolio->client_company ?? $portfolio->client_name ?? '-' }}
                        </td>
                        <td class="px-6 py-4 text-sm text-secondary">
                            {{ $portfolio->project_date ? $portfolio->project_date->format('M Y') : '-' }}
                        </td>
                        <td class="px-6 py-4 text-right">
                            <div class="flex items-center justify-end gap-2">
                                <a href="{{ route('admin.portfolio.portfolios.edit', $portfolio) }}" class="text-blue-400 hover:text-blue-300">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                    </svg>
                                </a>
                                <form action="{{ route('admin.portfolio.portfolios.destroy', $portfolio) }}" method="POST" onsubmit="return confirm('Are you sure?')">
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
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                                </svg>
                                <p class="text-primary font-medium mb-2">No portfolio projects yet</p>
                                <p class="text-sm">Get started by adding your first project</p>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($portfolios->hasPages())
        <div class="mt-6">
            {{ $portfolios->links() }}
        </div>
    @endif
@endsection
