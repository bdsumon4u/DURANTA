<template>
    <div class="max-w-7xl mx-auto md:grid md:grid-cols-3 md:gap-6">
        <div v-if="!is_admin" class="md:col-span-1">
            <div class="px-4 sm:px-0">
                <h3 class="text-lg font-medium leading-6 text-gray-900">Sellership</h3>
                <p v-if="application.id" class="mt-1 text-sm font-bold bg-primary p-2 text-gray-100">
                    Your sellership application is {{ application.status }}.
                </p>
                <p v-else class="mt-1 text-sm font-bold bg-primary p-2 text-gray-100">
                    You've no sellership. You can apply now.
                </p>
            </div>
        </div>
        <div class="mt-5 md:mt-0" :class="[is_admin ? 'md:col-span-3' : 'md:col-span-2']">
            <div class="shadow bg-white sm:rounded-md sm:overflow-hidden px-4 py-5 sm:p-6">
                <div class="mb-4">
                    <validation-errors />
                </div>
                <form @submit.prevent="submit" method="POST">
                    <div class="mb-4 grid md:grid-cols-3 gap-3">
                        <div class="col-span-1">
                            <label for="store-name" class="mb-2 block text-sm font-medium text-gray-700">
                                Store Name
                            </label>
                            <input type="text" v-model="form.store_name" id="store-name" class="focus:ring-indigo-500 focus:border-indigo-500 flex-1 block w-full rounded-md sm:text-sm border-gray-300">
                        </div>
                        <div class="col-span-1">
                            <label for="store-email" class="mb-2 block text-sm font-medium text-gray-700">
                                Store Email
                            </label>
                            <input type="text" v-model="form.store_email" id="store-email" class="focus:ring-indigo-500 focus:border-indigo-500 flex-1 block w-full rounded-md sm:text-sm border-gray-300">
                        </div>
                        <div class="col-span-1">
                            <label for="store-phone" class="mb-2 block text-sm font-medium text-gray-700">
                                Store Phone
                            </label>
                            <input type="text" v-model="form.store_phone" id="store-phone" class="focus:ring-indigo-500 focus:border-indigo-500 flex-1 block w-full rounded-md sm:text-sm border-gray-300">
                        </div>
                    </div>

                    <div class="mb-4">
                        <label for="store-address" class="mb-2 block text-sm font-medium text-gray-700">
                            Store Address
                        </label>
                        <input type="text" v-model="form.store_address" id="store-address" class="focus:ring-indigo-500 focus:border-indigo-500 flex-1 block w-full rounded-md sm:text-sm border-gray-300">
                    </div>

                    <div class="mb-4 grid md:grid-cols-2 md:gap-4">
                        <ImagePicker name="nid_front" :value="form.nid_front" @pick="nid_front => form.nid_front = nid_front">
                            <template #message>
                                <small class="text-sm">PNG, JPG, JPEG up to 1MB</small>
                            </template>
                        </ImagePicker>
                        <ImagePicker name="nid_back" :value="form.nid_back" @pick="nid_back => form.nid_back = nid_back">
                            <template #message>
                                <small class="text-sm">PNG, JPG, JPEG up to 1MB</small>
                            </template>
                        </ImagePicker>
                    </div>
                    <div class="mb-4">
                        <ImagePicker name="license" :value="form.license" @pick="license => form.license = license">
                            <template #message>
                                <small class="text-sm">PNG, JPG, JPEG up to 1MB</small>
                            </template>
                        </ImagePicker>
                    </div>

                    <div class="mb-4">
                        <ImagePicker name="signboard" :value="form.signboard" @pick="signboard => form.signboard = signboard">
                            <template #message>
                                <small class="text-sm">PNG, JPG, JPEG up to 1MB</small>
                            </template>
                        </ImagePicker>
                    </div>

                    <div class="grid md:grid-cols-2 md:gap-4">
                        <div v-if="is_admin" class="mb-3 md:mb-0">
                            <Multiselect id="status" v-model="form.status" mode="single" :options="['APPROVED', 'PENDING', 'REJECTED']" openDirection="top" placeholder="Select Status" />
                        </div>
                        <div class="text-right" :class="{'col-span-2': !is_admin}">
                            <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                Submit
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
import ImagePicker from "@/Components/ImagePicker";
import Multiselect from '@vueform/multiselect'
import ValidationErrors from "@/Jetstream/ValidationErrors";

export default {
    name: "SellershipManager",
    props: ['application'],
    components: {
        ImagePicker,
        Multiselect,
        ValidationErrors,
    },
    computed: {
        is_admin() {
            return this.$page.props.is_admin;
        },
    },
    methods: {
        submit() {
            if (this.is_admin) {
                this.$inertia.post(route('admin.sellerships.update', this.form), {
                    _method: 'PATCH', ...this.form,
                });
            } else {
                this.form.post(route('seller.sellership'));
            }
        }
    },
    data() {
        return {
            form: this.$inertia.form(this.application),
        };
    }
}
</script>

<style scoped>
@import "~@vueform/multiselect/themes/default.css";
</style>
