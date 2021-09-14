<template>
    <app-layout>
        <!-- account wrapper -->
        <div class="container lg:grid grid-cols-12 items-start gap-6 pt-4 pb-8">
            <!-- sidebar -->
            <sidebar />
            <!-- sidebar end -->

            <!-- account content -->
            <div class="col-span-9 grid gap-4 mt-6 lg:mt-0">
                <div class="flex flex-col overflow-hidden">
                    <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                        <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                            <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                                <table class="min-w-full divide-y divide-gray-200">
                                    <thead class="bg-gray-50">
                                    <tr>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Order
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Date
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Address
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Status
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Total
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200">
                                        <tr v-for="order in orders.data" :key="order.id">
                                            <td class="px-6 py-4 whitespace-nowrap text-blue-500 hover:underline hover:text-blue-600">
                                                <inertia-link :href="route('orders.show', order)">#{{ order.id }}</inertia-link>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">{{ order.created_at }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-blue-500 hover:underline hover:text-blue-600">
                                                <inertia-link :href="route('address', order.address.type)">
                                                    {{ ucfirst(order.address.type) }}
                                                </inertia-link>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                              <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full uppercase bg-green-100 text-green-800">
                                                {{ order.status }}
                                              </span>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                Tk.{{ order.total }} for {{ order.products_count }} product(s).
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- account content end -->
        </div>
        <!-- account wrapper end -->
    </app-layout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout";
import Sidebar from "../Sidebar";
export default {
    name: "Index",
    props: ['orders'],
    components: {
        AppLayout,
        Sidebar,
    },
    created() {
        this.makeTitle(this.$page.props.settings.general.site_name + ' | Orders')
    }
}
</script>
