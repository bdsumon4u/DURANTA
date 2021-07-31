<template>
    <seller-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ form.id ? 'Edit Product' : 'Add Product' }}
            </h2>
        </template>

        <div class="my-5">
            <form @submit.prevent="submit">
                <div class="md:flex justify-center flex-wrap lg:space-x-5">
                    <div class="flex-1 overflow-hidden">
                        <div class="bg-white p-5 mb-5 flex flex-wrap">
                            <!--Start GalleryPicker-->
                            <div class="m-1 w-full">
                                <label for="media" class="w-full h-32 border-2 rounded-md border-dashed flex justify-center items-center border-blue-400 text-blue-400 cursor-pointer">
                                    <svg class="fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="48" height="48">
                                        <path fill="none" d="M0 0h24v24H0z"/>
                                        <path d="M11 11V5h2v6h6v2h-6v6h-2v-6H5v-2z"/>
                                    </svg>
                                    <input type="file" ref="fileInput" id="media" name="media" class="sr-only" @change="pickFile" multiple />
                                    <strong class="text-sm">Select Image</strong>
                                </label>
                            </div>
                            <draggable
                                class="flex justify-around flex-wrap"
                                v-model="form.media"
                                group="gallery"
                                v-bind="dragOptions"
                                @start="dragging = true"
                                @end="dragging = false"
                                item-key="id">
                                <template #item="{element, index}">
                                    <div class="group w-32 h-32 relative bg--black border-2 rounded-md text-center m-1">
                                        <img class="group-hover:opacity-100 h-full w-full object-fill" :src="element.link" alt="Product Image">
                                        <div class="flex group-hover:cursor-[grab] absolute inset-0 justify-center items-center">
                                            <a href="" @click.prevent="remove(index)" class="absolute top-0 right-0 p-1 text-red-500 bg-white rounded-md rounded-t-none rounded-r-none">
                                                <svg class="w-4 h-4 text-red-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                </svg>
                                            </a>
                                        </div>
                                    </div>
                                </template>
                            </draggable>
                            <DemoGallery :when="!form.media.length" />
                            <!--End GalleryPicker-->
                        </div>
                        <div class="bg-white p-5 mb-5">
                            <template v-if="form.id">
                                <!--PATCH Request-->
                                <jet-validation-errors />
                                <!--No Inertia Form-->
                            </template>
                            <div class="px-3 pt-4 pb-5 bg-white rounded">
                                <div class="mb-4 md:flex md:justify-between">
                                    <div class="mb-4 w-2/3 md:mr-2 md:mb-0">
                                        <label class="block mb-2 text-sm font-bold text-gray-700" for="name">Name</label>
                                        <input v-model="form.name" class="w-full px-3 py-2 text-sm leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline" id="name" type="text" placeholder="Product Name">
                                        <jet-input-error :message="form.errors.name" class="mt-2" />
                                    </div>
                                    <div class="md:ml-2 w-1/3">
                                        <label class="block mb-2 text-sm font-bold text-gray-700" for="sku">SKU</label>
                                        <input v-model="form.sku" class="w-full px-3 py-2 text-sm leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline" id="sku" type="text" placeholder="Product SKU">
                                        <jet-input-error :message="form.errors.sku" class="mt-2" />
                                    </div>
                                </div>
                                <div>
                                    <label class="block mb-2 text-sm font-bold text-gray-700" for="description">Description</label>
                                    <ckeditor :editor="editor" v-model="form.description" :config="editorConfig" @ready="initEditor"></ckeditor>
                                    <jet-input-error :message="form.errors.description" class="mt-2" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="w-96 space-y-4">
                        <div class="sm:max-w-lg w-full px-6 py-8 bg-white rounded-md z-10">
                            <div class="w-full mb-4">
                                <label class="block mb-2 text-sm font-bold text-gray-700" for="brand">Brand</label>
                                <Multiselect id="brand" v-model="form.brand" mode="single" :options="brands" valueProp="id" label="name" trackBy="name" placeholder="Select Brand" />
                                <jet-input-error :message="form.errors.brand" class="mt-2" />
                            </div>
                            <div class="w-full">
                                <label class="block mb-2 text-sm font-bold text-gray-700" for="categories">Categories</label>
                                <Multiselect id="categories" v-model="form.categories" mode="multiple" :options="categories" searchable valueProp="id" label="name" trackBy="name" placeholder="Select Categories" />
                                <jet-input-error :message="form.errors.categories" class="mt-2" />
                            </div>
                        </div>
                        <div class="sm:max-w-lg w-full px-6 py-8 bg-white rounded-md z-10">
                            <div class="flex flex-col spacy-y-2">
                                <div class="w-full mb-4">
                                    <label class="block mb-2 text-sm font-bold text-gray-700" for="price">Price</label>
                                    <input v-model="form.price" class="w-full px-3 py-2 text-sm leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline" id="price" type="text" placeholder="Product Price">
                                    <jet-input-error :message="form.errors.price" class="mt-2" />
                                </div>
                                <div class="w-full">
                                    <label class="block mb-2 text-sm font-bold text-gray-700" for="discount">Discount</label>
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
                            </div>
                        </div>
                        <div class="sm:max-w-lg w-full px-6 py-8 bg-white rounded-md z-10">
                            <div class="flex flex-col spacy-y-2">
                                <div class="w-full mb-4">
                                    <label class="block mb-2 text-sm font-bold text-gray-700" for="pickup-point">Pickup Point</label>
                                    <input v-model="form.pickup_point" class="w-full px-3 py-2 text-sm leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline" id="pickup-point" type="text" placeholder="Enter Address">
                                    <jet-input-error :message="form.errors.pickup_point" class="mt-2" />
                                </div>
                                <div class="w-full">
                                    <label for="stock-track" class="inline-flex items-center">
                                        <input @change="form.stock_track = !form.stock_track" id="stock-track" name="stock-track" type="checkbox" class="form-checkbox" :checked="form.stock_track">
                                        <span class="ml-2">Track Stock</span>
                                    </label>
                                </div>
                                <div v-if="form.stock_track" class="w-full mt-4">
                                    <label class="block mb-2 text-sm font-bold text-gray-700" for="stock-count">Stock Count</label>
                                    <input v-model="form.stock_count" class="w-full px-3 py-2 text-sm leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline" id="stock-count" type="text" placeholder="Stock Count">
                                    <jet-input-error :message="form.errors.stock_count" class="mt-2" />
                                </div>
                            </div>
                        </div>
                        <div class="sm:max-w-lg w-full px-6 py-8 bg-white rounded-md z-10">
                            <jet-button class="w-full justify-center" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                                {{ form.id ? 'Update' : 'Submit' }}
                            </jet-button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </seller-layout>
