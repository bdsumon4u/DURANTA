<template>
    <seller-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Campaigns
            </h2>
        </template>
        <div class="py-6">
            <div class="shadow sm:rounded-md flex flex-col overflow-hidden">
                <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="align-middle inline-block min-w-full sm:px-6 lg:px-8">
                        <div class="overflow-hidden border border-gray-200">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Name
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Starts AT
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Ends AT
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Deadline
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Products</th>
                                </tr>
                                </thead>
                                <tbody class="bg-white text-sm divide-y divide-gray-200">
                                <tr v-for="campaign in campaigns.data" :key="campaign.id">
                                    <td class="px-6 py-4 whitespace-nowrap">{{ campaign.name }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ campaign.starts_at }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ campaign.ends_at }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ campaign.deadline }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <inertia-link class="bg-primary px-3 py-1 text-gray-100 hover:text-white rounded-sm" :href="route('seller.campaigns.edit', campaign.id)">Products</inertia-link>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <pagination :links="campaigns.meta.links" />
        </div>
    </seller-layout>
</template>

<script>
import SellerLayout from "@/Layouts/SellerLayout";
import Pagination from "@/Components/Pagination";

export default {
    name: "Index",
    components: {
        Pagination,
        SellerLayout,
    },
    props: ['campaigns'],
}
</script>
