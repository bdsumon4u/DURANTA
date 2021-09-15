<template>
    <admin-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Widgets
            </h2>
        </template>

        <div class="py-6">
            <div class="flex flex-wrap lg:space-x-3">
                <div class="w-full lg:w-64 mb-3 lg:mb-0">
                    <div class="bg-white p-3">
                        <h3 class="text-3xl border-b-2 mb-4 pt-2 text-center font-roboto font-bold uppercase">Widgets</h3>
                        <draggable
                            item-key="weight"
                            class="drag-area list-group"
                            :list="widgets"
                            :group="{ name: 'widget', pull: 'clone', put: false }"
                            :clone="cloneWidget"
                        >
                            <template #item="{element, index}">
                                <div
                                    class="px-3 py-2 border my-1 cursor-move font-semibold"
                                    :key="element.name"
                                >
                                    {{ element.name }}
                                </div>
                            </template>
                        </draggable>
                    </div>
                </div>
                <div class="flex-1 w-full">
                    <div class="bg-white p-3">
                        <div class="flex mb-4 pt-2">
                            <h3 class="text-3xl border-b-2 font-roboto font-bold uppercase mr-3">Home Page</h3>
                            <button @click.prevent="submit" class="bg-primary text-white px-3 py-1 rounded-md font-bold ml-auto">Submit</button>
                        </div>
                        <draggable
                            itemKey="weight"
                            class="drag-area list-group"
                            :list="form.design"
                            group="widget"
                            handle=".handle"
                        >
                            <template #item="{element, index}">
                                <div
                                    class="px-3 py-2 border my-1 cursor-move"
                                    :key="element.name"
                                >
                                    <div class="flex items-center">
                                        <div class="handle">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24" width="24" height="24"><path d="M3 4h18v2H3V4zm0 7h18v2H3v-2zm0 7h18v2H3v-2z"></path></svg>
                                        </div>
                                        <div class="flex-1 flex flex-row justify-between items-center font-semibold px-3 cursor-pointer">
                                            <input class="border px-2 py-1" type="text" v-model="element.title">
                                            <div class="flex flex-1 justify-end" @click="show = (index + 1 === show ? 0 : index + 1)">
                                                <svg
                                                     class="fill-current text-purple-700 h-6 w-6 ml-2 transform transition-transform duration-500"
                                                     viewBox="0 0 20 20"
                                                >
                                                    <path d="M13.962,8.885l-3.736,3.739c-0.086,0.086-0.201,0.13-0.314,0.13S9.686,12.71,9.6,12.624l-3.562-3.56C5.863,8.892,5.863,8.611,6.036,8.438c0.175-0.173,0.454-0.173,0.626,0l3.25,3.247l3.426-3.424c0.173-0.172,0.451-0.172,0.624,0C14.137,8.434,14.137,8.712,13.962,8.885 M18.406,10c0,4.644-3.763,8.406-8.406,8.406S1.594,14.644,1.594,10S5.356,1.594,10,1.594S18.406,5.356,18.406,10 M17.521,10c0-4.148-3.373-7.521-7.521-7.521c-4.148,0-7.521,3.374-7.521,7.521c0,4.147,3.374,7.521,7.521,7.521C14.148,17.521,17.521,14.147,17.521,10"></path>
                                                </svg>
                                                <svg @click.prevent="removeAt(index)"
                                                     class="text-red-700 h-6 w-6 ml-2 transform transition-transform duration-500"
                                                     xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                                >
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                                </svg>
                                            </div>
                                        </div>
                                    </div>
                                    <template v-if="element.name === 'Products'">
                                        <Products v-if="show === index + 1" :element="element" :index="index" :selectable="selectable" @widget="updateWidget" />
                                    </template>
                                    <template v-else>
                                        <component v-if="show === index + 1" :is="element.name" :element="element" :index="index" @widget="updateWidget" />
                                    </template>
                                </div>
                            </template>
                        </draggable>
                    </div>
                </div>
            </div>
        </div>
    </admin-layout>
</template>

<script>
import AdminLayout from "@/Layouts/AdminLayout";
import draggable from "vuedraggable";
import Banner from "./Banner";
import Products from "./Products";

export default {
    name: "Index",
    props: ['selectable', 'design'],
    components: {
        AdminLayout,
        draggable,
        Banner,
        Products
    },
    data() {
        return {
            show: 0,
            widgets: [
                {
                    weight: 1,
                    name: 'Banner',
                    title: 'Banner',
                    image: null,
                    link: 'https://',
                },
                {
                    weight: 2,
                    name: 'Products',
                    title: 'Products',
                    brands: '',
                    categories: '',
                    ordering: 'latest',
                    number_of_products: 24,
                },
            ],
            form: this.$inertia.form({
                design: this.design.data,
            })
        };
    },
    methods: {
        cloneWidget(element) {
            let max = 0;
            for (const item of this.form.design) {
                if (item.weight > max) {
                    max = item.weight;
                }
            }

            return {
                ...element,
                weight: ++max,
            };
        },
        updateWidget({index, data}) {
            this.form.design[index] = {
                ...this.form.design[index],
                ...data,
            }
        },
        removeAt(idx) {
            this.form.design.splice(idx, 1);
        },
        submit() {
            this.form.post(route('admin.widgets'));
        }
    },
}
</script>
