<template>
    <layout :tabs="tabs" active="store">
        <div class="mt-10 sm:mt-0">
            <form @submit.prevent="submit" method="POST">
                <div class="flex flex-wrap md:-mx-2">
                    <div class="md:px-2 w-full md:w-1/2">
                        <ImagePicker name="store_logo" :value="form.store_logo" @pick="store_logo => form.store_logo = store_logo" />
                        <jet-input-error :message="form.errors.store_logo" class="mt-2" />
                    </div>
                    <div class="md:px-2 w-full md:w-1/2 self-end">
                        <jet-button class="mt-6 py-3">
                            Submit
                        </jet-button>
                    </div>
                </div>
            </form>
        </div>
    </layout>
</template>

<script>
import Layout from "./Layout";
import JetButton from '@/Jetstream/Button';
import ImagePicker from "@/Components/ImagePicker";
import JetInputError from '@/Jetstream/InputError';

export default {
    name: "Withdraw",

    props: ['tabs', 'settings'],

    components: {
        ImagePicker,
        JetButton,
        JetInputError,
        Layout
    },

    methods: {
        submit() {
            this.form.post(route('seller.settings', 'store'));
        }
    },

    data() {
        return {
            form: this.$inertia.form({
                store_logo: this.settings.store_logo,
            })
        }
    }
}
</script>
