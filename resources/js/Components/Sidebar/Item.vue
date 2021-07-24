<template>
    <template v-if="item.items">
        <a
            href=""
            @click.prevent="isOpen = !isOpen"
            class="flex items-center p-2 transition-colors hover:bg-gray-900 border-l-4"
            :class="classOpen"
            role="button"
            aria-haspopup="true"
            :aria-expanded="isOpen"
        >
            <span v-show="item.icon" aria-hidden="true">
                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24" width="24" height="24" v-html="item.icon"></svg>
            </span>
            <span class="ml-2 text-sm">{{ item.name }}</span>
            <span aria-hidden="true" class="ml-auto">
                <!-- active class 'rotate-180' -->
                <svg
                    class="w-4 h-4 transition-transform transform"
                    :class="{ 'rotate-180': isOpen }"
                    xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                >
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                </svg>
            </span>
        </a>
        <div v-show="isOpen" class="mt-2 space-y-2 pl-7" role="menu" :aria-label="item.name">
            <template v-for="(item, key) in item.items" :key="key">
                <sidebar-item :item="item" />
            </template>
        </div>
    </template>
    <inertia-link
        v-else-if="(item.when === undefined) || item.when"
        :href="item.href"
        class="flex items-center p-2 transition-colors hover:bg-gray-900 border-l-4"
        :class="classActive"
        role="button"
        aria-haspopup="true"
    >
        <span v-show="item.icon" aria-hidden="true">
            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24" width="24" height="24" v-html="item.icon"></svg>
        </span>
        <span class="ml-2 text-sm">{{ item.name }}</span>
    </inertia-link>
</template>

<script>
export default {
    name: "SidebarItem",

    props: {
        item: Object,
    },

    computed: {
        classActive() {
            return this.isActive
                ? 'active bg-gray-700 font-bold border-gray-100'
                : 'border-transparent'
        },
        classOpen() {
            return this.isOpen
                ? 'bg-gray-700 border-transparent'
                : 'border-transparent'
        }
    },

    data() {
        return {
            isActive: false,
            isOpen: this.item.open,
        }
    },

    methods: {
        doActive(item) {
            if (item.active) {
                return true;
            }

            let href = this.item.href;
            if (href && !href.startsWith(location.origin)) {
                href = location.origin + (href.startsWith('/') ? '' : '/') + href;
            }
            return location.href === href;
        },
    },

    mounted() {
        this.isActive = this.doActive(this.item);
    }
}
</script>
