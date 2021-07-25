<template>
    <div class="px-1 py-6">
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
                    <th width="120" scope="col" class="px-3 py-3 text-xs text-center font-medium text-gray-500 uppercase tracking-wider">
                        Action
                    </th>
                </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    <tr v-for="(category, i) in categories.data" :key="category.id">
                        <td class="px-3 py-3 text-md text-left font-bold">
                            <img class="w-20 md:w-28 h-20 md:h-28 mx-auto" :src="image(category)" alt="Brand Image">
                        </td>
                        <td class="px-3 py-3 whitespace-nowrap text-sm text-left font-bold border-r">{{ category.name }}</td>
                        <td class="px-3 py-3 whitespace-nowrap text-sm text-center font-medium border-l">
                            <div class="flex flex-col space-y-2">
                                <inertia-link class="px-4 py-2 border rounded-md bg-blue-600 text-gray-100 hover:bg-blue-700 hover:text-white" :href="route('admin.categories.edit', category.id)">Edit</inertia-link>
                                <button class="px-4 py-2 border rounded-md bg-red-600 text-gray-100 hover:bg-red-700 hover:text-white" type="button" @click.prevent="destroy(category)">Delete</button>
                            </div>
                        </td>
                    </tr>
                    <tr v-if="categories.data.length === 0">
                        <td colspan="3" class="text-center p-2">
                            <strong class="text-sm text-red-500">No Data Found.</strong>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div v-if="categories.links.length" class="mt-2">
            <div class="flex flex-wrap justify-center -mb-1">
                <template v-for="(link, k) in categories.links" :key="k">
                    <div v-if="link.url === null" class="mr-1 mb-1 px-4 py-3 text-sm leading-4 text-gray-400 border rounded" v-html="link.label" />
                    <inertia-link v-else class="mr-1 mb-1 px-4 py-3 text-sm leading-4 border rounded hover:bg-black hover:text-white focus:border-indigo-500 focus:text-indigo-500" :class="{ 'bg-blue-700 text-white': link.active }" :href="link.url" v-html="link.label" />
                </template>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "BrandTable",
    props: ['categories'],
    methods: {
        image(category) {
            return category.image
                ? category.image
                : 'https://via.placeholder.com/112';
        },
        destroy(category) {
            this.$inertia.delete(route('admin.categories.destroy', category));
        }
    }
}
</script>
