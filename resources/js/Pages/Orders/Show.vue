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
                                <span class="px-2 py-1 ml-2 bg-primary rounded-sm text-sm font-bold text-white">{{ order.data.due > 0 ? (order.data.paid ? 'Partially Paid' : 'Unpaid') : 'PAID' }}</span>
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
                                                <th scope="col" class="px-3 py-2 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">{{ moneyFormat(order.data.payable) }}</th>
                                            </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                            </div>

                            <div class="flex flex-wrap my-5">
                                <div class="w-72 px-3">
                                    <div class="p-3 rounded-md border shadow-sm">
                                        <form @submit.prevent="pay">
                                            <validation-errors />
                                            <div class="mb-2">
                                                <label class="block mb-2 text-sm font-bold text-gray-700" for="pay-now">I want to pay now</label>
                                                <input v-model="form.amount" :disabled="order.data.due <= 0" class="w-full px-3 py-2 text-sm leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline" id="pay-now" type="text">
                                            </div>
                                            <p class="block mb-2 text-sm font-semibold text-gray-700">I will pay later: <span class="font-bold text-primary">{{ moneyFormat(payLater) }}</span></p>
                                            <button type="submit" class="px-2 py-1 bg-primary rounded-sm text-sm font-bold text-white" :disabled="order.data.due <= 0">Make Payment</button>
                                        </form>
                                    </div>
                                </div>
                                <div class="flex-1">
                                    <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                                        <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                                            <payment-history :payments="order.data.payments" :paid="order.data.paid" :due="order.data.due" />
                                        </div>
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
import {moneyFormat} from '@/functions';
import AppLayout from "@/Layouts/AppLayout";
import PaymentHistory from "@/Components/PaymentHistory";
import Sidebar from "../Sidebar";
import ValidationErrors from "@/Jetstream/ValidationErrors";

export default {
    name: "Show",
    props: ['order'],
    components: {
        AppLayout,
        PaymentHistory,
        Sidebar,
        ValidationErrors,
    },
    computed: {
        payLater() {
            return this.order.data.due - this.form.amount;
        }
    },
    methods: {
        pay() {
            this.form.post(route('orders.payments.store', {order: this.order.data.id}))
        }
    },
    data() {
        return {
            form: this.$inertia.form({
                amount: this.order.data.due,
            })
        }
    }
}
</script>
