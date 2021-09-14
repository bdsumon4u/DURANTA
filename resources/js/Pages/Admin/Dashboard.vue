<template>
    <admin-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Dashboard
            </h2>
        </template>

        <div class="py-6">
            <section class="text-gray-600 body-font">
                <div class="flex flex-wrap w-full mb-8">
                    <div class="w-full mb-6 lg:mb-0">
                        <h1 class="sm:text-4xl text-5xl font-medium title-font mb-2 text-gray-900">Statistics</h1>
                        <div class="h-1 w-20 bg-indigo-500 rounded"></div>
                    </div>
                </div>
                <div class="flex flex-wrap -m-4 text-center">
                    <div class="p-4 sm:w-1/4 w-1/2">
                        <div class="bg-indigo-500 rounded-lg p-2 xl:p-6">
                            <h2 class="title-font font-medium sm:text-4xl text-3xl text-white">{{ statistics.sellers }}</h2>
                            <p class="leading-relaxed text-gray-100 font-bold">Sellers</p>
                        </div>
                    </div>
                    <div class="p-4 sm:w-1/4 w-1/2">
                        <div class="bg-indigo-500 rounded-lg p-2 xl:p-6">
                            <h2 class="title-font font-medium sm:text-4xl text-3xl text-white">{{ statistics.products }}</h2>
                            <p class="leading-relaxed text-gray-100 font-bold">Products</p>
                        </div>
                    </div>
                    <div class="p-4 sm:w-1/4 w-1/2">
                        <div class="bg-indigo-500 rounded-lg p-2 xl:p-6">
                            <h2 class="title-font font-medium sm:text-4xl text-3xl text-white">{{ statistics.orders }}</h2>
                            <p class="leading-relaxed text-gray-100 font-bold">Orders</p>
                        </div>
                    </div>
                    <div class="p-4 sm:w-1/4 w-1/2">
                        <div class="bg-indigo-500 rounded-lg p-2 xl:p-6">
                            <h2 class="title-font font-medium sm:text-4xl text-3xl text-white">{{ statistics.customers }}</h2>
                            <p class="leading-relaxed text-gray-100 font-bold">Customers</p>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </admin-layout>
</template>

<script>
    import AdminLayout from '@/Layouts/AdminLayout'
    import Welcome from '@/Jetstream/Welcome'

    export default {
        props: ['statistics'],
        components: {
            AdminLayout,
            Welcome,
        },
        created() {
            this.makeTitle('Admin Dashboard')
        }
    }
</script>
