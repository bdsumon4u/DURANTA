<template>
    <app-layout>
        <!-- breadcrumb -->
        <breadcrumb :items="[{title: 'Products'}]" />
        <!-- breadcrumb end -->

        <!-- products wrapper -->
        <div class="container grid lg:grid-cols-4 gap-6 pt-4 pb-16 items-start relative">
            <!-- products -->
            <div class="col-span-4">
                <!-- sorting -->
                <div class="mb-4 flex items-center">
                    <button @click="showFilter =! showFilter"
                    class="bg-primary border border-primary text-white px-10 py-3 font-medium rounded uppercase hover:bg-transparent hover:text-primary transition text-sm mr-3 focus:outline-none">
                    Filter
                    </button>
                </div>
                <!-- sorting end -->
                <!-- product wrapper -->
                <div class="grid lg:grid-cols-6 md:grid-cols-4 grid-cols-2 lg:gap-4 md:gap-3 gap-2">
                    <!-- single product -->
                    <template v-for="product in products.data">
                        <product :product="product" />
                    </template>
                    <!-- single product end -->
                </div>
                <!-- product wrapper end -->
            </div>
            <!-- products end -->
        </div>
        <!-- products wrapper end -->
    </app-layout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout";
import Product from "@/Components/Site/Product";
import Breadcrumb from "@/Components/Site/Breadcrumb";

export default {
    name: "Products",
    props: ['products'],
    components: {
        AppLayout,
        Breadcrumb,
        Product,
    },
    data() {
        return {
            showFilter: false,
        };
    },
}
</script>
