<template>
    <admin-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Menu: {{ active }}</h2>
        </template>

        <div class="flex flex-wrap py-3 lg:px-5 lg:py-7">
            <div class="px-3 mb-5 md:mb-0 w-full lg:w-80">
                <ul class="px-0 border">
                    <template v-for="navMenu in navMenus">
                        <li class="border list-none rounded-sm" :class="[navMenu.name === active ? 'bg-gray-800 text-gray-200 border-blue-800' : 'text-gray-600']">
                            <inertia-link class="block px-3 py-2 italic text-sm font-semibold" :href="route('admin.menus', navMenu)">{{ navMenu.name }}</inertia-link>
                        </li>
                    </template>
                </ul>
            </div>
            <div class="px-3 flex-1 mt-2 lg:mt-0">
                <div class="bg-white p-4 border shadow-sm">
                    <jet-validation-errors class="mb-3" />
                    <slot></slot>
                </div>
            </div>
        </div>
    </admin-layout>
</template>
<script>
import AdminLayout from "@/Layouts/AdminLayout";
import JetValidationErrors from "@/Jetstream/ValidationErrors";

export default {
    props: ['navMenus', 'active'],

    components: {
        AdminLayout,
        JetValidationErrors,
    },
}
</script>
