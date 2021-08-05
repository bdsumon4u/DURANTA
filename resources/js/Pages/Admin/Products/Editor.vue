<template>
    <seller-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ form.id ? 'Edit Product' : 'Add Product' }}
            </h2>
        </template>

        <product-editor :admin="true" :brands="brands" :categories="categories" :product="product" />
    </seller-layout>
</template>

<script>
import CKEditor from '@ckeditor/ckeditor5-vue';
import ClassicEditor from '@ckeditor/ckeditor5-build-classic';
import draggable from 'vuedraggable';
import JetButton from "@/Jetstream/Button";
import JetInputError from "@/Jetstream/InputError";
import JetValidationErrors from "@/Jetstream/ValidationErrors";
import Multiselect from '@vueform/multiselect';
import ProductEditor from '@/Components/ProductEditor/Editor';
import SellerLayout from '@/Layouts/SellerLayout';

export default {
    name: "Editor",
    props: ['product', 'brands', 'categories'],
    components: {
        ckeditor: CKEditor.component,
        draggable,
        JetButton,
        JetInputError,
        JetValidationErrors,
        Multiselect,
        ProductEditor,
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
