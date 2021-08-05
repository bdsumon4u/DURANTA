<template>
    <!-- topbar -->
    <div class="hidden md:block bg-gray-100 border-b">
        <div class="container flex justify-between px-8 py-2 text-sm">
            <div class="flex">
                <div class="flex items-center mr-6">
                    <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M11.2875 3.75C12.02 3.89292 12.6933 4.25119 13.221 4.77895C13.7488 5.30671 14.1071 5.97995 14.25 6.7125L11.2875 3.75ZM11.2875 0.75C12.8094 0.919077 14.2287 1.60063 15.3122 2.68276C16.3957 3.76488 17.079 5.18326 17.25 6.705L11.2875 0.75ZM16.5 12.69V14.94C16.5008 15.1489 16.458 15.3556 16.3744 15.547C16.2907 15.7384 16.168 15.9102 16.014 16.0514C15.8601 16.1926 15.6784 16.3001 15.4805 16.367C15.2827 16.4339 15.073 16.4588 14.865 16.44C12.5571 16.1892 10.3402 15.4006 8.39248 14.1375C6.58035 12.986 5.04398 11.4496 3.89248 9.6375C2.62496 7.6809 1.83616 5.45325 1.58998 3.135C1.57124 2.9276 1.59589 2.71857 1.66236 2.52122C1.72882 2.32387 1.83566 2.14252 1.97605 1.98872C2.11645 1.83491 2.28733 1.71203 2.47782 1.62789C2.66831 1.54375 2.87424 1.5002 3.08248 1.5H5.33248C5.69646 1.49642 6.04932 1.62531 6.3253 1.86265C6.60128 2.09999 6.78154 2.42959 6.83248 2.79C6.92745 3.51005 7.10357 4.21705 7.35748 4.8975C7.45839 5.16594 7.48023 5.45769 7.42041 5.73816C7.36059 6.01863 7.22163 6.27608 7.01998 6.48L6.06748 7.4325C7.13515 9.31016 8.68982 10.8648 10.5675 11.9325L11.52 10.98C11.7239 10.7784 11.9813 10.6394 12.2618 10.5796C12.5423 10.5198 12.834 10.5416 13.1025 10.6425C13.7829 10.8964 14.4899 11.0725 15.21 11.1675C15.5743 11.2189 15.907 11.4024 16.1449 11.6831C16.3827 11.9638 16.5091 12.3222 16.5 12.69Z" stroke="#C9151B" stroke-linecap="round" stroke-linejoin="round"></path>
                    </svg>
                    <a class="ml-2" href="tel:+8801624093099">+8801624093099</a>
                </div>
                <div class="flex items-center">
                    <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M3.00001 3H15C15.825 3 16.5 3.675 16.5 4.5V13.5C16.5 14.325 15.825 15 15 15H3.00001C2.17501 15 1.50001 14.325 1.50001 13.5V4.5C1.50001 3.675 2.17501 3 3.00001 3Z" stroke="#C9151B" stroke-linecap="round" stroke-linejoin="round"></path>
                        <path d="M16.5 4.5L9.00001 9.75L1.50001 4.5" stroke="#C9151B" stroke-linecap="round" stroke-linejoin="round"></path>
                    </svg>
                    <a href="mailto:support@duranta.com.bd" class="ml-2">support@duranta.com.bd</a>
                </div>
            </div>
            <div class="flex items-center">
                <a class="flex items-center" href="">
                    <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M13.5 1.5H4.5C3.67157 1.5 3 2.17157 3 3V15C3 15.8284 3.67157 16.5 4.5 16.5H13.5C14.3284 16.5 15 15.8284 15 15V3C15 2.17157 14.3284 1.5 13.5 1.5Z" stroke="#C9151B" stroke-linecap="round" stroke-linejoin="round"></path>
                        <path d="M9 13.5H9.0075" stroke="#C9151B" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                    </svg>
                    <span class="ml-2">Save big on our app!</span>
                </a>
            </div>
        </div>
    </div>
    <!-- topbar -->

    <!-- sticky -->
    <div class="sticky top-0 z-30">
        <!-- header -->
        <header class="shadow bg-white">
            <div class="container flex items-center justify-between">
                <!-- logo -->
                <inertia-link :href="route('home')" class="flex w-28 h-9 justify-center items-center text-primary border-2 border-primary font-semibold font-roboto-condensed text-2xl">
                    DURANTA
                </inertia-link>
                <!-- logo end -->

                <!-- searchbar -->
                <div class="w-full xl:max-w-xl lg:max-w-lg lg:flex items-center relative hidden">
                    <span class="absolute left-4 text-lg text-gray-400">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24">
                            <path fill="none" d="M0 0h24v24H0z"/>
                            <path fill="currentColor" d="M18.031 16.617l4.283 4.282-1.415 1.415-4.282-4.283A8.96 8.96 0 0 1 11 20c-4.968 0-9-4.032-9-9s4.032-9 9-9 9 4.032 9 9a8.96 8.96 0 0 1-1.969 5.617zm-2.006-.742A6.977 6.977 0 0 0 18 11c0-3.868-3.133-7-7-7-3.868 0-7 3.132-7 7 0 3.867 3.132 7 7 7a6.977 6.977 0 0 0 4.875-1.975l.15-.15z"/>
                        </svg>
                    </span>
                    <input type="search"
                           class="pl-12 w-full border-2 border-r-0 border-primary py-2 px-3 rounded-l-md focus:ring-primary focus:border-primary"
                           placeholder="Search for...">
                    <button type="submit"
                            class="bg-primary text-white py-2 px-8 font-medium rounded-r-md hover:bg-transparent hover:text-primary border-2 border-primary transition">
                        Search
                    </button>
                </div>
                <!-- searchbar end -->

                <!-- navicons -->
                <div class="space-x-5 flex items-center">
                    <div>
                        <a href="" class="py-2 lg:py-4 block text-center text-gray-700 hover:text-primary transition relative">
                            <span class="absolute -right-3 top-2 w-5 h-5 rounded-full flex items-center justify-center bg-primary text-white text-xs">5</span>
                            <div class="grid place-content-center shadow rounded-md">
                                <div class="p-2">
                                    <svg stroke="currentColor" fill="none" stroke-width="2" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round" height="24" width="24" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path>
                                        <path d="M13.73 21a2 2 0 0 1-3.46 0"></path>
                                    </svg>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="hidden lg:block">
                        <a href="" @click.prevent="cart_open = true" class="py-2 lg:py-4 block text-center text-gray-700 hover:text-primary transition relative">
                            <span class="absolute -right-3 top-2 w-5 h-5 rounded-full flex items-center justify-center bg-primary text-white text-xs">3</span>
                            <div class="grid place-content-center shadow rounded-md">
                                <div class="p-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24">
                                        <path fill="none" d="M0 0h24v24H0z"/>
                                        <path fill="currentColor" d="M4 6.414L.757 3.172l1.415-1.415L5.414 5h15.242a1 1 0 0 1 .958 1.287l-2.4 8a1 1 0 0 1-.958.713H6v2h11v2H5a1 1 0 0 1-1-1V6.414zM6 7v6h11.512l1.8-6H6zm-.5 16a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zm12 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3z"/>
                                    </svg>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div>
                        <inertia-link :href="route('dashboard')" class="py-2 lg:py-4 block text-center text-gray-700 hover:text-primary transition">
                            <div class="grid place-content-center shadow rounded-md">
                                <div v-if="$page.props.user && $page.props.jetstream.managesProfilePhotos" class="p-1">
                                    <img height="32" width="32" class="rounded-md object-fill" :src="$page.props.user.profile_photo_url" :alt="$page.props.user.name" />
                                </div>
                                <div v-else class="p-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24">
                                        <path fill="none" d="M0 0h24v24H0z"/>
                                        <path fill="currentColor" d="M20 22h-2v-2a3 3 0 0 0-3-3H9a3 3 0 0 0-3 3v2H4v-2a5 5 0 0 1 5-5h6a5 5 0 0 1 5 5v2zm-8-9a6 6 0 1 1 0-12 6 6 0 0 1 0 12zm0-2a4 4 0 1 0 0-8 4 4 0 0 0 0 8z"/>
                                    </svg>
                                </div>
                            </div>
                        </inertia-link>
                    </div>
                </div>
                <!-- navicons end -->
            </div>
        </header>
        <!-- header end -->

        <!-- navbar -->
        <nav class="bg-gray-800 hidden lg:block">
            <div class="container">
                <div class="flex">
                    <!-- all category -->
                    <div class="w-64 px-4 py-2 bg-primary flex items-center justify-between cursor-pointer group relative">
                        <span class="text-white">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24">
                                <path fill="none" d="M0 0h24v24H0z"/>
                                <path fill="currentColor" d="M3 4h18v2H3V4zm0 7h18v2H3v-2zm0 7h18v2H3v-2z"/>
                            </svg>
                        </span>
                        <span class="uppercase mx-2 text-white text-xl font-semibold font-roboto-condensed">Category Menu</span>
                        <span class="text-white">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24">
                                <path fill="none" d="M0 0h24v24H0z"/>
                                <path fill="currentColor" d="M12 13.172l4.95-4.95 1.414 1.414L12 16 5.636 9.636 7.05 8.222z"/>
                            </svg>
                        </span>
                        <category-menu class="absolute left-0 top-full invisible opacity-0" />
                    </div>
                    <!-- all category end -->

                    <!-- nav menu -->
                    <div class="flex items-center justify-between flex-grow pl-12">
                        <div class="flex items-center space-x-6 text-base capitalize">
                            <inertia-link :href="route('home')" class="text-gray-200 hover:text-white transition font-roboto text-sm font-medium hover:underline">Home</inertia-link>
                            <inertia-link :href="route('products')" class="text-gray-200 hover:text-white transition font-roboto text-sm font-medium hover:underline">Products</inertia-link>
                            <a href="#" class="text-gray-200 hover:text-white transition font-roboto text-sm font-medium hover:underline">About us</a>
                            <a href="#" class="text-gray-200 hover:text-white transition font-roboto text-sm font-medium hover:underline">Contact us</a>
                        </div>
                        <inertia-link :href="route('seller.dashboard')" class="ml-auto justify-self-end text-gray-200 hover:text-gray-400 transition font-roboto text-sm font-medium">
                            Seller Center
                        </inertia-link>
                    </div>
                    <!-- nav menu end -->
                </div>
            </div>
        </nav>
        <!-- navbar end -->
    </div>
    <!-- sticky end -->

    <!-- mobile menubar -->
    <div class="fixed w-full border-t border-gray-200 shadow-sm bg-white bottom-0 left-0 flex flex-col lg:hidden z-40">
        <div v-show="search_open" class="border-b p-1">
            <!-- searchbar -->
            <div class="w-full flex items-center relative">
                <span class="absolute left-4 text-lg text-gray-400">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24">
                        <path fill="none" d="M0 0h24v24H0z"/>
                        <path fill="currentColor" d="M18.031 16.617l4.283 4.282-1.415 1.415-4.282-4.283A8.96 8.96 0 0 1 11 20c-4.968 0-9-4.032-9-9s4.032-9 9-9 9 4.032 9 9a8.96 8.96 0 0 1-1.969 5.617zm-2.006-.742A6.977 6.977 0 0 0 18 11c0-3.868-3.133-7-7-7-3.868 0-7 3.132-7 7 0 3.867 3.132 7 7 7a6.977 6.977 0 0 0 4.875-1.975l.15-.15z"/>
                    </svg>
                </span>
                <input type="search"
                       class="pl-12 w-full border-2 border-r-0 border-primary py-2 px-3 rounded-l-md focus:ring-primary focus:border-primary"
                       placeholder="Search for...">
                <button type="submit"
                        class="bg-primary text-white py-2 px-4 font-medium rounded-r-md hover:bg-transparent hover:text-primary border-2 border-primary transition">
                    Search
                </button>
            </div>
            <!-- searchbar end -->
        </div>
        <div class="flex justify-around items-start px-6 py-2">
            <a href="" @click.prevent="menu_open = true" class="block text-center text-gray-700 hover:text-primary transition relative">
                <div class="grid place-content-center">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24">
                        <path fill="none" d="M0 0h24v24H0z"/>
                        <path fill="currentColor" d="M3 4h18v2H3V4zm0 7h18v2H3v-2zm0 7h18v2H3v-2z"/>
                    </svg>
                </div>
                <div class="text-xs leading-3">Menu</div>
            </a>
            <a href="" @click.prevent="categories_open = true" class="block text-center text-gray-700 hover:text-primary transition relative">
                <div class="grid place-content-center">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24">
                        <path fill="none" d="M0 0h24v24H0z"/>
                        <path fill="currentColor" d="M8 4h13v2H8V4zm-5-.5h3v3H3v-3zm0 7h3v3H3v-3zm0 7h3v3H3v-3zM8 11h13v2H8v-2zm0 7h13v2H8v-2z"/>
                    </svg>
                </div>
                <div class="text-xs leading-3">Categories</div>
            </a>
            <a href="" @click.prevent="search_open = !search_open" class="block text-center text-gray-700 hover:text-primary transition relative">
                <div class="grid place-content-center">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24">
                        <path fill="none" d="M0 0h24v24H0z"/>
                        <path fill="currentColor" d="M18.031 16.617l4.283 4.282-1.415 1.415-4.282-4.283A8.96 8.96 0 0 1 11 20c-4.968 0-9-4.032-9-9s4.032-9 9-9 9 4.032 9 9a8.96 8.96 0 0 1-1.969 5.617zm-2.006-.742A6.977 6.977 0 0 0 18 11c0-3.868-3.133-7-7-7-3.868 0-7 3.132-7 7 0 3.867 3.132 7 7 7a6.977 6.977 0 0 0 4.875-1.975l.15-.15z"/>
                    </svg>
                </div>
                <div class="text-xs leading-3">Search</div>
            </a>
            <a href="" @click.prevent="cart_open = true" class="text-center text-gray-700 hover:text-primary transition relative">
                <span class="absolute -right-3 -top-1 w-5 h-5 rounded-full flex items-center justify-center bg-primary text-white text-xs">3</span>
                <div class="grid place-content-center">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24">
                        <path fill="none" d="M0 0h24v24H0z"/>
                        <path fill="currentColor" d="M4 6.414L.757 3.172l1.415-1.415L5.414 5h15.242a1 1 0 0 1 .958 1.287l-2.4 8a1 1 0 0 1-.958.713H6v2h11v2H5a1 1 0 0 1-1-1V6.414zM6 7v6h11.512l1.8-6H6zm-.5 16a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zm12 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3z"/>
                    </svg>
                </div>
                <div class="text-xs leading-3">Cart</div>
            </a>
        </div>
    </div>
    <!-- mobile menubar end -->

    <!-- mobile sidebar menu -->
    <div v-show="menu_open" class="fixed left-0 top-0 w-full h-full z-50 bg-black bg-opacity-30 shadow">
        <div class="absolute inset-0" @click.prevent="menu_open = false"></div>
        <div class="absolute left-0 top-0 w-72 h-full z-50 bg-white shadow">
            <!-- navlink -->
            <h3 class="text-xl font-semibold bg-primary text-gray-100 mb-1 font-roboto p-4 flex justify-center items-center">
                <div>Menu</div>
                <div @click.prevent="menu_open = false" class="text-gray-100 border text-lg absolute right-3 cursor-pointer">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24">
                        <path fill="none" d="M0 0h24v24H0z"/>
                        <path fill="currentColor" d="M12 10.586l4.95-4.95 1.414 1.414-4.95 4.95 4.95 4.95-1.414 1.414-4.95-4.95-4.95 4.95-1.414-1.414 4.95-4.95-4.95-4.95L7.05 5.636z"/>
                    </svg>
                </div>
            </h3>
            <div class="">
                <a href="#" class="block px-4 py-2 font-medium transition hover:bg-gray-100">
                    Home
                </a>
                <a href="#" class="block px-4 py-2 font-medium transition hover:bg-gray-100">
                    Shop
                </a>
                <a href="#" class="block px-4 py-2 font-medium transition hover:bg-gray-100">
                    About Us
                </a>
                <a href="#" class="block px-4 py-2 font-medium transition hover:bg-gray-100">
                    Contact Us
                </a>
            </div>
            <!-- navlinks end -->
        </div>
    </div>
    <!-- mobile sidebar menu end -->

    <!-- mobile sidebar categories -->
    <div v-show="categories_open" class="fixed left-0 top-0 w-full h-full z-50 bg-black bg-opacity-30 shadow">
        <div class="absolute inset-0" @click.prevent="categories_open = false"></div>
        <div class="absolute left-0 top-0 w-72 h-full z-50 bg-white shadow">
            <!-- categories -->
            <h3 class="text-xl font-semibold bg-primary text-gray-100 mb-1 font-roboto p-4 flex justify-center items-center">
                <div>Categories</div>
                <div @click.prevent="categories_open = false" class="text-gray-100 border text-lg absolute right-3 cursor-pointer">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24">
                        <path fill="none" d="M0 0h24v24H0z"/>
                        <path fill="currentColor" d="M12 10.586l4.95-4.95 1.414 1.414-4.95 4.95 4.95 4.95-1.414 1.414-4.95-4.95-4.95 4.95-1.414-1.414 4.95-4.95-4.95-4.95L7.05 5.636z"/>
                    </svg>
                </div>
            </h3>
            <div class="">
                <a href="" class="block px-4 py-2 font-medium transition hover:bg-gray-100">
                    Bedroom
                </a>
                <a href="" class="block px-4 py-2 font-medium transition hover:bg-gray-100">
                    Furniture
                </a>
                <a href="#" class="block px-4 py-2 font-medium transition hover:bg-gray-100">
                    Mattress
                </a>
                <a href="#" class="block px-4 py-2 font-medium transition hover:bg-gray-100">
                    Office
                </a>
                <a href="#" class="block px-4 py-2 font-medium transition hover:bg-gray-100">
                    Outdoor
                </a>
                <a href="#" class="block px-4 py-2 font-medium transition hover:bg-gray-100">
                    Sofa
                </a>
            </div>
            <!-- categories end -->
        </div>
    </div>
    <!-- mobile sidebar categories end -->

    <!-- cart sidebar -->
    <div v-show="cart_open" class="fixed left-0 top-0 w-full h-full z-50 bg-black bg-opacity-30 shadow">
        <div class="absolute inset-0" @click.prevent="cart_open = false"></div>
        <div class="absolute right-0 top-0 w-full md:w-96 h-full z-50 bg-white shadow">
            <!-- cart -->
            <h3 class="text-xl font-semibold bg-primary text-gray-100 font-roboto p-4 flex justify-center items-center">
                <div @click.prevent="cart_open = false" class="text-gray-100 border text-lg absolute left-3 cursor-pointer">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24">
                        <path fill="none" d="M0 0h24v24H0z"/>
                        <path fill="currentColor" d="M12 10.586l4.95-4.95 1.414 1.414-4.95 4.95 4.95 4.95-1.414 1.414-4.95-4.95-4.95 4.95-1.414-1.414 4.95-4.95-4.95-4.95L7.05 5.636z"/>
                    </svg>
                </div>
                <div>My Cart</div>
            </h3>
            <ul class="divide-y overflow-y-auto" style="height: calc(100% - 240px)">
                <!-- single wishlist -->
                <li v-for="i in [1, 2, 3, 4, 5]" class="flex items-center md:justify-between gap-4 p-4 border-gray-200 flex-wrap md:flex-nowrap">
                    <!-- cart image -->
                    <div class="w-12 flex-shrink-0">
                        <img :src="`/images/products/product${i}.jpg`"  class="w-full">
                    </div>
                    <!-- cart image end -->
                    <div class="flex flex-col flex-1">
                        <!-- cart content -->
                        <div>
                            <a href="" class="text-gray-800 mb-2 text-sm font-roboto font-medium">
                                Nice Beautiful Handsome Italian L Shape Sofa
                            </a>
                            <div class="mt-2 flex justify-between items-center">
                                <p class="text-primary font-semibold">$320.00</p>
                                <!-- quantity -->
                                <div class="flex border border-gray-300 text-gray-600 divide-x divide-gray-300 w-max">
                                    <div class="h-6 w-6 text-xl flex items-center justify-center cursor-pointer select-none">-</div>
                                    <div class="h-6 w-8 flex items-center justify-center">4</div>
                                    <div class="h-6 w-6 text-xl flex items-center justify-center cursor-pointer select-none">+</div>
                                </div>
                            </div>
                        </div>
                        <!-- cart content end -->
                    </div>
                    <div class="text-gray-600 hover:text-primary cursor-pointer">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24">
                            <path fill="none" d="M0 0h24v24H0z"/>
                            <path fill="currentColor" d="M17 6h5v2h-2v13a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1V8H2V6h5V3a1 1 0 0 1 1-1h8a1 1 0 0 1 1 1v3zm1 2H6v12h12V8zm-9 3h2v6H9v-6zm4 0h2v6h-2v-6zM9 4v2h6V4H9z"/>
                        </svg>
                    </div>
                </li>
                <!-- single wishlist end -->
            </ul>
            <div class="absolute left-0 bottom-0 right-0 px-4 pt-2 pb-4">
                <div class="flex font-semibold py-2">
                    <div class="flex-1">
                        Subtotal
                    </div>
                    <div class="text-primary">
                        $2200
                    </div>
                </div>
                <div class="flex font-semibold py-2">
                    <div class="flex-1">
                        Discount
                    </div>
                    <div class="text-primary">
                        $2200
                    </div>
                </div>
                <div class="flex font-semibold py-2">
                    <div class="flex-1">
                        Total
                    </div>
                    <div class="text-primary">
                        $2200
                    </div>
                </div>
                <div>
                    <a href="#" class="flex items-center justify-center py-1 mx-1 mb-1 text-center text-white bg-primary border border-primary rounded hover:bg-transparent hover:text-primary transition">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24">
                            <path fill="none" d="M0 0h24v24H0z"></path>
                            <path fill="currentColor" d="M4 6.414L.757 3.172l1.415-1.415L5.414 5h15.242a1 1 0 0 1 .958 1.287l-2.4 8a1 1 0 0 1-.958.713H6v2h11v2H5a1 1 0 0 1-1-1V6.414zM6 7v6h11.512l1.8-6H6zm-.5 16a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zm12 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3z"></path>
                        </svg>
                        <span class="font-semibold ml-1">Proceed To Checkout</span>
                    </a>
                </div>
            </div>
            <!-- cart end -->
        </div>
    </div>
    <!-- cart sidebar end -->

    <slot />

    <!-- footer -->
    <footer class="bg-white pt-16 pb-12 border-t border-gray-100">
        <div class="container">
            <div class="xl:grid xl:grid-cols-3 xl:gap-8">
                <!-- footer text -->
                <div class="space-y-8 xl:col-span-1">
                    <inertia-link :href="route('home')" class="flex w-28 h-9 justify-center items-center text-primary border-2 border-primary font-semibold font-roboto-condensed text-2xl">
                        DURANTA
                    </inertia-link>
                    <p class="text-gray-500 text-base">
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Odio facere rem
                    </p>
                    <div class="flex space-x-6">
                        <a href="#" class="text-gray-400 hover:text-gray-500">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-gray-500">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-gray-500">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-gray-500">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                    </div>
                </div>
                <!-- footer text end -->
                <!-- footer links -->
                <div class="mt-12 grid grid-cols-2 gap-8 xl:mt-0 xl:col-span-2">
                    <div class="md:grid md:grid-cols-2 md:gap-8">
                        <div>
                            <h3 class="text-sm font-semibold text-gray-400 tracking-wider uppercase">
                                Solutions
                            </h3>
                            <div class="mt-4 space-y-4">
                                <a href="#" class="text-base text-gray-500 hover:text-gray-900 block">
                                    Marketing
                                </a>
                                <a href="#" class="text-base text-gray-500 hover:text-gray-900 block">
                                    Analytics
                                </a>
                                <a href="#" class="text-base text-gray-500 hover:text-gray-900 block">
                                    Commerce
                                </a>
                                <a href="#" class="text-base text-gray-500 hover:text-gray-900 block">
                                    Insights
                                </a>
                            </div>
                        </div>
                        <div class="mt-12 md:mt-0">
                            <h3 class="text-sm font-semibold text-gray-400 tracking-wider uppercase">
                                Support
                            </h3>
                            <div class="mt-4 space-y-4">
                                <a href="#" class="text-base text-gray-500 hover:text-gray-900 block">
                                    Pricing
                                </a>
                                <a href="#" class="text-base text-gray-500 hover:text-gray-900 block">
                                    Documentation
                                </a>
                                <a href="#" class="text-base text-gray-500 hover:text-gray-900 block">
                                    Guides
                                </a>
                                <a href="#" class="text-base text-gray-500 hover:text-gray-900 block">
                                    API Status
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="md:grid md:grid-cols-2 md:gap-8">
                        <div>
                            <h3 class="text-sm font-semibold text-gray-400 tracking-wider uppercase">
                                Company
                            </h3>
                            <div class="mt-4 space-y-4">
                                <a href="#" class="text-base text-gray-500 hover:text-gray-900 block">
                                    About
                                </a>
                                <a href="#" class="text-base text-gray-500 hover:text-gray-900 block">
                                    Blog
                                </a>
                                <a href="#" class="text-base text-gray-500 hover:text-gray-900 block">
                                    Jobs
                                </a>
                                <a href="#" class="text-base text-gray-500 hover:text-gray-900 block">
                                    Press
                                </a>
                            </div>
                        </div>
                        <div class="mt-12 md:mt-0">
                            <h3 class="text-sm font-semibold text-gray-400 tracking-wider uppercase">
                                Legal
                            </h3>
                            <div class="mt-4 space-y-4">
                                <a href="#" class="text-base text-gray-500 hover:text-gray-900 block">
                                    Claim
                                </a>
                                <a href="#" class="text-base text-gray-500 hover:text-gray-900 block">
                                    Privacy
                                </a>
                                <a href="#" class="text-base text-gray-500 hover:text-gray-900 block">
                                    Policy
                                </a>
                                <a href="#" class="text-base text-gray-500 hover:text-gray-900 block">
                                    Terms
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- footer links end -->
            </div>
        </div>
    </footer>
    <!-- footer end -->

    <!-- copyright -->
    <div class="bg-gray-800 py-4 mb-[3rem] lg:mb-0">
        <div class="container flex flex-wrap items-center justify-between">
            <p class="w-full md:w-1/2 text-white text-center mb-2 md:mb-0">© DURANTA - All Rights Reserved</p>
            <div class="w-full md:w-1/2 flex justify-center">
                <img src="/images/methods.png" class="h-5">
            </div>
        </div>
    </div>
</template>

<script>
import JetBanner from "@/Jetstream/Banner";
import JetDropdown from "@/Jetstream/Dropdown";
import JetDropdownLink from "@/Jetstream/DropdownLink";
import Notifications from "@/Components/Notifications";
import Sidebar from "@/Components/Sidebar/Index";
import CategoryMenu from "@/Components/Site/CategoryMenu";

export default {
    components: {
        CategoryMenu,
        JetBanner,
        JetDropdown,
        JetDropdownLink,
        Notifications,
        Sidebar,
    },

    computed: {
        is_home_page() {
            return route().current('home');
        }
    },
    data() {
        return {
            cart_open: false,
            categories_open: false,
            menu_open: false,
            search_open: false,
        }
    },

    methods: {
        switchToTeam(team) {
            this.$inertia.put(route('current-team.update'), {
                'team_id': team.id
            }, {
                preserveState: false
            })
        },

        logout() {
            this.$inertia.post(route('logout'));
        },
    },

    mounted() {
        this.isLoading = false;
    }
}
</script>
