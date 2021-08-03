<template>
    <div class="container py-4 flex justify-between">
        <div class="flex gap-3 items-center">
            <inertia-link :href="route('home')" class="text-primary text-base">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24">
                    <path fill="none" d="M0 0h24v24H0z"/>
                    <path fill="currentColor" d="M19 21H5a1 1 0 0 1-1-1v-9H1l10.327-9.388a1 1 0 0 1 1.346 0L23 11h-3v9a1 1 0 0 1-1 1zM6 19h12V9.157l-6-5.454-6 5.454V19zm3-9h6v6H9v-6zm2 2v2h2v-2h-2z"/>
                </svg>
            </inertia-link>
            <span class="text-sm text-gray-400">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24">
                    <path fill="none" d="M0 0h24v24H0z"/>
                    <path fill="currentColor" d="M13.172 12l-4.95-4.95 1.414-1.414L16 12l-6.364 6.364-1.414-1.414z"/>
                </svg>
            </span>
            <template v-for="item in items">
                <template v-if="item.link !== undefined">
                    <inertia-link :href="item.link" class="text-primary text-base">{{ item.title }}</inertia-link>
                    <span class="text-sm text-gray-400">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24">
                            <path fill="none" d="M0 0h24v24H0z"/>
                            <path fill="currentColor" d="M13.172 12l-4.95-4.95 1.414-1.414L16 12l-6.364 6.364-1.414-1.414z"/>
                        </svg>
                    </span>
                </template>
                <p v-else class="text-gray-600 font-medium">{{ item.title }}</p>
            </template>
        </div>
    </div>
</template>

<script>
export default {
    name: "Breadcrumb",
    props: ['items'],
}
</script>
