<template>
    <admin-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Edit Order
            </h2>
        </template>
        <div>
            <div class="flex justify-center flex-wrap lg:space-x-5">
                <div class="flex-1 overflow-x-auto">
                    <div class="bg-white py-6 px-4">
                        <div class="print:hidden flex justify-end items-center mb-4 pb-4 border-b">
                            <div class="flex-1 text-2xl uppercase font-bold">
                                Edit Order
                            </div>
                            <div class="relative mr-4 inline-block">
                                <div class="text-gray-500 cursor-pointer w-10 h-10 rounded-md bg-gray-100 hover:bg-gray-300 inline-flex items-center justify-center" @mouseenter="showTooltip = 'print'" @mouseleave="showTooltip = false" @click="printInvoice()">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-printer" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <rect x="0" y="0" width="24" height="24" stroke="none"></rect>
                                        <path d="M17 17h2a2 2 0 0 0 2 -2v-4a2 2 0 0 0 -2 -2h-14a2 2 0 0 0 -2 2v4a2 2 0 0 0 2 2h2" />
                                        <path d="M17 9v-4a2 2 0 0 0 -2 -2h-6a2 2 0 0 0 -2 2v4" />
                                        <rect x="7" y="13" width="10" height="8" rx="2" />
                                    </svg>
                                </div>
                                <div v-show="showTooltip === 'print'" class="print:hidden z-40 shadow-lg text-center w-32 block absolute right-0 top-0 p-2 mt-12 rounded-lg bg-gray-800 text-white text-xs">
                                    Print this invoice!
                                </div>
                            </div>

                            <div class="relative inline-block">
                                <div class="text-gray-500 cursor-pointer w-10 h-10 rounded-md bg-gray-100 hover:bg-gray-300 inline-flex items-center justify-center" @mouseenter="showTooltip = 'reload'" @mouseleave="showTooltip = false" @click="reloadWindow()">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-refresh" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <rect x="0" y="0" width="24" height="24" stroke="none"></rect>
                                        <path d="M20 11a8.1 8.1 0 0 0 -15.5 -2m-.5 -5v5h5" />
                                        <path d="M4 13a8.1 8.1 0 0 0 15.5 2m.5 5v-5h-5" />
                                    </svg>
                                </div>
                                <div v-show="showTooltip === 'reload'" class="print:hidden z-40 shadow-lg text-center w-32 block absolute right-0 top-0 p-2 mt-12 rounded-lg bg-gray-800 text-white text-xs">
                                    Reload Page
                                </div>
                            </div>
                        </div>

                        <!-- Print Template -->
                        <div id="js-print-template" ref="printTemplate" class="nhidden print:block mb-5">
                            <div class="mb-4 flex justify-between">
                                <div>
                                    <h2 class="text-3xl font-bold mb-2 tracking-wider uppercase flex items-center">
                                        <span>Invoice</span>
                                        <span class="px-2 py-1 ml-2 bg-primary rounded-sm text-sm font-bold text-white">{{ order.data.due > 0 ? (order.data.paid ? 'Partially Paid' : 'Unpaid') : 'PAID' }}</span>
                                    </h2>

                                    <div class="flex items-center">
                                        <label class="w-32 text-gray-800 block font-bold text-xs uppercase tracking-wide">Invoice No.</label>
                                        <span class="mr-4 inline-block">:</span>
                                        <div v-text="invoiceNumber"></div>
                                    </div>

                                    <div class="print:hidden">
                                        <div class="flex items-center">
                                            <label class="w-32 text-gray-800 block font-bold text-sm uppercase tracking-wide">Invoice Date</label>
                                            <span class="mr-4 inline-block hidden md:block">:</span>
                                            <div class="flex-1">
                                                <input class="bg-gray-200 appearance-none border-0 border-gray-200 rounded w-36 py-1 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-blue-500 js-datepicker" type="text" placeholder="eg. 17 Feb, 2021" v-model="form.invoiceDate" autocomplete="off">
                                            </div>
                                        </div>

                                        <div class="flex items-center">
                                            <label class="w-32 text-gray-800 block font-bold text-sm uppercase tracking-wide">Due Date</label>
                                            <span class="mr-4 inline-block hidden md:block">:</span>
                                            <div class="flex-1">
                                                <input class="bg-gray-200 appearance-none border-0 border-gray-200 rounded w-36 py-1 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-blue-500 js-datepicker-2" type="text" placeholder="eg. 17 Mar, 2021" v-model="form.dueDate" autocomplete="off">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="hidden print:block">
                                        <div class="flex items-center">
                                            <label class="w-32 text-gray-800 block font-bold text-xs uppercase tracking-wide">Invoice Date</label>
                                            <span class="mr-4 inline-block">:</span>
                                            <div v-text="form.invoiceDate"></div>
                                        </div>

                                        <div class="flex items-center">
                                            <label class="w-32 text-gray-800 block font-bold text-xs uppercase tracking-wide">Due Date</label>
                                            <span class="mr-4 inline-block">:</span>
                                            <div v-text="form.dueDate"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="hidden print:block md:block pr-5">
                                    <div class="w-32 h-32 mb-1 overflow-hidden">
                                        <inertia-link :href="route('home')" class="flex w-28 h-9 justify-center items-center text-primary border border-primary font-semibold font-roboto-condensed text-2xl">
                                            DURANTA
                                        </inertia-link>
                                    </div>
                                </div>
                            </div>
                            <div class="hidden flex flex-wrap justify-between mb-8">
                                <div class="w-full md:w-1/3 mb-2 md:mb-0">
                                    <label class="text-gray-800 block mb-1 font-bold text-sm uppercase tracking-wide">Bill/Ship To:</label>
                                    <input class="mb-1 bg-gray-200 appearance-none border border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-blue-500" type="text" placeholder="Contact Name" v-model="form.contact_name">
                                    <input class="mb-1 bg-gray-200 appearance-none border border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-blue-500" type="text" placeholder="Contact Phone" v-model="form.contact_phone">
                                    <input class="mb-1 bg-gray-200 appearance-none border border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-blue-500" type="text" placeholder="Full Address" v-model="form.address.address">
                                </div>
                                <div class="w-full md:w-1/3">
                                    <label class="text-gray-800 block mb-1 font-bold text-sm uppercase tracking-wide">From:</label>
                                    <input class="mb-1 bg-gray-200 appearance-none border border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-blue-500" type="text" placeholder="Your Company Name" v-model="company.name">
                                    <input class="mb-1 bg-gray-200 appearance-none border border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-blue-500" type="text" placeholder="Your Company Phone" v-model="company.phone">
                                    <input class="mb-1 bg-gray-200 appearance-none border border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-blue-500" type="text" placeholder="Your Company Address" v-model="company.address">
                                </div>
                            </div>

                            <div class="flex gap-3 justify-between mb-4">
                                <div class="w-1/2">
                                    <label class="text-gray-800 block mb-2 font-bold text-xs uppercase tracking-wide">Bill/Ship To:</label>
                                    <div class="font-bold text-sm">
                                        <div v-text="order.data.contact_name"></div>
                                        <div v-text="order.data.contact_phone"></div>
                                        <div class="text-break" v-text="order.data.address.address"></div>
                                    </div>
                                </div>
                                <div class="w-1/2">
                                    <label class="text-gray-800 block mb-2 font-bold text-xs uppercase tracking-wide">From:</label>
                                    <div class="font-bold text-sm">
                                        <div v-text="company.name"></div>
                                        <div v-text="company.phone"></div>
                                        <div class="text-break" v-text="company.address"></div>
                                    </div>
                                </div>
                            </div>

                            <div class="flex flex-col overflow-hidden">
                                <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
                                    <div class="align-middle inline-block min-w-full sm:px-6 lg:px-8">
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
                                                    <p class="print:hidden whitespace-nowrap ml-5">By, <inertia-link class="text-primary hover:underline" :href="route('admin.sellers.show', product.seller_id)">{{ product.seller }}</inertia-link></p>
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
                        <!-- /Print Template -->

                        <div class="flex flex-wrap">
                            <div class="w-72 md:mr-2">
                                <div class="p-3 rounded-md border shadow-sm">
                                    <form @submit.prevent="submit">
                                        <validation-errors />
                                        <div class="mb-2">
                                            <label class="block mb-2 text-sm font-bold text-gray-700" for="pay-now">Cash On Delivery</label>
                                            <input v-model="form.cash_on_delivery" :disabled="order.data.due <= 0" class="w-full px-3 py-2 text-sm leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline" id="pay-now" type="text">
                                        </div>
                                        <button type="submit" class="px-2 py-1 bg-primary rounded-sm text-sm font-bold text-white" :disabled="order.data.due <= 0">Paid COD</button>
                                    </form>
                                </div>
                            </div>
                            <div class="flex-1 w-full">
                                <div class="overflow-x-auto">
                                    <div class="align-middle inline-block min-w-full">
                                        <payment-history :payments="order.data.payments" :paid="order.data.paid" :due="order.data.due" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="w-96 print:hidden">
                    <div class="sm:max-w-lg w-full px-8 py-8 bg-white rounded-xl z-10">
                        <form @submit.prevent="submit">
                            <div class="mb-4">
                                <validation-errors />
                            </div>
                            <div class="w-full mb-4">
                                <label class="block mb-2 text-sm font-bold text-gray-700" for="status">Status</label>
                                <Multiselect id="status" v-model="form.status" mode="single" :options="statuses" placeholder="Select Status" />
                            </div>
                            <div class="w-full mb-4">
                                <label class="block mb-2 text-sm font-bold text-gray-700" for="shipping">Shipping</label>
                                <input type="text" id="shipping" v-model="form.shipping" class="w-full px-3 py-2 text-sm leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline" placeholder="Charge">
                            </div>
                            <div>
                                <button type="submit" class="w-full flex justify-center bg-blue-500 text-gray-100 p-4 rounded-md tracking-wide
                                    font-semibold focus:outline-none focus:shadow-outline hover:bg-blue-600 shadow-md cursor-pointer transition ease-in duration-300">
                                    Update
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </admin-layout>
</template>

