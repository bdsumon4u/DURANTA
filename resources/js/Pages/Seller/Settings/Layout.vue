<template>
    <seller-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ ucfirst(active) }} Settings</h2>
        </template>
        <div class="flex flex-wrap py-3 lg:px-5 lg:py-7">
            <div class="px-3 mb-5 md:mb-0 w-full lg:w-80">
                <ul class="px-0 border">
                    <template v-for="tab in tabs">
                        <li class="border list-none rounded-sm" :class="[tab === active ? 'bg-gray-800 text-gray-200 border-blue-800' : 'text-gray-600']">
                            <inertia-link class="block px-3 py-2 italic text-sm font-semibold" :href="route('seller.settings', tab)">{{ ucfirst(tab) }}</inertia-link>
                        </li>
                    </template>
                </ul>
            </div>
            <div class="px-3 flex-1 mt-2 lg:mt-0">
                <div class="bg-white p-4 border shadow-sm">
                    <h3 class="text-xl mb-3">
                        <span class="border-b-2 border-dashed italic font-semibold">{{ ucfirst(active) }}</span>
                    </h3>
                    <jet-validation-errors class="mb-3" />
                    <slot></slot>
                </div>
            </div>
        </div>
    </seller-layout>
</template>
<script>
import SellerLayout from "@/Layouts/SellerLayout";
import JetValidationErrors from "@/Jetstream/ValidationErrors";

export default {
    props: ['tabs', 'active'],

    components: {
        SellerLayout,
        JetValidationErrors,
    },
}
</script>
