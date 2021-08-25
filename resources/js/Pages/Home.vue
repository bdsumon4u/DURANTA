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
                <div v-for="i in [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12]" class="group flex flex-col rounded bg-white shadow overflow-hidden">
                    <!-- brand image -->
                    <div class="relative p-2">
                        <img :src="`/images/brands/brand-${i}`" class="w-full">
                        <div class="absolute inset-0 bg-gray-100 bg-opacity-40 flex items-center justify-center gap-2 opacity-0 group-hover:opacity-100 transition"></div>
                    </div>
                    <!-- brand image end -->
                    <a href="">
                        <h4 class="font-medium text-sm text-center font-roboto line-clamp-2 mb-2 text-gray-800 hover:text-primary transition">
                            Brand Name
                        </h4>
                    </a>
                </div>
                <!-- single brand end -->
            </div>
        </div>
        <!-- shop by brand end -->

        <!-- shop by category -->
        <div class="container pb-16">
            <h2 class="text-xl md:text-2xl font-medium font-roboto text-gray-800 uppercase mb-6">Shop By Category</h2>
            <div class="grid lg:grid-cols-8 md:grid-cols-6 grid-cols-3 lg:gap-6 md:gap-4 gap-2">
                <!-- single category -->
                <div v-for="i in [1, 2, 3, 4, 5, 6]" class="group flex flex-col rounded bg-white shadow overflow-hidden">
                    <!-- category image -->
                    <div class="relative p-2">
                        <img :src="`/images/categories/category-${i}.jpg`" class="w-full">
                        <div class="absolute inset-0 bg-gray-100 bg-opacity-40 flex items-center justify-center gap-2 opacity-0 group-hover:opacity-100 transition"></div>
                    </div>
                    <!-- category image end -->
                    <a href="">
                        <h4 class="font-medium text-sm text-center font-roboto line-clamp-2 mb-2 text-gray-800 hover:text-primary transition">
                            Category Name
                        </h4>
                    </a>
                </div>
                <!-- single category end -->
            </div>
        </div>
        <!-- shop by category end -->

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
    props: ['latest'],
    components: {
        AppLayout,
        Product,
        Slider,
        CategoryMenu,
    }
}
</script>
