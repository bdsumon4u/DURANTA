<template>
    <admin-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ seller ? 'Seller' : '' }} Orders
            </h2>
        </template>
        <div class="flex flex-col overflow-hidden">
            <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                    <div class="flex mb-1 text-xs text-white font-bold">
                        <inertia-link href="" @click.prevent="search({status: ''})" class="rounded-sm m-1 p-2" :class="[active ? 'bg-gray-500' : 'bg-primary']" preserve-scroll>ALL</inertia-link>
                        <inertia-link href="" v-for="status in ['PENDING', 'PROCESSING', 'PICKED', 'SHIPPING', 'DELIVERED', 'COMPLETED', 'RETURNED', 'REFUNDED']" @click.prevent="search({status})" class="rounded-sm m-1 p-2" :class="[active === status ? 'bg-primary' : 'bg-gray-500']" preserve-scroll>{{ status }}</inertia-link>
                        <div class="ml-auto flex items-center justify-center">
                            <div class="flex rounded">
                                <input type="text" v-model="form.query" @keyup.enter="search" class="px-2 py-1 border border-black text-black focus:border-black rounded-l-md w-32 md:w-auto" placeholder="Search...">
                                <button @click.prevent="search" class="flex items-center justify-center px-4 bg-gray-700 hover:bg-black border border-black rounded-r-md">
                                    <svg class="w-5 h-5 text-white" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                        <path d="M16.32 14.9l5.39 5.4a1 1 0 0 1-1.42 1.4l-5.38-5.38a8 8 0 1 1 1.41-1.41zM10 16a6 6 0 1 0 0-12 6 6 0 0 0 0 12z" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="shadow-md overflow-hidden border border-gray-200 sm:rounded-md">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Order
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Name
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Phone
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    District
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Status
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Total
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Date
                                </th>
                            </tr>
                            </thead>
                            <tbody class="bg-white text-sm divide-y divide-gray-200">
                            <tr v-for="order in orders.data" :key="order.id">
                                <td class="px-6 py-4 whitespace-nowrap text-blue-500 hover:underline hover:text-blue-600">
                                    <inertia-link :href="route('admin.orders.edit', order)">#{{ order.id }}</inertia-link>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ order.contact_name }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ order.contact_phone }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ order.address.district }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                      <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full uppercase bg-green-100 text-green-800">
                                        {{ order.status }}
                                      </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    Tk.{{ order.total }} for {{ order.products_count }} product(s).
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ order.created_at }}</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <pagination :links="orders.meta.links" />
        </div>
    </admin-layout>
</template>

<script>
import AdminLayout from "@/Layouts/AdminLayout";
import Pagination from "@/Components/Pagination";

export default {
    name: "Index",
    props: ['orders', 'active', 'seller', 'query'],
    components: {
        Pagination,
        AdminLayout,
    },
    methods: {
        search(extra) {
            this.form.transform(data => ({...data, ...extra})).get(route('admin.orders.index'))
        }
    },
    data() {
        return {
            form: this.$inertia.form({
                query: this.query,
                seller: this.seller,
                status: this.active,
            })
        }
    },
    created() {
        this.makeTitle('Admin Orders')
    }
}
</script>
