<template>
    <app-layout>
        <!-- breadcrumb -->
        <breadcrumb :items="[{title: 'Campaigns', link: route('campaigns')}, {title: campaign.data.name}]" />
        <!-- breadcrumb end -->

        <!-- products wrapper -->
        <div class="container grid lg:grid-cols-4 gap-6 pt-4 pb-16 items-start relative">
            <!-- products -->
            <div class="col-span-4">
                <vue-countdown tag="div" class="flex mb-4" :time="campaign.data.ends_in" :transform="transformSlotProps" @end="onCountdownEnd" v-slot="{ days, hours, minutes, seconds }">
                    <div class="bg-black px-3 py-1 mr-2 rounded-sm text-white">Ends in</div>
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

                <!-- product wrapper -->
                <div class="grid lg:grid-cols-6 md:grid-cols-4 grid-cols-2 lg:gap-4 md:gap-3 gap-2">
                    <!-- single product -->
                    <template v-for="product in products.data">
                        <product :campaign="campaign.data" :product="product" />
                    </template>
                    <!-- single product end -->
                </div>
                <template v-if="products.meta.total > products.meta.per_page">
                    <pagination :links="products.meta.links" />
                </template>
                <!-- product wrapper end -->
            </div>
            <!-- products end -->
        </div>
        <!-- products wrapper end -->
    </app-layout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout";
import Breadcrumb from "@/Components/Site/Breadcrumb";
import JetDropdown from "@/Jetstream/Dropdown";
import Pagination from "@/Components/Pagination";
import VueCountdown from "@chenfengyuan/vue-countdown";
import Product from "@/Components/Site/Product";

export default {
    name: "Show",
    props: ['products', 'campaign'],
    components: {
        Product,
        AppLayout,
        Breadcrumb,
        JetDropdown,
        Pagination,
        VueCountdown,
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
            this.$inertia.visit(route('campaigns'));
        }
    },
    data() {
        return {
            counting: !!this.campaign.data.ends_in,
        };
    },
    created() {
        this.makeTitle(this.campaign.data.name)
    }
}
</script>
