<template>
    <layout :tabs="tabs" active="general">
        <form @submit.prevent="submit" method="post">
            <div class="flex flex-wrap md:-mx-2">
                <div class="md:px-2 w-full md:w-1/2">
                    <ImagePicker name="logo" :value="form.logo" @pick="logo => form.logo = logo" />
                    <jet-input-error :message="form.errors.logo" class="mt-2" />
                </div>
                <div class="md:px-2 w-full md:w-1/2">
                    <ImagePicker name="favicon" :value="form.favicon" @pick="favicon => form.favicon = favicon" />
                    <jet-input-error :message="form.errors.favicon" class="mt-2" />
                </div>
            </div>

            <div class="flex flex-wrap md:-mx-2">
                <div class="md:px-2 w-full md:w-1/2">
                    <div class="pt-7 pb-2 px-4 bg-white border shadow-md relative rounded-md w-full mt-5">
                        <h2 class="flex bg-white border py-1 px-2 rounded-md absolute left-0 -top-3">
                            <label class="text-sm font-bold" for="site-name">Site Name</label>
                        </h2>
                        <input type="text" id="site-name" v-model="form.site_name" class="block w-full px-2 py-1 border rounded-md text-gray-700 bg-gray-100 appearance-none focus:outline-none focus:bg-gray-200 focus:shadow-inner" />
                        <jet-input-error :message="form.errors.site_name" class="mt-2" />
                    </div>
                </div>
                <div class="md:px-2 w-full md:w-1/2">
                    <div class="pt-7 pb-2 px-4 bg-white border shadow-md relative rounded-md w-full mt-5">
                        <h2 class="flex bg-white border py-1 px-2 rounded-md absolute left-0 -top-3">
                            <label class="text-sm font-bold" for="tagline">Tagline</label>
                        </h2>
                        <input type="text" id="tagline" v-model="form.tagline" class="block w-full px-2 py-1 border rounded-md text-gray-700 bg-gray-100 appearance-none focus:outline-none focus:bg-gray-200 focus:shadow-inner" />
                        <jet-input-error :message="form.errors.tagline" class="mt-2" />
                    </div>
                </div>
            </div>

            <div class="flex flex-wrap md:-mx-2">
                <div class="md:px-2 w-full md:w-1/2">
                    <div class="pt-7 pb-2 px-4 bg-white border shadow-md relative rounded-md w-full mt-5">
                        <h2 class="flex bg-white border py-1 px-2 rounded-md absolute left-0 -top-3">
                            <label class="text-sm font-bold" for="contact-email">Contact Email</label>
                        </h2>
                        <input type="text" id="contact-email" v-model="form.contact_email" class="block w-full px-2 py-1 border rounded-md text-gray-700 bg-gray-100 appearance-none focus:outline-none focus:bg-gray-200 focus:shadow-inner" />
                        <jet-input-error :message="form.errors.contact_email" class="mt-2" />
                    </div>
                </div>
                <div class="md:px-2 w-full md:w-1/2">
                    <div class="pt-7 pb-2 px-4 bg-white border shadow-md relative rounded-md w-full mt-5">
                        <h2 class="flex bg-white border py-1 px-2 rounded-md absolute left-0 -top-3">
                            <label class="text-sm font-bold" for="contact-phone">Contact Phone</label>
                        </h2>
                        <input type="text" id="contact-phone" v-model="form.contact_phone" class="block w-full px-2 py-1 border rounded-md text-gray-700 bg-gray-100 appearance-none focus:outline-none focus:bg-gray-200 focus:shadow-inner" />
                    </div>
                </div>
            </div>

            <div class="flex flex-wrap md:-mx-2">
                <div class="md:px-2 w-full md:w-1/2">
                    <div class="pt-7 pb-2 px-4 bg-white border shadow-md relative rounded-md w-full mt-5">
                        <h2 class="flex bg-white border py-1 px-2 rounded-md absolute left-0 -top-3">
                            <label class="text-sm font-bold" for="company-address">Company Address</label>
                        </h2>
                        <input type="text" id="company-address" v-model="form.company_address" class="block w-full px-2 py-1 border rounded-md text-gray-700 bg-gray-100 appearance-none focus:outline-none focus:bg-gray-200 focus:shadow-inner" />
                        <jet-input-error :message="form.errors.company_address" class="mt-2" />
                    </div>
                </div>
            </div>

            <jet-button class="mt-6 py-3">
                Submit
            </jet-button>
        </form>
    </layout>
</template>

<script>
import ImagePicker from "@/Components/ImagePicker";
import JetButton from '@/Jetstream/Button'
import JetInputError from '@/Jetstream/InputError'
import Layout from "./Layout";

export default {
    name: "General",

    props: ['settings', 'tabs'],

    components: {
        ImagePicker,
        JetButton,
        JetInputError,
        Layout
    },

    data() {
        return {
            form: this.$inertia.form({
                logo: this.settings.logo,
                favicon: this.settings.favicon,
                site_name: this.settings.site_name,
                tagline: this.settings.tagline,
                contact_email: this.settings.contact_email,
                contact_phone: this.settings.contact_phone,
                company_address: this.settings.company_address,
            }),
        }
    },

    methods: {
        submit() {
            this.form.post(route('admin.settings', 'general'), {
                preserveScroll: true,
            });
        }
    },
}
</script>
