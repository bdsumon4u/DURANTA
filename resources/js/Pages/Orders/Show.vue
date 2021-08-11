<template>
    <app-layout>
        <!-- account wrapper -->
        <div class="container lg:grid grid-cols-12 items-start gap-6 pt-4 pb-8">
            <!-- sidebar -->
            <sidebar />
            <!-- sidebar end -->

            <!-- account content -->
            <div class="col-span-9 grid gap-4 mt-6 lg:mt-0">
                <div class="overflow-hidden bg-white border-2">
                    <div class="p-6 border-b">
                        <div class="flex justify-between">
                            <h4 class="text-xl font-bold">
                                <span class="border-b-2">Order #{{ order.data.id }}</span>
                            </h4>
                            <inertia-link class="bg-gray-200 text-sm hover:bg-gray-100 px-2 py-1 rounded-sm" :href="route('orders.index')">Back To List</inertia-link>
                        </div>
                        <p class="text-sm mt-2">Was placed on <strong>{{ order.data.created_at }}</strong> and is currently <strong class="uppercase">{{ order.data.status }}</strong></p>
                    </div>

                    <div class="border-t">
                        <div class="flex flex-col overflow-hidden">
                            <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                                <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                                    <div class="overflow-hidden sm:rounded-lg">
                                        <table class="min-w-full divide-y divide-gray-200">
                                            <thead class="bg-gray-50">
                                                <tr>
                                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                        Product
                                                    </th>
                                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                        Total
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody class="bg-white border-t-2">
                                                <tr v-for="product in order.data.products" :key="product.id">
                                                    <td class="px-6 py-2 whitespace-nowrap">
                                                        <inertia-link class="text-blue-500 hover:underline hover:text-blue-600" :href="route('products.show', product.slug)">{{ product.name }}</inertia-link> x{{ product.pivot.quantity }}
                                                    </td>
                                                    <td class="px-6 py-2 whitespace-nowrap">{{ product.pivot.quantity * product.pivot.price }}</td>
                                                </tr>
                                            </tbody>
                                            <tbody class="bg-white border-t-2">
                                                <tr v-for="item in ['subtotal', 'discount', 'shipping']">
                                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                        {{ ucfirst(item) }}
                                                    </th>
                                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ order.data[item] }}</th>
                                                </tr>
                                            </tbody>
                                            <tbody class="bg-white border-t-2">
                                                <tr>
                                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                        Total
                                                    </th>
                                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ order.data.total }}</th>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
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
    name: "Show",
    props: ['order'],
    components: {
        AppLayout,
        Sidebar,
    }
}
</script>
