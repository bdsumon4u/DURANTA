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

        <!-- campaign -->
        <div v-if="campaign.data.id && counting" class="container pb-16">
            <div :class="{'md:flex justify-between': campaign.data.starts_in}">
                <h2 class="text-xl md:text-2xl font-medium font-roboto text-gray-800 uppercase mb-2">{{ campaign.data.name }}</h2>
                <div class="flex items-center justify-between text-xs md:text-sm mb-4">
                    <vue-countdown tag="div" class="flex" :time="time" :transform="transformSlotProps" @end="onCountdownEnd" v-slot="{ days, hours, minutes, seconds }">
                        <div class="bg-black px-3 py-1 mr-2 rounded-sm text-white">{{ campaign.data.starts_in ? 'Starts' : 'Ends' }} in</div>
                        <template v-if="days">
                            <div class="bg-primary px-2 py-1 rounded-sm text-white">{{ days }}</div>
                            <div class="py-1 mx-1 rounded-sm text-primary">:</div>
                        </template>
                        <div class="bg-primary px-2 py-1 rounded-sm text-white">{{ hours }}</div>
                        <div class="py-1 mx-1 rounded-sm text-primary">:</div>
                        <div class="bg-primary px-2 py-1 rounded-sm text-white">{{ minutes }}</div>
                        <div class="py-1 mx-1 rounded-sm text-primary">:</div>
                        <div class="bg-primary px-2 py-1 rounded-sm text-white">{{ seconds }}</div>
                    </vue-countdown>
                    <div v-if="!campaign.data.starts_in">
                        <inertia-link :href="route('campaigns.show', campaign.data.slug)" class="bg-black px-3 py-1 ml-2 rounded-sm text-white text-center font-bold">View All</inertia-link>
                    </div>
                </div>
            </div>
            <div v-if="campaign.data.starts_in">
                <img class="w-full" :src="campaign.data.image" alt="Campaign Image">
            </div>
            <!-- product wrapper -->
            <div v-else class="grid lg:grid-cols-6 sm:grid-cols-3 grid-cols-2 lg:gap-6 md:gap-4 gap-2">
                <!-- single product -->
                <template v-for="product in campaign.data.products">
                    <product :campaign="campaign.data" :product="product" />
                </template>
                <!-- single product end -->
            </div>
            <!-- product wrapper end -->
        </div>
        <!-- campaign end -->

        <!-- shop by brand -->
        <div class="container pb-16">
            <h2 class="text-xl md:text-2xl font-medium font-roboto text-gray-800 uppercase mb-6">Shop By Brand</h2>
            <div class="grid lg:grid-cols-8 md:grid-cols-6 grid-cols-3 lg:gap-6 md:gap-4 gap-2">
                <!-- single brand -->
                <div v-for="brand in brands.data" class="group flex flex-col rounded bg-white shadow overflow-hidden">
                    <inertia-link :href="route('brands.show', brand.slug)">
                        <!-- brand image -->
                        <div class="relative p-2">
                            <img :src="brand.image" class="w-full">
                            <div class="absolute inset-0 bg-gray-100 bg-opacity-40 flex items-center justify-center gap-2 opacity-0 group-hover:opacity-100 transition"></div>
                        </div>
                        <!-- brand image end -->
                        <h4 class="font-medium text-sm text-center font-roboto line-clamp-2 mb-2 text-gray-800 hover:text-primary transition">{{ brand.name }}</h4>
                    </inertia-link>
                </div>
                <!-- single brand end -->
                <div v-if="brands.data.length === 15" class="group p-4 flex flex-col justify-around rounded bg-white shadow overflow-hidden">
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
                <div v-for="store in stores.data" class="group flex flex-col rounded bg-white shadow overflow-hidden">
                    <inertia-link :href="route('sellers.show', store.slug)">
                        <!-- store image -->
                        <div class="relative p-2">
                            <img :src="store.store_logo" class="w-full">
                            <div class="absolute inset-0 bg-gray-100 bg-opacity-40 flex items-center justify-center gap-2 opacity-0 group-hover:opacity-100 transition"></div>
                        </div>
                        <!-- store image end -->
                        <h4 class="font-medium text-sm text-center font-roboto line-clamp-2 mb-2 text-gray-800 hover:text-primary transition">{{ store.store_name }}</h4>
                    </inertia-link>
                </div>
                <!-- single store end -->
                <div v-if="stores.data.length === 15" class="group p-4 flex flex-col justify-around rounded bg-white shadow overflow-hidden">
                    <p class="mb-4 font-bold text-gray-700 text-sm text-center">
                        <span class="block">View all Stores Available in</span>
                        <span class="block">{{ $page.props.app_name }}</span>
                    </p>
                    <inertia-link :href="route('sellers')" class="rounded overflow-hidden relative whitespace-nowrap bg-black text-white px-4 py-2">
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
        <!-- shop by store end -->

        <template v-for="widget in widgets.data">
            <!-- products widget -->
            <div v-if="widget.name === 'Products'" class="container pb-16">
                <div class="flex items-center justify-between text-xs md:text-sm mb-6">
                    <h2 class="text-xl md:text-2xl font-medium font-roboto text-gray-800 uppercase mr-2">{{ widget.title }}</h2>
                    <div class="border-t border-2 flex-1"></div>
                    <inertia-link :href="route('widget', widget.slug)" class="bg-black px-3 py-1 ml-2 rounded-sm text-white text-center font-bold">View All</inertia-link>
                </div>

                <!-- product wrapper -->
                <div class="grid lg:grid-cols-6 sm:grid-cols-3 grid-cols-2 lg:gap-6 md:gap-4 gap-2">
                    <!-- single product -->
                    <template v-for="product in widget.products">
                        <product :product="product" />
                    </template>
                    <!-- single product end -->
                </div>
                <!-- product wrapper end -->
            </div>
            <!-- products widget end -->

            <!-- ad section -->
            <div v-else-if="widget.name === 'Banner'" class="container pb-16">
                <inertia-link :href="widget.link">
                    <img :src="widget.image" class="w-full" :alt="widget.title">
                </inertia-link>
            </div>
            <!-- ad section end -->
        </template>
    </app-layout>
</template>

<script>
import CategoryMenu from "@/Components/Site/CategoryMenu";
import Slider from "@/Components/Site/Slider";
import Product from "@/Components/Site/Product";
import AppLayout from "../Layouts/AppLayout";
import VueCountdown from '@chenfengyuan/vue-countdown';

export default {
    name: "Home",
    props: ['brands', 'stores', 'campaign', 'widgets'],
    components: {
        AppLayout,
        Product,
        Slider,
        CategoryMenu,
        VueCountdown,
    },
    computed: {
        time() {
            return !!this.campaign.data.starts_in
                ? this.campaign.data.starts_in
                : this.campaign.data.ends_in;
        }
    },
    methods: {
        transformSlotProps(props) {
            const formattedProps = {};

            Object.entries(props).forEach(([key, value]) => {
                formattedProps[key] = value < 10 ? `0${value}` : String(value);
            });

            return formattedProps;
        },
        onCountdownEnd() {
            this.counting = !!this.campaign.data.ends_in;
        }
    },
    data() {
        return {
            counting: !!this.campaign.data.ends_in,
        }
    },
    created() {
        const general = this.$page.props.settings.general;
        this.makeTitle(general.site_name + ' | ' + general.tagline)
    }
}
</script>
