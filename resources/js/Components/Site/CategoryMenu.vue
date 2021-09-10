<template>
    <div class="w-full bg-white shadow border group-hover:opacity-100 group-hover:visible transition duration-300 z-50 divide-y divide-gray-200 divide-dashed" :class="class">
        <template v-for="navItem in $page.props.menus.categories.nav_items">
            <!-- single category -->
            <inertia-link :href="navItem.link" class="block px-4 py-2 font-medium transition hover:bg-gray-100">
                <span class="ml-6 text-gray-600 text-sm font-semibold">{{ navItem.label }}</span>
            </inertia-link>
            <!-- single category end -->
        </template>
    </div>
</template>

<script>
export default {
    name: "CategoryMenu",
    props: ['class'],
}
</script>
