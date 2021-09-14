<template>
    <admin-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Pages
            </h2>
        </template>
        <div class="flex flex-col overflow-hidden">
            <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                    <div class="shadow-md overflow-hidden border border-gray-200 sm:rounded-md">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Title
                                </th>
                                <th scope="col" class="w-40 text-center px-3 py-1 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Action
                                </th>
                            </tr>
                            </thead>
                            <tbody class="bg-white text-sm divide-y divide-gray-200">
                            <tr v-for="page in pages.data" :key="page.id">
                                <td class="px-6 py-4 whitespace-nowrap text-blue-500 hover:underline hover:text-blue-600">
                                    <inertia-link :href="route('page', page)">{{ page.title }}</inertia-link>
                                </td>
                                <td class="px-3 py-1 whitespace-nowrap text-sm text-center font-medium w-28 border-l">
                                    <div class="flex flex-col space-y-1">
                                        <inertia-link class="px-2 py-1 border rounded-md bg-blue-600 text-gray-100 hover:bg-blue-700 hover:text-white" :href="route('admin.pages.edit', page)">Edit</inertia-link>
                                        <button class="px-2 py-1 border rounded-md bg-red-600 text-gray-100 hover:bg-red-700 hover:text-white" type="button" @click.prevent="destroy(page)">Delete</button>
                                    </div>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <pagination :links="pages.links" />
                </div>
            </div>
        </div>
    </admin-layout>
</template>

<script>
import AdminLayout from "@/Layouts/AdminLayout";
import Pagination from "@/Components/Pagination";

export default {
    name: "Index",
    props: ['pages'],
    components: {
        Pagination,
        AdminLayout,
    },
    methods: {
        destroy(page) {
            this.$inertia.delete(route('admin.pages.destroy', page));
        }
    },
    created() {
        this.makeTitle('Admin Pages')
    }
}
</script>
