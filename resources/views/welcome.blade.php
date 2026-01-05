@extends('layouts.public')

@section('title', 'Home')

@section('content')
    <!-- Hero Section with Carousel -->
    <section class="relative pt-24 pb-16 md:pt-32 md:pb-20 overflow-hidden" x-data="heroCarousel">
        <div class="absolute inset-0 bg-[radial-gradient(ellipse_at_top,_var(--tw-gradient-stops))] from-zinc-800/20 via-background to-background opacity-40"></div>
        
        <div class="container mx-auto px-4 relative z-10 text-center min-h-[400px] flex flex-col justify-center items-center">
            <!-- Grid Container for Stacking Slides -->
            <div class="grid grid-cols-1 relative w-full max-w-7xl mx-auto">
                <template x-for="(slide, index) in slides" :key="index">
                    <div class="col-start-1 row-start-1 flex flex-col justify-center items-center transition-all ease-in-out"
                         x-show="activeSlide === index"
                         x-transition:enter="duration-500 delay-300 opacity-0 translate-y-8"
                         x-transition:enter-end="opacity-100 translate-y-0"
                         x-transition:leave="duration-300 opacity-100 translate-y-0"
                         x-transition:leave-end="opacity-0 -translate-y-8" 
                    >
                        <h1 class="text-4xl md:text-7xl lg:text-8xl font-bold tracking-tighter text-primary mb-6 leading-tight" x-html="slide.title"></h1>
                        <p class="text-lg md:text-2xl text-secondary max-w-4xl mx-auto mb-8" x-html="slide.subtitle"></p>
                        <a href="#contact" class="inline-flex items-center gap-3 bg-primary text-background font-bold px-8 py-4 rounded-xl hover:opacity-90 transition-all hover:gap-4 shadow-lg shadow-primary/20">
                            <span>Get Started</span>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
                            </svg>
                        </a>
                    </div>
                </template>
                
                <!-- Hidden spacer to prevent layout shift -->
                <div class="col-start-1 row-start-1 flex flex-col justify-center items-center invisible pointer-events-none" aria-hidden="true">
                     <h1 class="text-4xl md:text-7xl lg:text-8xl font-bold tracking-tighter mb-6 leading-tight">
                        Welcome to Our<br>Company
                     </h1>
                     <p class="text-lg md:text-2xl max-w-4xl mx-auto mb-8">
                        Professional solutions for your business needs
                     </p>
                </div>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section id="about" class="py-20 bg-background">
        <div class="container mx-auto px-4">
            <div class="relative overflow-hidden rounded-3xl bg-surface border border-border p-12 md:p-16">
                <!-- Background Effects -->
                <div class="absolute top-0 right-0 -translate-y-1/2 translate-x-1/2 w-96 h-96 bg-primary/5 rounded-full blur-3xl"></div>
                <div class="absolute bottom-0 left-0 translate-y-1/2 -translate-x-1/2 w-64 h-64 bg-purple-500/10 rounded-full blur-3xl"></div>

                <div class="relative z-10 text-center md:text-left">
                    <div class="flex flex-col md:flex-row items-center gap-12">
                        <div class="flex-1">
                            <h2 class="text-3xl md:text-5xl font-bold text-primary mb-6 tracking-tight">
                                About <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-400 to-purple-500">Us</span>
                            </h2>
                            <p class="text-secondary text-lg leading-relaxed mb-6">
                                We are a professional company dedicated to providing exceptional services to our clients. With years of experience in the industry, we've helped countless businesses achieve their goals.
                            </p>
                            <p class="text-secondary text-lg leading-relaxed mb-8">
                                Our team of experts is committed to delivering innovative solutions tailored to your unique needs. We believe in building long-term relationships based on trust, quality, and results.
                            </p>
                            
                            <div class="grid grid-cols-3 gap-8 mb-8">
                                <div class="text-center">
                                    <div class="text-4xl font-bold text-primary mb-2">10+</div>
                                    <div class="text-sm text-secondary">Years Experience</div>
                                </div>
                                <div class="text-center">
                                    <div class="text-4xl font-bold text-primary mb-2">500+</div>
                                    <div class="text-sm text-secondary">Projects Done</div>
                                </div>
                                <div class="text-center">
                                    <div class="text-4xl font-bold text-primary mb-2">100%</div>
                                    <div class="text-sm text-secondary">Client Satisfaction</div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="flex-1 flex justify-center">
                            <div class="relative w-full max-w-md aspect-square">
                                <div class="absolute inset-0 bg-gradient-to-br from-blue-500/20 via-purple-500/20 to-pink-500/20 rounded-3xl transform rotate-6"></div>
                                <div class="absolute inset-0 bg-surface border border-border rounded-3xl flex items-center justify-center">
                                    <svg class="w-32 h-32 text-primary/20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Services Section -->
    <section id="services" class="py-20 bg-background">
        <div class="container mx-auto px-4">
            <div class="text-center mb-12">
                <h2 class="text-3xl md:text-5xl font-bold text-primary mb-4">Our Services</h2>
                <p class="text-secondary text-lg max-w-2xl mx-auto">
                    Comprehensive solutions designed to help your business thrive in the digital age
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Service Card 1 -->
                <div class="group bg-surface border border-border rounded-2xl p-8 hover:shadow-xl hover:shadow-primary/5 hover:border-primary/30 transition-all duration-300">
                    <div class="w-16 h-16 bg-blue-500/10 rounded-xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                        <svg class="w-8 h-8 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-primary mb-3">Web Development</h3>
                    <p class="text-secondary mb-4">
                        Custom websites and web applications built with modern technologies for optimal performance and user experience.
                    </p>
                    <a href="#contact" class="text-sm font-bold text-primary hover:underline flex items-center gap-1">
                        Learn More 
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-4 h-4">
                            <path fill-rule="evenodd" d="M3 10a.75.75 0 01.75-.75h10.638L10.23 5.29a.75.75 0 111.04-1.08l5.5 5.25a.75.75 0 010 1.08l-5.5 5.25a.75.75 0 11-1.04-1.08l4.158-3.96H3.75A.75.75 0 013 10z" clip-rule="evenodd"/>
                        </svg>
                    </a>
                </div>

                <!-- Service Card 2 -->
                <div class="group bg-surface border border-border rounded-2xl p-8 hover:shadow-xl hover:shadow-primary/5 hover:border-primary/30 transition-all duration-300">
                    <div class="w-16 h-16 bg-green-500/10 rounded-xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                        <svg class="w-8 h-8 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-primary mb-3">Mobile Apps</h3>
                    <p class="text-secondary mb-4">
                        Native and cross-platform mobile applications that deliver seamless experiences across all devices.
                    </p>
                    <a href="#contact" class="text-sm font-bold text-primary hover:underline flex items-center gap-1">
                        Learn More 
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-4 h-4">
                            <path fill-rule="evenodd" d="M3 10a.75.75 0 01.75-.75h10.638L10.23 5.29a.75.75 0 111.04-1.08l5.5 5.25a.75.75 0 010 1.08l-5.5 5.25a.75.75 0 11-1.04-1.08l4.158-3.96H3.75A.75.75 0 013 10z" clip-rule="evenodd"/>
                        </svg>
                    </a>
                </div>

                <!-- Service Card 3 -->
                <div class="group bg-surface border border-border rounded-2xl p-8 hover:shadow-xl hover:shadow-primary/5 hover:border-primary/30 transition-all duration-300">
                    <div class="w-16 h-16 bg-purple-500/10 rounded-xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                        <svg class="w-8 h-8 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-primary mb-3">UI/UX Design</h3>
                    <p class="text-secondary mb-4">
                        Beautiful and intuitive interfaces designed to engage users and enhance their digital journey.
                    </p>
                    <a href="#contact" class="text-sm font-bold text-primary hover:underline flex items-center gap-1">
                        Learn More 
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-4 h-4">
                            <path fill-rule="evenodd" d="M3 10a.75.75 0 01.75-.75h10.638L10.23 5.29a.75.75 0 111.04-1.08l5.5 5.25a.75.75 0 010 1.08l-5.5 5.25a.75.75 0 11-1.04-1.08l4.158-3.96H3.75A.75.75 0 013 10z" clip-rule="evenodd"/>
                        </svg>
                    </a>
                </div>

                <!-- Service Card 4 -->
                <div class="group bg-surface border border-border rounded-2xl p-8 hover:shadow-xl hover:shadow-primary/5 hover:border-primary/30 transition-all duration-300">
                    <div class="w-16 h-16 bg-orange-500/10 rounded-xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                        <svg class="w-8 h-8 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 15a4 4 0 004 4h9a5 5 0 10-.1-9.999 5.002 5.002 0 10-9.78 2.096A4.001 4.001 0 003 15z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-primary mb-3">Cloud Solutions</h3>
                    <p class="text-secondary mb-4">
                        Scalable cloud infrastructure and deployment strategies to ensure your applications run smoothly.
                    </p>
                    <a href="#contact" class="text-sm font-bold text-primary hover:underline flex items-center gap-1">
                        Learn More 
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-4 h-4">
                            <path fill-rule="evenodd" d="M3 10a.75.75 0 01.75-.75h10.638L10.23 5.29a.75.75 0 111.04-1.08l5.5 5.25a.75.75 0 010 1.08l-5.5 5.25a.75.75 0 11-1.04-1.08l4.158-3.96H3.75A.75.75 0 013 10z" clip-rule="evenodd"/>
                        </svg>
                    </a>
                </div>

                <!-- Service Card 5 -->
                <div class="group bg-surface border border-border rounded-2xl p-8 hover:shadow-xl hover:shadow-primary/5 hover:border-primary/30 transition-all duration-300">
                    <div class="w-16 h-16 bg-pink-500/10 rounded-xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                        <svg class="w-8 h-8 text-pink-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-primary mb-3">Cybersecurity</h3>
                    <p class="text-secondary mb-4">
                        Comprehensive security solutions to protect your digital assets and ensure data privacy.
                    </p>
                    <a href="#contact" class="text-sm font-bold text-primary hover:underline flex items-center gap-1">
                        Learn More 
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-4 h-4">
                            <path fill-rule="evenodd" d="M3 10a.75.75 0 01.75-.75h10.638L10.23 5.29a.75.75 0 111.04-1.08l5.5 5.25a.75.75 0 010 1.08l-5.5 5.25a.75.75 0 11-1.04-1.08l4.158-3.96H3.75A.75.75 0 013 10z" clip-rule="evenodd"/>
                        </svg>
                    </a>
                </div>

                <!-- Service Card 6 -->
                <div class="group bg-surface border border-border rounded-2xl p-8 hover:shadow-xl hover:shadow-primary/5 hover:border-primary/30 transition-all duration-300">
                    <div class="w-16 h-16 bg-cyan-500/10 rounded-xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                        <svg class="w-8 h-8 text-cyan-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-primary mb-3">Data Analytics</h3>
                    <p class="text-secondary mb-4">
                        Transform your data into actionable insights with our advanced analytics and visualization tools.
                    </p>
                    <a href="#contact" class="text-sm font-bold text-primary hover:underline flex items-center gap-1">
                        Learn More 
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-4 h-4">
                            <path fill-rule="evenodd" d="M3 10a.75.75 0 01.75-.75h10.638L10.23 5.29a.75.75 0 111.04-1.08l5.5 5.25a.75.75 0 010 1.08l-5.5 5.25a.75.75 0 11-1.04-1.08l4.158-3.96H3.75A.75.75 0 013 10z" clip-rule="evenodd"/>
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Portfolio Section -->
    <section id="portfolio" class="py-20 bg-background">
        <div class="container mx-auto px-4">
            <!-- Header Banner -->
            <div class="relative overflow-hidden rounded-3xl bg-surface border border-border px-8 py-12 mb-12">
                <div class="absolute top-0 right-0 -translate-y-1/2 translate-x-1/2 w-96 h-96 bg-primary/5 rounded-full blur-3xl"></div>
                <div class="absolute bottom-0 left-0 translate-y-1/2 -translate-x-1/2 w-64 h-64 bg-purple-500/10 rounded-full blur-3xl"></div>

                <div class="relative z-10 text-center">
                     <h2 class="text-3xl md:text-5xl font-bold text-primary mb-4 tracking-tight">
                        Our <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-400 to-purple-500">Portfolio</span>
                    </h2>
                    <p class="text-secondary text-lg max-w-2xl mx-auto">
                        Explore our successful projects and see how we've helped businesses achieve their goals
                    </p>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Portfolio Item 1 -->
                <div class="group bg-surface border border-border rounded-2xl overflow-hidden hover:shadow-xl hover:shadow-primary/5 hover:border-primary/30 transition-all duration-300">
                    <div class="relative aspect-[16/10] overflow-hidden bg-background/50">
                        <div class="absolute inset-0 flex items-center justify-center text-secondary">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-12 h-12 opacity-30">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5zm10.5-11.25h.008v.008h-.008V8.25zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                            </svg>
                        </div>
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-primary mb-2 group-hover:text-blue-500 transition-colors">
                            E-Commerce Platform
                        </h3>
                        <p class="text-secondary text-sm mb-4">
                            A modern online shopping platform with advanced features and seamless user experience.
                        </p>
                        <div class="flex flex-wrap gap-2">
                            <span class="px-2 py-1 rounded text-xs font-bold bg-primary/10 text-primary">Laravel</span>
                            <span class="px-2 py-1 rounded text-xs font-bold bg-primary/10 text-primary">Vue.js</span>
                            <span class="px-2 py-1 rounded text-xs font-bold bg-primary/10 text-primary">MySQL</span>
                        </div>
                    </div>
                </div>

                <!-- Portfolio Item 2 -->
                <div class="group bg-surface border border-border rounded-2xl overflow-hidden hover:shadow-xl hover:shadow-primary/5 hover:border-primary/30 transition-all duration-300">
                    <div class="relative aspect-[16/10] overflow-hidden bg-background/50">
                        <div class="absolute inset-0 flex items-center justify-center text-secondary">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-12 h-12 opacity-30">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5zm10.5-11.25h.008v.008h-.008V8.25zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                            </svg>
                        </div>
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-primary mb-2 group-hover:text-blue-500 transition-colors">
                            Mobile Banking App
                        </h3>
                        <p class="text-secondary text-sm mb-4">
                            Secure and intuitive mobile banking application with real-time transaction capabilities.
                        </p>
                        <div class="flex flex-wrap gap-2">
                            <span class="px-2 py-1 rounded text-xs font-bold bg-primary/10 text-primary">React Native</span>
                            <span class="px-2 py-1 rounded text-xs font-bold bg-primary/10 text-primary">Node.js</span>
                            <span class="px-2 py-1 rounded text-xs font-bold bg-primary/10 text-primary">MongoDB</span>
                        </div>
                    </div>
                </div>

                <!-- Portfolio Item 3 -->
                <div class="group bg-surface border border-border rounded-2xl overflow-hidden hover:shadow-xl hover:shadow-primary/5 hover:border-primary/30 transition-all duration-300">
                    <div class="relative aspect-[16/10] overflow-hidden bg-background/50">
                        <div class="absolute inset-0 flex items-center justify-center text-secondary">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-12 h-12 opacity-30">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5zm10.5-11.25h.008v.008h-.008V8.25zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                            </svg>
                        </div>
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-primary mb-2 group-hover:text-blue-500 transition-colors">
                            Healthcare Dashboard
                        </h3>
                        <p class="text-secondary text-sm mb-4">
                            Comprehensive patient management system with real-time health monitoring dashboard.
                        </p>
                        <div class="flex flex-wrap gap-2">
                            <span class="px-2 py-1 rounded text-xs font-bold bg-primary/10 text-primary">Angular</span>
                            <span class="px-2 py-1 rounded text-xs font-bold bg-primary/10 text-primary">Python</span>
                            <span class="px-2 py-1 rounded text-xs font-bold bg-primary/10 text-primary">PostgreSQL</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section id="contact" class="py-20 bg-background">
        <div class="container mx-auto px-4">
            <div class="relative overflow-hidden rounded-3xl bg-primary px-8 py-12 md:px-12 md:py-16 lg:flex lg:items-center lg:justify-between shadow-2xl shadow-primary/20">
                 <!-- Background Gradients -->
                 <div class="absolute top-0 left-0 -translate-x-1/2 -translate-y-1/2 w-[500px] h-[500px] bg-gradient-to-br from-blue-500/30 to-purple-500/30 blur-3xl rounded-full pointer-events-none"></div>
                 <div class="absolute bottom-0 right-0 translate-x-1/2 translate-y-1/2 w-[500px] h-[500px] bg-gradient-to-tl from-red-500/30 to-yellow-500/30 blur-3xl rounded-full pointer-events-none"></div>

                <div class="relative z-10 text-center lg:text-left mb-8 lg:mb-0">
                    <h2 class="text-3xl font-bold tracking-tight text-background sm:text-4xl leading-tight">
                        Ready to Start Your<br>
                        <span class="text-transparent bg-clip-text bg-gradient-to-r from-yellow-300 to-orange-400">Next Project?</span>
                    </h2>
                    <p class="mt-4 max-w-xl text-lg text-background lg:mx-0">
                        Let's discuss how we can help transform your ideas into reality. Get in touch with our team today.
                    </p>
                </div>
                <div class="relative z-10 flex flex-col sm:flex-row justify-center lg:justify-end gap-4">
                    <a href="mailto:contact@example.com" class="rounded-full bg-background px-8 py-3.5 text-sm font-bold text-primary shadow-sm hover:bg-surface transition-all transform hover:scale-105 text-center">
                        Email Us
                    </a>
                    <a href="tel:+1234567890" class="rounded-full border-2 border-background px-8 py-3.5 text-sm font-bold text-background hover:bg-background/10 transition-all text-center">
                        Call Now
                    </a>
                </div>
            </div>
        </div>
    </section>

    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('heroCarousel', () => ({
                activeSlide: 0,
                slides: [
                    {
                        title: 'Welcome to Our<br><span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-500 via-purple-500 to-pink-500">Company</span>',
                        subtitle: 'Professional solutions for your business needs'
                    },
                    {
                        title: 'Build Your Future,<br><span class="text-transparent bg-clip-text bg-gradient-to-r from-green-400 via-blue-500 to-purple-600">Professional & Fast</span>',
                        subtitle: 'Innovative technologies delivered with excellence'
                    },
                    {
                        title: 'Transform Your Business<br><span class="text-transparent bg-clip-text bg-gradient-to-r from-pink-500 via-orange-400 to-yellow-400">Digital Solutions</span>',
                        subtitle: 'Comprehensive services tailored to your success'
                    }
                ],
                init() {
                    setInterval(() => {
                        this.activeSlide = (this.activeSlide + 1) % this.slides.length;
                    }, 5000);
                }
            }))
        })
    </script>
@endsection