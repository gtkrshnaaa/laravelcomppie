@extends('layouts.admin')

@section('title', 'Company Settings')
@section('page-title', 'Company Settings')

@section('content')
<div class="max-w-5xl">
    <form action="{{ route('admin.settings.company.update') }}" method="POST" enctype="multipart/form-data" x-data="{ activeTab: 'basic' }">
        @csrf
        @method('PUT')

        <!-- Tabs -->
        <div class="bg-white rounded-lg shadow-sm mb-6">
            <div class="border-b border-gray-200">
                <nav class="flex space-x-8 px-6" aria-label="Tabs">
                    <button type="button" @click="activeTab = 'basic'" :class="activeTab === 'basic' ? 'border-indigo-500 text-indigo-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300'" class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
                        Basic Information
                    </button>
                    <button type="button" @click="activeTab = 'contact'" :class="activeTab === 'contact' ? 'border-indigo-500 text-indigo-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300'" class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
                        Contact Details
                    </button>
                    <button type="button" @click="activeTab = 'social'" :class="activeTab === 'social' ? 'border-indigo-500 text-indigo-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300'" class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
                        Social Media
                    </button>
                    <button type="button" @click="activeTab = 'seo'" :class="activeTab === 'seo' ? 'border-indigo-500 text-indigo-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300'" class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
                        SEO Settings
                    </button>
                </nav>
            </div>
        </div>

        <!-- Tab Content -->
        <div class="bg-white rounded-lg shadow-sm p-6">
            <!-- Basic Information Tab -->
            <div x-show="activeTab === 'basic'" class="space-y-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Company Name *</label>
                    <input type="text" name="company_name" value="{{ old('company_name', $setting->company_name) }}" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent @error('company_name') border-red-500 @enderror">
                    @error('company_name')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Company Logo</label>
                    @if($setting->company_logo)
                        <img src="{{ Storage::url($setting->company_logo) }}" alt="Current Logo" class="mb-2 h-20 object-contain">
                    @endif
                    <input type="file" name="company_logo" accept="image/*" class="w-full px-4 py-2 border border-gray-300 rounded-lg @error('company_logo') border-red-500 @enderror">
                    <p class="mt-1 text-xs text-gray-500">Accepted: JPG, PNG, SVG. Max: 2MB</p>
                    @error('company_logo')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Company Description</label>
                    <textarea name="company_description" rows="3" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent">{{ old('company_description', $setting->company_description) }}</textarea>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">About Us</label>
                    <textarea name="about_us" rows="5" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent">{{ old('about_us', $setting->about_us) }}</textarea>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Vision</label>
                    <textarea name="vision" rows="3" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent">{{ old('vision', $setting->vision) }}</textarea>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Mission</label>
                    <textarea name="mission" rows="3" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent">{{ old('mission', $setting->mission) }}</textarea>
                </div>
            </div>

            <!-- Contact Details Tab -->
            <div x-show="activeTab === 'contact'" class="space-y-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                        <input type="email" name="email" value="{{ old('email', $setting->email) }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Phone</label>
                        <input type="text" name="phone" value="{{ old('phone', $setting->phone) }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Secondary Phone</label>
                        <input type="text" name="phone_secondary" value="{{ old('phone_secondary', $setting->phone_secondary) }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Address</label>
                    <textarea name="address" rows="2" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent">{{ old('address', $setting->address) }}</textarea>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">City</label>
                        <input type="text" name="city" value="{{ old('city', $setting->city) }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">State</label>
                        <input type="text" name="state" value="{{ old('state', $setting->state) }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Country</label>
                        <input type="text" name="country" value="{{ old('country', $setting->country) }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Postal Code</label>
                        <input type="text" name="postal_code" value="{{ old('postal_code', $setting->postal_code) }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                    </div>
                </div>
            </div>

            <!-- Social Media Tab -->
            <div x-show="activeTab === 'social'" class="space-y-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Facebook URL</label>
                    <input type="url" name="facebook_url" value="{{ old('facebook_url', $setting->facebook_url) }}" placeholder="https://facebook.com/yourpage" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Twitter URL</label>
                    <input type="url" name="twitter_url" value="{{ old('twitter_url', $setting->twitter_url) }}" placeholder="https://twitter.com/yourprofile" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Instagram URL</label>
                    <input type="url" name="instagram_url" value="{{ old('instagram_url', $setting->instagram_url) }}" placeholder="https://instagram.com/yourprofile" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">LinkedIn URL</label>
                    <input type="url" name="linkedin_url" value="{{ old('linkedin_url', $setting->linkedin_url) }}" placeholder="https://linkedin.com/company/yourcompany" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">YouTube URL</label>
                    <input type="url" name="youtube_url" value="{{ old('youtube_url', $setting->youtube_url) }}" placeholder="https://youtube.com/channel/yourchannel" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                </div>
            </div>

            <!-- SEO Settings Tab -->
            <div x-show="activeTab === 'seo'" class="space-y-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Meta Title</label>
                    <input type="text" name="meta_title" value="{{ old('meta_title', $setting->meta_title) }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                    <p class="mt-1 text-xs text-gray-500">Recommended: 50-60 characters</p>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Meta Description</label>
                    <textarea name="meta_description" rows="3" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent">{{ old('meta_description', $setting->meta_description) }}</textarea>
                    <p class="mt-1 text-xs text-gray-500">Recommended: 150-160 characters</p>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Meta Keywords</label>
                    <input type="text" name="meta_keywords" value="{{ old('meta_keywords', $setting->meta_keywords) }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                    <p class="mt-1 text-xs text-gray-500">Comma separated keywords</p>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Google Analytics ID</label>
                    <input type="text" name="google_analytics_id" value="{{ old('google_analytics_id', $setting->google_analytics_id) }}" placeholder="G-XXXXXXXXXX" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                </div>
            </div>

            <!-- Submit Button -->
            <div class="mt-8 flex justify-end">
                <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-2 px-6 rounded-lg transition duration-200">
                    Save Settings
                </button>
            </div>
        </div>
    </form>
</div>
@endsection
