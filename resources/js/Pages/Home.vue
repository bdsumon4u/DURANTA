<template>
    <app-layout>
        <!-- slider -->
        <div>
            <div class="container">
                <div class="flex">
                    <div class="hidden md:block md:w-64 mb-4">
                        <category-menu />
                    </div>
                    <div class="flex-1">
                        <div class="my-4 md:ml-4">
                            <slider />
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- slider end -->

        <!-- shop by brand -->
        <div class="container pb-16">
            <h2 class="text-xl md:text-2xl font-medium font-roboto text-gray-800 uppercase mb-6">Shop By Brand</h2>
            <div class="grid lg:grid-cols-8 md:grid-cols-6 grid-cols-3 lg:gap-6 md:gap-4 gap-2">
                <!-- single brand -->
                <div v-for="brand in brands" class="group flex flex-col rounded bg-white shadow overflow-hidden">
                    <!-- brand image -->
                    <div class="relative p-2">
                        <img :src="brand.image" class="w-full">
                        <div class="absolute inset-0 bg-gray-100 bg-opacity-40 flex items-center justify-center gap-2 opacity-0 group-hover:opacity-100 transition"></div>
                    </div>
                    <!-- brand image end -->
                    <inertia-link :href="route('brands.show', brand.slug)">
                        <h4 class="font-medium text-sm text-center font-roboto line-clamp-2 mb-2 text-gray-800 hover:text-primary transition">{{ brand.name }}</h4>
                    </inertia-link>
                </div>
                <!-- single brand end -->
                <div v-if="brands.length === 15" class="group p-4 flex flex-col justify-around rounded bg-white shadow overflow-hidden">
                    <p class="mb-4 font-bold text-gray-700 text-sm text-center">
                        <span class="block">View all Brands Available in</span>
                        <span class="block">{{ $page.props.app_name }}</span>
                    </p>
                    <inertia-link :href="route('brands')" class="rounded overflow-hidden relative whitespace-nowrap bg-black text-white px-4 py-2">
                        <span class="ripple"></span>
                        <span class="flex items-center justify-center">
                            View all
                            <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 24 24" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg">
                                <path d="M12 4l-1.41 1.41L16.17 11H4v2h12.17l-5.58 5.59L12 20l8-8z"></path>
                            </svg>
                        </span>
                    </inertia-link>
                </div>
            </div>
        </div>
        <!-- shop by brand end -->

        <!-- shop by store -->
        <div class="container pb-16">
            <h2 class="text-xl md:text-2xl font-medium font-roboto text-gray-800 uppercase mb-6">Shop By Store</h2>
            <div class="grid lg:grid-cols-8 md:grid-cols-6 grid-cols-3 lg:gap-6 md:gap-4 gap-2">
                <!-- single store -->
                <div v-for="store in stores" class="group flex flex-col rounded bg-white shadow overflow-hidden">
                    <!-- store image -->
                    <div class="relative p-2">
                        <img :src="store.store_logo" class="w-full">
                        <div class="absolute inset-0 bg-gray-100 bg-opacity-40 flex items-center justify-center gap-2 opacity-0 group-hover:opacity-100 transition"></div>
                    </div>
                    <!-- store image end -->
                    <a href="">
                        <h4 class="font-medium text-sm text-center font-roboto line-clamp-2 mb-2 text-gray-800 hover:text-primary transition">{{ store.name }}</h4>
                    </a>
                </div>
                <!-- single store end -->
                <div v-if="stores.length === 15" class="group p-4 flex flex-col justify-around rounded bg-white shadow overflow-hidden">
                    <p class="mb-4 font-bold text-gray-700 text-sm text-center">
                        <span class="block">View all Stores Available in</span>
                        <span class="block">{{ $page.props.app_name }}</span>
                    </p>
                    <button class="rounded overflow-hidden relative whitespace-nowrap bg-black text-white px-4 py-2">
                        <span class="ripple"></span>
                        <span class="flex items-center justify-center">
                            View all
                            <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 24 24" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg">
                                <path d="M12 4l-1.41 1.41L16.17 11H4v2h12.17l-5.58 5.59L12 20l8-8z"></path>
                            </svg>
                        </span>
                    </button>
                </div>
            </div>
        </div>
        <!-- shop by store end -->

        <!-- top new arrival -->
        <div class="container pb-16">
            <h2 class="text-xl md:text-2xl font-medium font-roboto text-gray-800 uppercase mb-6">Top New Arrival</h2>
            <!-- product wrapper -->
            <div class="grid lg:grid-cols-6 sm:grid-cols-3 grid-cols-2 lg:gap-6 md:gap-4 gap-2">
                <!-- single product -->
                <template v-for="product in latest.data">
                    <product :product="product" />
                </template>
                <!-- single product end -->
            </div>
            <!-- product wrapper end -->
        </div>
        <!-- top new arrival end -->

        <!-- ad section -->
        <div class="container pb-16">
            <a href="#">
                <img src="/images/offer.jpg" class="w-full">
            </a>
        </div>
        <!-- ad section end -->

        <!-- recommended for you -->
        <div class="container pb-16">
            <h2 class="text-xl md:text-2xl font-medium font-roboto text-gray-800 uppercase mb-6">Recommended For You</h2>
            <!-- product wrapper -->
            <div class="grid lg:grid-cols-6 sm:grid-cols-3 grid-cols-2 lg:gap-6 md:gap-4 gap-2">
                <!-- single product -->
                <template v-for="product in latest.data">
                    <product :product="product" />
                </template>
                <!-- single product end -->
            </div>
            <!-- product wrapper end -->
        </div>
        <!-- recommended for you end -->
    </app-layout>
</template>

<script>
import CategoryMenu from "@/Components/Site/CategoryMenu";
import Slider from "@/Components/Site/Slider";
import Product from "@/Components/Site/Product";
import AppLayout from "../Layouts/AppLayout";

export default {
    name: "Home",
    props: ['brands', 'stores', 'latest'],
    components: {
        AppLayout,
        Product,
        Slider,
        CategoryMenu,
    }
}
</script>
