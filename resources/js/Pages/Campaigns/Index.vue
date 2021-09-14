<template>
    <app-layout>
        <div class="container pb-16">
            <div class="grid lg:gap-6 md:gap-4 gap-2">
                <div class="my-4"></div>
                <!-- single campaign -->
                <div v-for="campaign in campaigns.data" class="group flex flex-col rounded bg-white shadow overflow-hidden">
                    <div class="px-4 pt-4 md:flex justify-between">
                        <h2 class="text-xl md:text-2xl font-medium font-roboto text-gray-800 uppercase mb-2">{{ campaign.name }}</h2>
                        <div class="flex items-center justify-between text-xs md:text-sm mb-4">
                            <vue-countdown tag="div" class="flex" :time="campaign.starts_in ? campaign.starts_in : campaign.ends_in" :transform="transformSlotProps" @end="onCountdownEnd" v-slot="{ days, hours, minutes, seconds }">
                                <div class="bg-black px-3 py-1 mr-2 rounded-sm text-white">{{ campaign.starts_in ? 'Starts' : 'Ends' }} in</div>
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
                            <div v-if="!campaign.starts_in">
                                <inertia-link :href="route('campaigns.show', campaign.slug)" class="bg-black px-3 py-1 ml-2 rounded-sm text-white font-bold">View All</inertia-link>
                            </div>
                        </div>
                    </div>
                    <!-- campaign image -->
                    <div class="relative p-2">
                        <img :src="campaign.image" class="w-full">
                        <div class="absolute inset-0 bg-gray-100 bg-opacity-40 flex items-center justify-center gap-2 opacity-0 group-hover:opacity-100 transition"></div>
                    </div>
                    <!-- campaign image end -->
                </div>
                <!-- single campaign end -->
            </div>

            <template v-if="campaigns.meta.total > campaigns.meta.per_page">
                <pagination :links="campaigns.meta.links" />
            </template>
        </div>
    </app-layout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout";
import Pagination from "@/Components/Pagination";
import VueCountdown from "@chenfengyuan/vue-countdown";

export default {
    name: "Index",
    props: ['campaigns'],
    components: {
        Pagination,
        AppLayout,
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
            this.$inertia.reload();
        }
    },
    created() {
        this.makeTitle(this.$page.props.settings.general.site_name + ' | Campaigns')
    }
}
</script>
