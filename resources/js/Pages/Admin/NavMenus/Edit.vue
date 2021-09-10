<template>
    <layout :navMenus="navMenus" :active="navMenu.name">
        <div class="flex flex-wrap space-y-4 md:space-y-0 md:space-x-4">
            <div class="w-full md:w-64">
                <h4 class="text-center border">{{ form.editing ? 'Edit' : 'Add New' }} Item</h4>
                <form @submit.prevent="submit">
                    <div class="pt-7 pb-2 px-4 bg-white border shadow-md relative rounded-md w-full mt-5">
                        <h2 class="flex bg-white border py-1 px-2 rounded-md absolute left-0 -top-3">
                            <label class="text-sm font-bold" for="label">Label</label>
                        </h2>
                        <input type="text" id="label" v-model="form.label" class="block w-full px-2 py-1 border rounded-md text-gray-700 bg-gray-100 appearance-none focus:outline-none focus:bg-gray-200 focus:shadow-inner" />
                    </div>
                    <div class="pt-7 pb-2 px-4 bg-white border shadow-md relative rounded-md w-full mt-5">
                        <h2 class="flex bg-white border py-1 px-2 rounded-md absolute left-0 -top-3">
                            <label class="text-sm font-bold" for="link">Link</label>
                        </h2>
                        <input type="text" id="link" v-model="form.link" class="block w-full px-2 py-1 border rounded-md text-gray-700 bg-gray-100 appearance-none focus:outline-none focus:bg-gray-200 focus:shadow-inner" />
                    </div>

                    <jet-button class="w-full justify-center mt-6 py-3">
                        Submit
                    </jet-button>
                </form>
            </div>
            <div class="flex-1">
                <draggable
                    class="flex flex-col justify-around flex-wrap"
                    v-model="form.nav_items"
                    group="gallery"
                    v-bind="dragOptions"
                    @start="dragging = true"
                    @end="dragging = false"
                    item-key="id">
                    <template #item="{element, index}">
                        <div class="group items-center flex border rounded-sm pl-3 pr-1 m-1">
                            <div class="flex-1">
                                <p class="font-bold text-sm">{{ element.label }}</p>
                            </div>
                            <div class="flex items-center">
                                <a href="" class="p-2" @click.prevent="edit(element)">
                                    <svg class="w-5 h-5 text-blue-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path d="M16.757 3l-2 2H5v14h14V9.243l2-2V20a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V4a1 1 0 0 1 1-1h12.757zm3.728-.9L21.9 3.516l-9.192 9.192-1.412.003-.002-1.417L20.485 2.1z"/>
                                    </svg>
                                </a>
                                <a href="" class="p-2" @click.prevent="destroy(element)">
                                    <svg class="w-5 h-5 text-red-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </template>
                </draggable>
            </div>
        </div>
    </layout>
</template>

<script>
import AdminLayout from "@/Layouts/AdminLayout";
import Layout from "./Layout";
import JetButton from "@/Jetstream/Button";
import draggable from "vuedraggable";

export default {
    name: "Index",
    props: ['navMenus', 'navMenu'],
    components: {
        Layout,
        JetButton,
        AdminLayout,
        draggable,
    },
    computed: {
        dragOptions() {
            return {
                animation: 200,
                group: 'navMenu',
                disabled: false,
            };
        },
        prefix() {
            return this.admin ? 'admin.' : 'seller.';
        }
    },
    methods: {
        edit(element) {
            this.form.editing = true;
            this.form.id = element.id;
            this.form.label = element.label;
            this.form.link = element.link;
            this.form.weight = element.weight;
        },
        menuItems() {
            return this.navMenu.nav_items.map(item => ({
                id: item.id,
                label: item.label,
                link: item.link,
                weight: item.weight,
            }));
        },
        submit() {
            this.form.post(route('admin.menus', this.navMenu), {
                onFinish: () => {
                    this.form.nav_items = this.menuItems();
                }
            });
        },
        destroy(element) {
            this.$inertia.delete(route('admin.menus.destroy', element.id), {
                onFinish: () => {
                    this.form.nav_items = this.menuItems();
                }
            });
        }
    },
    data() {
        return {
            dragging: false,
            form: this.$inertia.form({
                id: 0,
                editing: false,
                label: null,
                link: null,
                nav_items: this.menuItems()
            })
        }
    }
}
</script>
