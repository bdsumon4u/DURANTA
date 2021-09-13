<template>
    <admin-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Categories
            </h2>
        </template>

        <div>
            <div class="flex justify-center flex-wrap lg:space-x-5">
                <div class="w-96">
                    <div class="sm:max-w-lg w-full p-10 bg-white rounded-xl z-10">
                        <div class="text-center">
                            <h2 class="text-2xl font-bold text-gray-900">{{ category ? 'Edit Category' : 'Add New Category' }}</h2>
                            <p v-if="category" class="mt-2 text-sm text-gray-400">You're editing "{{ category.name }}"</p>
                        </div>
                        <form class="mt-5 space-y-3" @submit.prevent="submit" method="POST">
                            <validation-errors />
                            <div class="grid grid-cols-1 space-y-2">
                                <label class="text-sm font-bold text-gray-500 tracking-wide">Name</label>
                                <input type="text" v-model="form.name" class="text-base p-2 border border-gray-300 rounded-lg focus:outline-none focus:border-indigo-500">
                            </div>
                            <div class="grid grid-cols-1 space-y-2">
                                <label class="text-sm font-bold text-gray-500 tracking-wide">Attach Image</label>
                                <div class="flex items-center justify-center w-full">
                                    <label class="flex flex-col rounded-lg border-4 border-dashed w-full h-60 p-10 group text-center">
                                        <div class="h-full w-full text-center flex flex-col items-center justify-center items-center  ">
                                            <div v-if="src" class="flex flex-auto mx-auto">
                                                <img class="has-mask h-28 w-28 object-center" :src="src" alt="Category Image">
                                            </div>
                                            <svg v-else xmlns="http://www.w3.org/2000/svg" class="w-10 h-10 text-blue-400 group-hover:text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                                            </svg>
                                            <p class="pointer-none text-gray-500 "><strong class="text-sm">Select</strong> or <a href="" @click.prevent="$refs.fileInput.click()" id="" class="text-blue-600 hover:underline"><strong class="text-sm">browse</strong></a> image.</p>
                                        </div>
                                        <input type="file" ref="fileInput" class="hidden" @change="pickFile">
                                    </label>
                                </div>
                            </div>
                            <p class="text-sm text-gray-300">
                                <span>File type: all types of images</span>
                            </p>
                            <div>
                                <button type="submit" class="my-5 w-full flex justify-center bg-blue-500 text-gray-100 p-4 rounded-md tracking-wide
                                    font-semibold focus:outline-none focus:shadow-outline hover:bg-blue-600 shadow-md cursor-pointer transition ease-in duration-300">
                                    {{ category ? 'Update' : 'Submit' }}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="flex-1 w-full">
                    <category-table :categories="categories" />
                </div>
            </div>
        </div>
    </admin-layout>
</template>

<script>
import AdminLayout from '@/Layouts/AdminLayout'
import CategoryTable from './CategoryTable'
import ValidationErrors from "@/Jetstream/ValidationErrors";

export default {
    name: "Categories",
    props: ['category', 'categories'],
    components: {
        ValidationErrors,
        AdminLayout,
        CategoryTable,
    },
    methods: {
        pickFile () {
            const photo = this.$refs.fileInput.files[0];

            if (photo) {
                const reader = new FileReader();

                reader.onload = (e) => {
                    this.src = e.target.result;
                };

                reader.readAsDataURL(photo);
            }

            this.form.image = photo;
        },
        submit() {
            if (this.category) {
                this.$inertia.post(route('admin.categories.update', this.category), {
                    _method: 'PATCH',
                    ...this.form,
                }, {
                    onSuccess: () => this.form.reset(),
                });
            } else {
                this.form.post(route('admin.categories.store'), {
                    onSuccess: () => this.form.reset(),
                });
            }
        }
    },
    data() {
        return {
            form: this.$inertia.form({
                name: this.category ? this.category.name : '',
                image: this.category ? this.category.image : '',
            }),
            src: this.category ? this.category.image : '',
        };
    },
}
</script>
