<template>
    <seller-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Dashboard
            </h2>
        </template>
        <div class="py-6">
            <img class="w-full mb-3" :src="campaign.data.image" alt="Campaign Image">
            <div class="flex justify-center flex-wrap lg:space-x-5">
                <div class="w-96">
                    <div class="sm:max-w-lg w-full p-8 bg-white rounded-xl z-10">
                        <div class="text-center">
                            <h2 class="text-2xl font-bold text-gray-900">Add Product</h2>
                            <p class="mt-2 text-sm text-gray-400">You're on "{{ campaign.data.name }}"</p>
                        </div>
                        <form class="mt-5 space-y-3" @submit.prevent="search">
                            <div class="flex items-center justify-center">
                                <div class="flex rounded">
                                    <input v-model="sku" type="text" class="px-3 py-1 border border-black focus:border-black rounded-l-md" placeholder="Product SKU">
                                    <button class="flex items-center justify-center px-5 bg-gray-700 hover:bg-black border-2 border-black rounded-r-md">
                                        <svg class="w-5 h-5 text-white" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                            <path d="M16.32 14.9l5.39 5.4a1 1 0 0 1-1.42 1.4l-5.38-5.38a8 8 0 1 1 1.41-1.41zM10 16a6 6 0 1 0 0-12 6 6 0 0 0 0 12z"></path>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </form>
                        <form v-if="product" class="mt-5 space-y-3" @submit.prevent="submit">
                            <div class="text-sm text-gray-800 mb-3">
                                Product: <a :href="route('products.show', product.data.slug)" target="_blank" class="hover:underline font-bold">{{ product.data.name }}</a>
                            </div>
                            <div class="flex items-center mx-3">
                                <ul class="font-bold text-sm">
                                    <li>ID: #{{ product.data.id }}</li>
                                    <li>Price: {{ moneyFormat(product.data.price) }}</li>
                                    <li>Discount: {{ moneyFormat(product.data.discount) }}</li>
                                    <li>Selling: {{ moneyFormat(product.data.price - product.data.discount) }}</li>
                                    <li>Fee: {{ moneyFormat(product.data.commission) }}</li>
                                    <li>Stock: {{ (product.data.stock_track ? product.data.stock_count : '') + ' In Stock' }}</li>
                                </ul>
                            </div>
                            <div class="w-full">
                                <label class="block mb-2 text-sm font-bold text-gray-700" for="discount">Campaign Discount</label>
                                <div class="flex">
                                    <input v-model="form.discount_amount" class="w-3/5 px-3 py-2 text-sm leading-tight text-gray-700 border rounded rounded-r-none mr-1 shadow appearance-none focus:outline-none focus:shadow-outline" id="discount" type="text" placeholder="Product Discount">
                                    <div class="w-2/5 flex border bg-white rounded rounded-l-none">
                                        <div class="w-1/2 radio-uc inline-flex rounded-lg">
                                            <input
                                                v-model="form.discount_type"
                                                type="radio"
                                                value="fixed"
                                                id="fixed-discount"
                                                name="discount"
                                                checked="checked"
                                                class="hidden"
                                            />
                                            <label
                                                for="fixed-discount"
                                                class="w-full text-center self-center text-black text-xs py-1 px-2 mx-1 rounded-lg cursor-pointer hover:opacity-75">
                                                Fixed
                                            </label>
                                        </div>
                                        <div class="w-1/2 radio-uc inline-flex rounded-lg">
                                            <input
                                                v-model="form.discount_type"
                                                type="radio"
                                                value="percent"
                                                name="discount"
                                                id="percent-discount"
                                                class="hidden"
                                            />
                                            <label
                                                for="percent-discount"
                                                class="w-full text-center self-center text-black text-xs py-1 px-2 mx-1 rounded-lg cursor-pointer hover:opacity-75">
                                                Percent
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <jet-input-error :message="form.errors.discount_amount" class="mt-2" />
                            </div>
                            <div>
                                <button type="submit" class="my-5 w-full flex justify-center bg-blue-500 text-gray-100 p-4 rounded-md tracking-wide font-semibold focus:outline-none focus:shadow-outline hover:bg-blue-600 shadow-md cursor-pointer transition ease-in duration-300">
                                    Add To Campaign
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="flex-1">
                    <div class="mb-3 flex flex-wrap text-xs bg-gray-300 text-white font-bold">
                        <inertia-link class="rounded-sm m-1 p-2" :class="[active ? 'bg-gray-500' : 'bg-primary']"
                                      :href="route('seller.campaigns.edit', {campaign: campaign.data.id, status: ''})"
                                      preserve-scroll>ALL
                        </inertia-link>
                        <inertia-link class="rounded-sm m-1 p-2"
                                      :class="[route().current('seller.campaigns.edit', {campaign: campaign.data.id, status: 'PENDING'}) ? 'bg-primary' : 'bg-gray-500']"
                                      :href="route('seller.campaigns.edit', {campaign: campaign.data.id, status: 'PENDING'})"
                                      preserve-scroll>PENDING
                        </inertia-link>
                        <inertia-link class="rounded-sm m-1 p-2"
                                      :class="[route().current('seller.campaigns.edit', {campaign: campaign.data.id, status: 'APPROVED'}) ? 'bg-primary' : 'bg-gray-500']"
                                      :href="route('seller.campaigns.edit', {campaign: campaign.data.id, status: 'APPROVED'})"
                                      preserve-scroll>APPROVED
                        </inertia-link>
                        <inertia-link class="rounded-sm m-1 p-2"
                                      :class="[route().current('seller.campaigns.edit', {campaign: campaign.data.id, status: 'REJECTED'}) ? 'bg-primary' : 'bg-gray-500']"
                                      :href="route('seller.campaigns.edit', {campaign: campaign.data.id, status: 'REJECTED'})"
                                      preserve-scroll>REJECTED
                        </inertia-link>
                    </div>
                    <div class="shadow sm:rounded-md flex flex-col overflow-hidden">
                        <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
                            <div class="align-middle inline-block min-w-full sm:px-6 lg:px-8">
                                <div class="overflow-hidden bproduct bproduct-gray-200">
                                    <table class="min-w-full divide-y divide-gray-200">
                                        <thead class="bg-gray-50">
                                        <tr>
                                            <th scope="col"
                                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Product
                                            </th>
                                            <th scope="col"
                                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Status
                                            </th>
                                            <th scope="col"
                                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Discount
                                            </th>
                                            <th scope="col"
                                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Selling
                                            </th>
                                            <th scope="col"
                                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Action
                                            </th>
                                        </tr>
                                        </thead>
                                        <tbody class="bg-white text-sm divide-y divide-gray-200">
                                        <tr v-for="product in products.data" :key="product.id">
                                            <td class="px-6 py-4">
                                                <div class="text-sm text-gray-800 mb-3">
                                                    <a :href="route('products.show', product.slug)" target="_blank" class="hover:underline font-bold">{{ product.name }}</a>
                                                </div>
                                                <div class="flex items-center mx-3">
                                                    <ul class="font-bold text-sm">
                                                        <li>ID: #{{ product.id }}</li>
                                                        <li>Price: {{ moneyFormat(product.price) }}</li>
                                                        <li>Discount: {{ moneyFormat(product.discount) }}</li>
                                                        <li>Selling: {{ moneyFormat(product.price - product.discount) }}</li>
                                                        <li>Fee: {{ moneyFormat(product.commission) }}</li>
                                                        <li>Stock: {{ (product.stock_track ? product.stock_count : '') + ' In Stock' }}</li>
                                                    </ul>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                              <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full uppercase bg-green-100 text-green-800">
                                                {{ product.pivot.status }}
                                              </span>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                {{ moneyFormat(product.pivot.discount) }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                {{ moneyFormat(product.pivot.selling) }}
                                            </td>
                                            <td class="px-3 py-3 whitespace-nowrap text-sm text-center font-medium w-28 border-l">
                                                <div class="flex flex-col space-y-2">
                                                    <inertia-link class="px-2 py-2 border rounded-md bg-blue-600 text-gray-100 hover:bg-blue-700 hover:text-white" :href="route('seller.campaigns.edit', {campaign: campaign.data.id, sku: product.sku})">Edit</inertia-link>
                                                    <button class="px-2 py-2 border rounded-md bg-red-600 text-gray-100 hover:bg-red-700 hover:text-white" type="button" @click.prevent="destroy(product.id)">Delete</button>
                                                </div>
                                            </td>
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
    </seller-layout>
</template>

<script>
import SellerLayout from "@/Layouts/SellerLayout";
import JetInputError from "@/Jetstream/InputError";

export default {
    name: "Edit",
    props: ['product', 'products', 'campaign', 'active'],
    components: {
        JetInputError,
        SellerLayout,
    },
    methods: {
        search() {
            this.$inertia.get(route('seller.campaigns.edit', {campaign: this.campaign.data.id, sku: this.sku}));
        },
        submit() {
            this.form.patch(route('seller.campaigns.update', {campaign: this.campaign.data.id}));
        },
        destroy(product_id) {
            this.$inertia.delete(route('seller.campaigns.destroy', {campaign: this.campaign.data.id, product_id}))
        }
    },
    data() {
        return {
            sku: this.product?.data?.sku,
            form: this.$inertia.form({
                product_id: this.product?.data?.id,
                discount_amount: 0,
                discount_type: 'fixed',
            }),
        }
    }
}
</script>

<style scoped>
.radio-uc input[type=radio]:checked~label {
    background-color: #171717;
    color: white;
}
</style>
