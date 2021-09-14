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
                    <jet-dropdown align="left">
                        <template #trigger>
                            <button class="bg-primary border border-primary text-white px-10 py-3 font-medium rounded uppercase hover:bg-transparent hover:text-primary transition text-sm mr-3 focus:outline-none">
                                Filter
                            </button>
                        </template>
                        <template #content>
                            <ul class="p-2">
                                <inertia-link :href="current" :data="{sort: 'latest'}" class="block px-3 py-2 cursor-pointer hover:bg-gray-100 hover:text-primary">Latest</inertia-link>
                                <inertia-link :href="current" :data="{sort: 'price'}" class="block px-3 py-2 cursor-pointer hover:bg-gray-100 hover:text-primary">Price: Low to High</inertia-link>
                                <inertia-link :href="current" :data="{sort: '-price'}" class="block px-3 py-2 cursor-pointer hover:bg-gray-100 hover:text-primary">Price: High to Low</inertia-link>
                            </ul>
                        </template>
                    </jet-dropdown>
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
                <pagination :links="products.meta.links" />
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
import JetDropdown from "@/Jetstream/Dropdown";
import Pagination from "@/Components/Pagination";

export default {
    name: "Products",
    props: ['products'],
    components: {
        AppLayout,
        Breadcrumb,
        JetDropdown,
        Product,
        Pagination,
    },
    computed: {
        current() {
            return window.location.href;
        }
    },
    data() {
        return {
            showFilter: false,
        };
    },
    created() {
        this.makeTitle(this.$page.props.settings.general.site_name + ' | Products')
    }
}
</script>
