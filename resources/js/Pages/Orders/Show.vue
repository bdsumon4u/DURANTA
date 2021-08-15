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
                                        <table class="overflow-hidden border border-gray-200 min-w-full divide-y divide-gray-200">
                                            <thead class="bg-gray-50">
                                            <tr>
                                                <th scope="col" class="px-3 py-2 text-left text-xs font-bold bg-gray-100 text-gray-500 uppercase tracking-wider">
                                                    Product
                                                </th>
                                                <th scope="col" class="px-3 py-2 text-left text-xs font-bold bg-gray-100 text-gray-500 uppercase tracking-wider">
                                                    Price
                                                </th>
                                                <th scope="col" class="px-3 py-2 text-left text-xs font-bold bg-gray-100 text-gray-500 uppercase tracking-wider">
                                                    Discount
                                                </th>
                                                <th scope="col" class="px-3 py-2 text-left text-xs font-bold bg-gray-100 text-gray-500 uppercase tracking-wider">
                                                    Total
                                                </th>
                                            </tr>
                                            </thead>
                                            <tbody class="bg-white text-sm divide-y divide-gray-200">
                                            <tr v-for="product in order.data.products" :key="product.id">
                                                <td class="px-3 py-2">
                                                    <div>
                                                        <inertia-link class="hover:underline" :href="route('products.show', product.slug)">{{ product.name }}</inertia-link>
                                                        <strong>&nbsp;x{{ product.pivot.quantity }}</strong>
                                                    </div>
                                                </td>
                                                <td class="px-3 py-2 whitespace-nowrap">{{ product.pivot.quantity }}x{{ moneyFormat(product.pivot.price) }}</td>
                                                <td class="px-3 py-2 whitespace-nowrap">{{ product.pivot.quantity }}x{{ moneyFormat(product.pivot.discount) }}</td>
                                                <td class="px-3 py-2 whitespace-nowrap text-sm text-gray-500">{{ calculateTotal(product) }}</td>
                                            </tr>
                                            </tbody>
                                            <tfoot class="bg-gray-100">
                                            <tr class="border-b">
                                                <th scope="col" class="px-3 py-2 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Total</th>
                                                <th scope="col" class="px-3 py-2 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">{{ moneyFormat(order.data.subtotal) }}</th>
                                                <th scope="col" class="px-3 py-2 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">{{ moneyFormat(order.data.discount) }}</th>
                                                <th scope="col" class="px-3 py-2 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">{{ moneyFormat(order.data.total) }}</th>
                                            </tr>
                                            <tr>
                                                <th scope="col" colspan="3" class="px-3 py-2 text-right text-xs font-bold text-gray-500 uppercase tracking-wider">Shipping</th>
                                                <th scope="col" class="px-3 py-2 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">{{ moneyFormat(order.data.shipping) }}</th>
                                            </tr>
                                            <tr>
                                                <th scope="col" colspan="3" class="px-3 py-2 text-right text-xs font-bold text-gray-500 uppercase tracking-wider">Payable</th>
                                                <th scope="col" class="px-3 py-2 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">{{ moneyFormat(order.data.total + order.data.shipping) }}</th>
                                            </tr>
                                            </tfoot>
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
