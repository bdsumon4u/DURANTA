<template>
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
                        <notifications />
                    </div>
                    <div class="hidden lg:block">
                        <a href="" @click.prevent="cart_open = true" class="py-2 lg:py-4 block text-center text-gray-700 hover:text-primary transition relative">
                            <span v-if="cart_count" class="absolute -right-3 top-2 w-5 h-5 rounded-full flex items-center justify-center bg-primary text-white text-xs">{{ cart_count }}</span>
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
                <span v-if="cart_count" class="absolute -right-3 -top-1 w-5 h-5 rounded-full flex items-center justify-center bg-primary text-white text-xs">{{ cart_count }}</span>
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
                <li v-for="product in cart.content" class="flex items-center md:justify-between gap-4 p-4 border-gray-200 flex-wrap md:flex-nowrap">
                    <!-- cart image -->
                    <div class="w-12 flex-shrink-0">
                        <img :src="product.options.first_media"  class="w-full">
                    </div>
                    <!-- cart image end -->
                    <div class="flex flex-col flex-1">
                        <!-- cart content -->
                        <div>
                            <inertia-link :href="route('products.show', product.options.slug)" class="text-gray-800 mb-2 text-sm font-roboto font-medium">{{ product.name }}</inertia-link>
                            <div class="mt-2 flex justify-between items-center">
                                <p class="text-primary font-semibold">{{ product.price }}</p>
                                <!-- quantity -->
                                <div class="flex border border-gray-300 text-gray-600 divide-x divide-gray-300 w-max">
                                    <button class="h-6 w-6 text-xl flex items-center justify-center cursor-pointer select-none" @click.prevent="updateCart(product, 'decrement')">-</button>
                                    <button class="h-6 w-8 flex items-center justify-center">{{ product.qty }}</button>
                                    <button class="h-6 w-6 text-xl flex items-center justify-center cursor-pointer select-none" @click.prevent="updateCart(product, 'increment')">+</button>
                                </div>
                            </div>
                        </div>
                        <!-- cart content end -->
                    </div>
                    <button @click.prevent="remove(product.rowId)" class="text-gray-600 hover:text-primary cursor-pointer">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24">
                            <path fill="none" d="M0 0h24v24H0z"/>
                            <path fill="currentColor" d="M17 6h5v2h-2v13a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1V8H2V6h5V3a1 1 0 0 1 1-1h8a1 1 0 0 1 1 1v3zm1 2H6v12h12V8zm-9 3h2v6H9v-6zm4 0h2v6h-2v-6zM9 4v2h6V4H9z"/>
                        </svg>
                    </button>
                </li>
                <!-- single wishlist end -->
            </ul>
            <div class="absolute left-0 bottom-0 right-0 px-4 pt-2 pb-4">
                <div class="flex font-semibold py-2">
                    <div class="flex-1">
                        Subtotal
                    </div>
                    <div class="text-primary">
                        {{ cart.subtotal }}
                    </div>
                </div>
                <div class="flex font-semibold py-2">
                    <div class="flex-1">
                        Discount
                    </div>
                    <div class="text-primary">
                        {{ cart.discount }}
                    </div>
                </div>
                <div class="flex font-semibold py-2">
                    <div class="flex-1">
                        Total
                    </div>
                    <div class="text-primary">
                        {{ cart.total }}
                    </div>
                </div>
                <div>
                    <inertia-link :href="route('orders.create')" class="flex items-center justify-center py-1 mx-1 mb-1 text-center text-white bg-primary border border-primary rounded hover:bg-transparent hover:text-primary transition">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24">
                            <path fill="none" d="M0 0h24v24H0z"></path>
                            <path fill="currentColor" d="M4 6.414L.757 3.172l1.415-1.415L5.414 5h15.242a1 1 0 0 1 .958 1.287l-2.4 8a1 1 0 0 1-.958.713H6v2h11v2H5a1 1 0 0 1-1-1V6.414zM6 7v6h11.512l1.8-6H6zm-.5 16a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zm12 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3z"></path>
                        </svg>
                        <span class="font-semibold ml-1">Proceed To Checkout</span>
                    </inertia-link>
                </div>
            </div>
            <!-- cart end -->
        </div>
    </div>
    <!-- cart sidebar end -->
</template>

<script>
import CategoryMenu from "./CategoryMenu";
import Notifications from "../Notifications";

export default {
    name: "SidebarHeader",
    components: {
        Notifications,
        CategoryMenu,
    },
    computed: {
        cart_count() {
            return Object.keys(this.cart.content).length;
        }
    },
    methods: {
        loadCartContent() {
            axios.get(route('api.cart.content'))
                .then(({data}) => {
                    this.cart = data.cart;
                })
                .catch(err => console.error(err));
        },
        remove(rowId) {
            axios.post(route('api.cart.remove', rowId))
                .then(res => {
                    this.loadCartContent();
                })
                .catch(err => console.log(err));
        }
    },
    data() {
        return {
            cart: {
                content: {},
                total: 0,
                subtotal: 0,
                discount: 0,
            },
            cart_open: false,
            categories_open: false,
            menu_open: false,
            search_open: false,
        }
    },
    mounted() {
        console.log(this.$page)
        this.loadCartContent();
        this.emitter.on('cart-updated', this.loadCartContent)
    },
    beforeUnmount() {
        this.emitter.off('cart-updated', this.loadCartContent)
    }
}
</script>
