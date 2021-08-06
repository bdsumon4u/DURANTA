<template>
    <app-layout>
        <!-- account wrapper -->
        <div class="container lg:grid grid-cols-12 items-start gap-6 pt-4 pb-16">
            <!-- sidebar -->
            <sidebar />
            <!-- sidebar end -->

            <!-- account content -->
            <div class="col-span-9 bg-white shadow rounded px-6 pt-5 pb-7 mt-6 lg:mt-0">
                <form @submit.prevent="submit">
                    <h3 class="text-lg font-medium capitalize mb-4">
                        {{ ucfirst(address.type) }} Address
                    </h3>
                    <div class="mb-4">
                        <validation-errors />
                    </div>
                    <div class="space-y-4">
                        <!-- Form row -->
                        <div class="grid sm:grid-cols-2 gap-4">
                            <!-- Single input -->
                            <div>
                                <label class="text-gray-600 mb-2 block">
                                    Recipient Name
                                </label>
                                <input type="text" class="input-box" v-model="form.name">
                            </div>
                            <!-- single input end -->
                            <!-- single input -->
                            <div>
                                <label class="text-gray-600 mb-2 block">
                                    Phone Number
                                </label>
                                <input type="text" class="input-box" v-model="form.phone">
                            </div>
                            <!-- Single input end -->
                        </div>
                        <!-- Form row end -->
                        <div class="grid sm:grid-cols-3 gap-4">
                            <div>
                                <label class="text-gray-600 mb-2 block">
                                    Division
                                </label>
                                <input type="text" class="input-box" v-model="form.division" />
                            </div>
                            <div>
                                <label class="text-gray-600 mb-2 block">
                                    District
                                </label>
                                <input type="text" class="input-box" v-model="form.district" />
                            </div>
                            <div>
                                <label class="text-gray-600 mb-2 block">
                                    Town
                                </label>
                                <input type="text" class="input-box" v-model="form.town" />
                            </div>
                        </div>
                        <div>
                            <label class="text-gray-600 mb-2 block">
                                Address
                            </label>
                            <input type="text" class="input-box" v-model="form.address">
                        </div>
                    </div>
                    <div class="mt-6">
                        <button type="submit"
                                class="px-6 py-2 text-center text-white bg-primary border border-primary rounded hover:bg-transparent hover:text-primary transition uppercase font-roboto font-medium">
                            Save Change
                        </button>
                    </div>
                </form>
            </div>
            <!-- account content end -->
        </div>
        <!-- account wrapper end -->
    </app-layout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout";
import Sidebar from "../Sidebar";
import ValidationErrors from "@/Jetstream/ValidationErrors";

export default {
    name: "AddressManager",
    props: ['address'],
    components: {
        ValidationErrors,
        Sidebar,
        AppLayout,
    },
    data() {
        return {
            form: this.$inertia.form(this.address),
        }
    },
    methods: {
        submit() {
            this.form.post(route('address', this.address.type));
        }
    }
}
</script>
