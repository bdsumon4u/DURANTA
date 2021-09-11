<template>
    <admin-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ form.id ? 'Edit' : 'Create' }} Page
            </h2>
        </template>

        <div class="my-5">
            <form class="max-w-5xl mx-auto" @submit.prevent="submit">
                <div class="md:flex justify-center flex-wrap lg:space-x-5">
                    <div class="flex-1 overflow-hidden">
                        <div class="bg-white p-5 mb-5">
                            <template v-if="form.id">
                                <!--PATCH Request-->
                                <jet-validation-errors />
                                <!--No Inertia Form-->
                            </template>
                            <div class="px-3 pt-4 pb-5 bg-white rounded">
                                <div class="mb-4 md:flex md:justify-between">
                                    <div class="mb-4 w-2/3 md:mr-2 md:mb-0">
                                        <label class="block mb-2 text-sm font-bold text-gray-700" for="title">Title</label>
                                        <input v-model="form.title" class="w-full px-3 py-2 text-sm leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline" id="title" type="text" placeholder="Page Title">
                                        <jet-input-error :message="form.errors.title" class="mt-2" />
                                    </div>
                                    <div class="md:ml-2 w-1/3">
                                        <label class="block mb-2 text-sm font-bold text-gray-700" for="slug">Slug</label>
                                        <input v-model="form.slug" class="w-full px-3 py-2 text-sm leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline" id="slug" type="text" placeholder="Page Slug">
                                        <jet-input-error :message="form.errors.slug" class="mt-2" />
                                    </div>
                                </div>
                                <div>
                                    <label class="block mb-2 text-sm font-bold text-gray-700" for="content">
                                        Content
                                        <div class="inline-flex border bg-white rounded rounded-l-none">
                                            <div class="w-10 radio-uc inline-flex rounded-lg">
                                                <input
                                                    v-model="content_lang"
                                                    type="radio"
                                                    value="en"
                                                    id="lang-en"
                                                    name="lang"
                                                    checked="checked"
                                                    class="hidden"
                                                />
                                                <label
                                                    for="lang-en"
                                                    class="w-full text-center self-center text-black text-xs py-1 px-2 mx-1 rounded-lg cursor-pointer hover:opacity-75">
                                                    EN
                                                </label>
                                            </div>
                                            <div class="w-10 radio-uc inline-flex rounded-lg">
                                                <input
                                                    v-model="content_lang"
                                                    type="radio"
                                                    value="bn"
                                                    name="lang"
                                                    id="lang-bn"
                                                    class="hidden"
                                                />
                                                <label
                                                    for="lang-bn"
                                                    class="w-full text-center self-center text-black text-xs py-1 px-2 mx-1 rounded-lg cursor-pointer hover:opacity-75">
                                                    BN
                                                </label>
                                            </div>
                                        </div>
                                    </label>
                                    <div v-show="content_lang === 'en'">
                                        <ckeditor :editor="editor" v-model="form.content_en" :config="editorConfig" @ready="initEditor"></ckeditor>
                                    </div>
                                    <div v-show="content_lang === 'bn'">
                                        <ckeditor :editor="editor" v-model="form.content_bn" :config="editorConfig" @ready="initEditor"></ckeditor>
                                    </div>
                                </div>
                            </div>
                            <jet-button class="w-full py-3 justify-center" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                                {{ form.id ? 'Update' : 'Submit' }}
                            </jet-button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </admin-layout>
</template>

<script>
import AdminLayout from '@/Layouts/AdminLayout';
import CKEditor from '@ckeditor/ckeditor5-vue';
import ClassicEditor from '@ckeditor/ckeditor5-build-classic';
import JetButton from "@/Jetstream/Button";
import JetInputError from "@/Jetstream/InputError";
import JetValidationErrors from "@/Jetstream/ValidationErrors";

export default {
    name: "PageEditor",
    props: ['page'],
    components: {
        AdminLayout,
        ckeditor: CKEditor.component,
        JetButton,
        JetInputError,
        JetValidationErrors,
    },
    methods: {
        initEditor (editor) {
            editor.ui.view.editable.element.style.minHeight = '325px';
        },
        submit () {
            if (this.form.id) {
                this.form.patch(route('admin.pages.update', this.form.id))
            } else {
                this.form.post(route('admin.pages.store'));
            }
        },
        slugify(str) {
            str = str.replace(/^\s+|\s+$/g, ''); // trim
            str = str.toLowerCase();

            // remove accents, swap ñ for n, etc
            var from = "àáäâèéëêìíïîòóöôùúüûñç·/_,:;";
            var to   = "aaaaeeeeiiiioooouuuunc------";
            for (var i=0, l=from.length ; i<l ; i++) {
                str = str.replace(new RegExp(from.charAt(i), 'g'), to.charAt(i));
            }

            str = str.replace(/[^a-z0-9 -]/g, '') // remove invalid chars
                .replace(/\s+/g, '-') // collapse whitespace and replace by -
                .replace(/-+/g, '-'); // collapse dashes

            return str;
        }
    },
    data() {
        return {
            content_lang: 'en',
            form: this.$inertia.form(this.page),
            editor: ClassicEditor,
            editorConfig: {
                // The configuration of the editor.
            },
        };
    },
    watch: {
        'form.title': function (val) {
            this.form.slug = this.slugify(val);
        },
    }
}
</script>

<style scoped>
.radio-uc input[type=radio]:checked~label {
    background-color: #171717;
    color: white;
}
</style>
