<template>
    <app-layout>
        <!-- breadcrumb -->
        <breadcrumb :items="[{title: 'Checkout'}]" />
        <!-- breadcrumb end -->

        <!-- checkout wrapper -->
        <div class="container lg:grid grid-cols-12 gap-6 items-start pb-16 pt-4">
            <!-- checkout form -->
            <div class="lg:col-span-8 bg-white border shadow border-gray-200 px-4 py-4 rounded">
                <form @submit.prevent="submit">
                    <h3 class="text-lg font-medium capitalize mb-4">
                        Checkout
                    </h3>

                    <div class="space-y-4">
                        <validation-errors />
                        <div class="grid sm:grid-cols-3 gap-4">
                            <div class="col-span-2">
                                <label for="address" class="text-gray-600 mb-2 block">
                                    Address
                                </label>
                                <select id="address" v-model="form.address" class="input-box">
                                    <option v-for="address in addresses" :value="address.id">{{ ucfirst(address.type) }} Address</option>
                                </select>
                            </div>
                            <div>
                                <label class="text-gray-600 mb-2 block">.</label>
                                <inertia-link :href="route('dashboard')" class="bg-primary border border-primary text-white px-4 py-3 font-medium rounded-md uppercase hover:bg-transparent hover:text-primary transition text-sm w-full block text-center">
                                    Edit Address
                                </inertia-link>
                            </div>
                        </div>
                        <div>
                            <label class="text-gray-600 mb-2 block">
                                Contact Name
                            </label>
                            <input type="text" class="input-box" v-model="form.contact_name">
                        </div>
                        <div>
                            <label class="text-gray-600 mb-2 block">
                                Contact Phone
                            </label>
                            <input type="text" class="input-box" v-model="form.contact_phone">
                        </div>
                        <!-- agreeement  -->
                        <div class="flex items-center mb-4 mt-2" v-if="$page.props.jetstream.hasTermsAndPrivacyPolicyFeature">
                            <input type="checkbox" id="term" v-model="form.term" class="text-primary focus:ring-0 rounded-sm cursor-pointer w-3 h-3">
                            <label for="term" class="text-gray-600 ml-3 cursor-pointer">
                                Agree to our
                                <inertia-link :href="route('terms.show')" class="text-primary">terms & conditions</inertia-link>
                            </label>
                        </div>

                        <!-- checkout -->
                        <button type="submit" class="bg-primary border border-primary text-white px-4 py-3 font-medium rounded-md uppercase hover:bg-transparent hover:text-primary transition text-sm font-bold w-full block text-center">
                            Place order
                        </button>
                    </div>
                </form>
            </div>
            <!-- checkout form end -->

            <!-- order summary -->
            <div class="lg:col-span-4 bg-white border shadow border-gray-200 px-4 py-4 rounded mt-6 lg:mt-0">
                <h4 class="text-gray-800 text-lg mb-4 font-medium uppercase">ORDER SUMMARY</h4>
                <div class="space-y-2">
                    <div class="flex gap-2 justify-between" v-for="product in cart.content" :key="product.id">
                        <div>
                            <h5 class="text-gray-800 font-medium">{{ product.name }}
                                <span class="text-gray-600">x{{ product.qty }}</span></h5>
                            <p class="text-sm text-gray-600">Price: {{ product.price }}</p>
                        </div>
                        <p class="text-gray-800 font-medium">{{ product.qty * product.price }}</p>
                    </div>
                </div>
                <div class="flex justify-between border-b border-gray-200 mt-1">
                    <h4 class="text-gray-800 font-medium my-3 uppercase">Subtotal</h4>
                    <h4 class="text-gray-800 font-medium my-3 uppercase">{{ cart.subtotal }}</h4>
                </div>
                <div class="flex justify-between border-b border-gray-200 mt-1">
                    <h4 class="text-gray-800 font-medium my-3 uppercase">Discount</h4>
                    <h4 class="text-gray-800 font-medium my-3 uppercase">{{ cart.discount }}</h4>
                </div>
                <div class="flex flex-wrap justify-between border-b border-gray-200">
                    <h4 class="flex-1 text-gray-800 font-medium my-1 uppercase">Shipping</h4>
                    <h4 class="flex-1 text-gray-800 font-medium my-1 uppercase text-right">Later</h4>
                    <small class="w-full">Charge varies from area to area and product to product.</small>
                    <small class="w-full">We'll estimate charge & call you after placing order.</small>
                </div>
                <div class="flex justify-between">
                    <h4 class="text-gray-800 font-semibold my-3 uppercase">Total</h4>
                    <h4 class="text-gray-800 font-semibold my-3 uppercase">{{ cart.total }}</h4>
                </div>
                <!-- checkout end -->
            </div>
            <!-- order summary end -->
        </div>
        <!-- checkout wrapper end -->
    </app-layout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout";
import Breadcrumb from "@/Components/Site/Breadcrumb";
import ValidationErrors from "@/Jetstream/ValidationErrors";

export default {
    name: "Checkout",
    props: ['addresses'],
    components: {
        AppLayout,
        Breadcrumb,
        ValidationErrors,
    },
    methods: {
        loadCartContent() {
            axios.get(route('api.cart.content'))
                .then(({data}) => {
                    this.cart = data.cart;
                })
                .catch(err => console.error(err));
        },
        submit() {
            this.form.post(route('orders.store'));
        }
    },
    data() {
        return {
            cart: {
                content: {},
                total: 0,
                subtotal: 0,
                discount: 0,
            },
            form: this.$inertia.form({
                address: (this.addresses ?? [])[0]?.id ?? null,
                contact_name: this.$page.props.user.name,
                contact_phone: this.$page.props.user.phone,
                term: false,
            })
        }
    },
    created() {
        this.makeTitle(this.$page.props.settings.general.site_name + ' | Checkout')
    },
    mounted() {
        this.loadCartContent();
    }
}
</script>

<style scoped>
@import "~@vueform/multiselect/themes/default.css";
</style>