</template>

<script>
import defaultProduct from './Partial/default-product';
import CKEditor from '@ckeditor/ckeditor5-vue';
import ClassicEditor from '@ckeditor/ckeditor5-build-classic';
import DemoGallery from './Partial/DemoGallery';
import draggable from 'vuedraggable';
import JetButton from "@/Jetstream/Button";
import JetInputError from "@/Jetstream/InputError";
import JetValidationErrors from "@/Jetstream/ValidationErrors";
import Multiselect from '@vueform/multiselect'
import SellerLayout from '@/Layouts/SellerLayout';

export default {
    name: "Create",
    props: {
        product: {
            type: Object,
            default: defaultProduct,
        },
        brands: {
            type: Array,
        },
        categories: {
            type: Array,
        },
    },
    components: {
        ckeditor: CKEditor.component,
        DemoGallery,
        draggable,
        JetButton,
        JetInputError,
        JetValidationErrors,
        Multiselect,
        SellerLayout,
    },
    computed: {
        dragOptions() {
            return {
                animation: 200,
                group: 'gallery',
                disabled: false,
            };
        },
    },
    methods: {
        remove (index) {
            this.form.media = this.form.media.filter((item, i) =>  index !== i);
        },
        async pickFile () {
            const files = this.$refs.fileInput.files;
            if (files.length) {
                let promises = [];
                for (let file of files) {
                    promises.push(
                        new Promise((resolve, reject) => {
                            const reader = new FileReader();
                            reader.onload = async ev => {
                                try {
                                    resolve(await this.form.media.push({
                                        link: ev.target.result,
                                        file: file,
                                    }));
                                } catch (error) {
                                    reject(error);
                                }
                            };
                            reader.onerror = (error) => {
                                reject(error);
                            };
                            reader.readAsDataURL(file);
                        })
                    )
                }

                await Promise.all(promises);
            }
        },
        initEditor (editor) {
            editor.ui.view.editable.element.style.minHeight = '325px';
        },
        fileExtractor (media) {
            return media.map(item => {
                return item.id ? {id: item.id} : {
                    file: item.file,
                };
            });
        },
        submit () {
            if (this.form.id) {
                this.$inertia.post(route('seller.products.update', this.form.id), {
                    _method: 'PATCH', ...this.form,
                    media: this.fileExtractor(this.form.media),
                })
            } else {
                this.form.transform((data) => ({...data,
                    media: this.fileExtractor(data.media),
                })).post(route('seller.products.store'));
            }
        }
    },
    data() {
        return {
            form: this.$inertia.form(this.product.data),
            editor: ClassicEditor,
            editorConfig: {
                // The configuration of the editor.
            },
        };
    },
}
</script>

<style scoped>
@import "~@vueform/multiselect/themes/default.css";

.radio-uc input[type=radio]:checked~label {
    background-color: #171717;
    color: white;
}
</style>
