@props(['title' => config('app.name'), 'description' => '', 'image' => '', 'url' => '', 'type' => 'website'])

<!-- Primary Meta Tags -->
<meta name="title" content="{{ $title }}">
<meta name="description" content="{{ $description }}">

<!-- Open Graph / Facebook -->
<meta property="og:type" content="{{ $type }}">
<meta property="og:url" content="{{ $url ?: url()->current() }}">
<meta property="og:title" content="{{ $title }}">
<meta property="og:description" content="{{ $description }}">
@if($image)
<meta property="og:image" content="{{ $image }}">
@endif

<!-- Twitter -->
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:url" content="{{ $url ?: url()->current() }}">
<meta name="twitter:title" content="{{ $title }}">
<meta name="twitter:description" content="{{ $description }}">
@if($image)
<meta name="twitter:image" content="{{ $image }}">
@endif
