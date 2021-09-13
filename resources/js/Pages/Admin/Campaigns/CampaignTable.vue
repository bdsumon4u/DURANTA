<template>
    <div class="py-6 flex flex-col overflow-hidden">
        <div class="shadow overflow-x-auto border-b border-gray-200 sm:rounded-lg">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                <tr>
                    <th scope="col" class="md:w-32 px-3 py-3 text-xs text-center font-medium text-gray-500 uppercase tracking-wider">
                        Image
                    </th>
                    <th scope="col" class="px-3 py-3 text-xs text-left font-medium text-gray-500 uppercase tracking-wider">
                        Name
                    </th>
                    <th scope="col" class="px-3 py-3 text-xs text-left font-medium text-gray-500 uppercase tracking-wider">
                        Starts AT
                    </th>
                    <th scope="col" class="px-3 py-3 text-xs text-left font-medium text-gray-500 uppercase tracking-wider">
                        Ends AT
                    </th>
                    <th scope="col" class="px-3 py-3 text-xs text-left font-medium text-gray-500 uppercase tracking-wider">
                        Deadline
                    </th>
                    <th width="120" scope="col" class="px-3 py-3 text-xs text-center font-medium text-gray-500 uppercase tracking-wider">
                        Action
                    </th>
                </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    <tr v-for="(campaign, i) in campaigns.data" :key="campaign.id">
                        <td class="px-3 py-3 text-md text-left font-bold">
                            <img class="w-20 md:w-56 h-20 md:h-28 mx-auto" :src="image(campaign)" alt="Campaign Image">
                        </td>
                        <td class="px-3 py-3 whitespace-nowrap text-sm text-left font-bold">{{ campaign.name }}</td>
                        <td class="px-3 py-3 whitespace-nowrap text-sm text-left font-bold">{{ campaign.starts_at }}</td>
                        <td class="px-3 py-3 whitespace-nowrap text-sm text-left font-bold">{{ campaign.ends_at }}</td>
                        <td class="px-3 py-3 whitespace-nowrap text-sm text-left font-bold">{{ campaign.deadline }}</td>
                        <td class="px-3 py-3 whitespace-nowrap text-sm text-center font-medium border-l">
                            <div class="flex flex-col space-y-2">
                                <inertia-link class="px-4 py-2 border rounded-md bg-blue-600 text-gray-100 hover:bg-blue-700 hover:text-white" :href="route('admin.campaigns.edit', campaign.id)">Edit</inertia-link>
                                <button class="px-4 py-2 border rounded-md bg-red-600 text-gray-100 hover:bg-red-700 hover:text-white" type="button" @click.prevent="destroy(campaign)">Delete</button>
                            </div>
                        </td>
                    </tr>
                    <tr v-if="campaigns.data.length === 0">
                        <td colspan="3" class="text-center p-2">
                            <strong class="text-sm text-red-500">No Data Found.</strong>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <pagination :links="campaigns.links" />
    </div>
</template>

<script>
import Pagination from "@/Components/Pagination";

export default {
    name: "CampaignTable",
    components: {Pagination},
    props: ['campaigns'],
    methods: {
        image(campaign) {
            return campaign.image
                ? campaign.image
                : 'https://via.placeholder.com/112';
        },
        destroy(campaign) {
            this.$inertia.delete(route('admin.campaigns.destroy', campaign));
        }
    }
}
</script>