<script>
import AdminLayout from "@/Layouts/AdminLayout";
import Multiselect from '@vueform/multiselect'
import PaymentHistory from "@/Components/PaymentHistory";
import ValidationErrors from "@/Jetstream/ValidationErrors";

export default {
    name: "Show",
    props: ['order', 'invoiceDate', 'dueDate'],
    components: {
        AdminLayout,
        Multiselect,
        PaymentHistory,
        ValidationErrors,
    },
    computed: {
        invoiceNumber() {
            return '#INV-'+ this.form.id.toString().padStart(6, '0');
        },
        company() {
            return {
                name: this.$page.props.app_name,
                phone: '+880 1783 110 247',
                address: 'Mirpur-10, Dhaka-BD.',
            }
        }
    },
    methods: {
        printInvoice() {
            window.print();
        },
        reloadWindow() {
            window.location.reload();
        },

        submit() {
            this.form.patch(route('admin.orders.update', this.form.id));
        }
    },
    data() {
        return {
            form: this.$inertia.form({
                ...this.order.data,
                invoiceDate: this.invoiceDate,
                dueDate: this.dueDate,
                cash_on_delivery: 0,
            }),
            showTooltip: false,
            statuses: [
                'PENDING',
                'PROCESSING',
                'PICKED',
                'SHIPPING',
                'DELIVERED',
                'COMPLETED',
                'RETURNED',
                'REFUNDED',
            ],
        }
    },
    created() {
        this.makeTitle('Admin Order Editor')
    }
}
</script>

<style scoped>
@import "~@vueform/multiselect/themes/default.css";
</style>
