<template>
    <admin-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ ucfirst(this.status ?? '')}} Sellers
            </h2>
        </template>
        <div class="py-6">
            <div class="flex flex-col overflow-hidden">
                <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                        <div class="shadow-md overflow-hidden border border-gray-200 sm:rounded-md">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        ID
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Name
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Phone
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Store Name
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Store Address
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Status
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Sellership
                                    </th>
                                </tr>
                                </thead>
                                <tbody class="bg-white text-sm divide-y divide-gray-200">
                                <tr v-for="seller in sellers.data" :key="seller.id">
                                    <td class="px-6 py-4 whitespace-nowrap text-blue-500 hover:underline hover:text-blue-600">
                                        <inertia-link :href="route('admin.sellers.show', seller)">#{{ seller.id }}</inertia-link>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ seller.name }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-blue-500 hover:text-blue-600">
                                        <a :href="`tel:${seller.phone}`">{{ seller.phone }}</a>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ seller.sellership.store_name }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ seller.sellership.store_address }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                      <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-md uppercase bg-green-100 text-green-800">
                                        {{ seller.sellership.status }}
                                      </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <inertia-link class="bg-primary px-3 py-1 text-gray-100 hover:text-white rounded-sm" :href="route('admin.sellerships.edit', seller.sellership)">Review</inertia-link>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <pagination :links="sellers.links" />
                    </div>
                </div>
            </div>
        </div>
    </admin-layout>
</template>

<script>
import AdminLayout from "@/Layouts/AdminLayout";
import Pagination from "../../../Components/Pagination";

export default {
    name: "Index",
    components: {
        Pagination,
        AdminLayout,
    },
    props: ['sellers', 'status'],
}
</script>
