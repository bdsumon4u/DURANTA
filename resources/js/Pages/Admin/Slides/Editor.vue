<template>
    <admin-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ form.id ? 'Edit Slide' : 'Add Slide' }}
            </h2>
        </template>

        <div class="py-6">
            <div class="overflow-hidden">
                <form @submit.prevent="submit" class="max-w-3xl mx-auto p-5 bg-white shadow">
                    <div class="flex flex-wrap">
                        <div class="pt-7 pb-2 px-4 bg-white border shadow-md relative rounded-md w-full mt-5">
                            <ImagePicker name="image" :value="form.image" @pick="image => form.image = image" :disabled="this.form.id" />
                        </div>
                    </div>
                    <div class="flex flex-wrap">
                        <div class="pt-7 pb-2 px-4 bg-white border shadow-md relative rounded-md w-full mt-5">
                            <h2 class="flex bg-white border py-1 px-2 rounded-md absolute left-0 -top-3">
                                <label class="text-sm font-bold" for="link">Link</label>
                            </h2>
                            <input id="link" name="link" v-model="form.link" class="block w-full px-2 py-1 border rounded-md text-gray-700 bg-gray-100 appearance-none focus:outline-none focus:bg-gray-200 focus:shadow-inner" />
                        </div>
                    </div>
                    <jet-button type="submit" class="justify-center w-full mt-6 py-3">
                        Submit
                    </jet-button>
                </form>
            </div>
        </div>
    </admin-layout>
</template>

<script>
import AdminLayout from '@/Layouts/AdminLayout'
import ImagePicker from "@/Components/ImagePicker";
import JetButton from "@/Jetstream/Button";

export default {
    name: "Editor",
    props: {
        slide: {
            type: Object,
            default: {
                data: {
                    image: null,
                    link: 'https://',
                }
            }
        }
    },
    components: {
        AdminLayout,
        ImagePicker,
        JetButton,
    },
    methods: {
        submit() {
            if (this.form.id) {
                this.$inertia.post(route('admin.slides.update', this.form.id), {
                    _method: 'PATCH',
                    ...this.form,
                })
            } else {
                this.form.post(route('admin.slides.store'));
            }
        }
    },
    data() {
        return {
            form: this.$inertia.form(this.slide.data)
        }
    },
    created() {
        this.makeTitle('Admin Slide Editor')
    }
}
</script>
