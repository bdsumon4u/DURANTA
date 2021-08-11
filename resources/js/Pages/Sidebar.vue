<template>
    <div class="col-span-3">
        <!-- account profile -->
        <div class="px-4 py-3 bg-white shadow flex items-center gap-4">
            <div v-if="$page.props.jetstream.managesProfilePhotos" class="flex-shrink-0">
                <img :src="$page.props.user.profile_photo_url" class="rounded-md w-14 h-14 p-1 border border-gray-200 object-fill" :alt="$page.props.user.name">
            </div>
            <div>
                <p class="text-gray-600">Hello,</p>
                <h4 class="text-gray-800 capitalize font-medium">{{ $page.props.user.name }}</h4>
            </div>
        </div>
        <!-- account profile end -->

        <!-- profile links -->
        <div class="mt-6 bg-white shadow rounded p-4 divide-y divide-gray-200 space-y-4 text-gray-600">
            <!-- single link -->
            <div class="space-y-1 pl-8">
                <inertia-link :href="route('dashboard')" class="hover:text-gray-900 transition block" :class="{'text-primary': route().current('dashboard')}">Manage Account</inertia-link>
                <inertia-link :href="route('profile.show')" class="hover:text-gray-900 transition block" :class="{'text-primary': route().current('profile.show')}">Profile Information</inertia-link>
                <inertia-link :href="route('password.change')" class="hover:text-gray-900 transition block" :class="{'text-primary': route().current('password.change')}">Change Password</inertia-link>
            </div>
            <!-- single link end -->
            <!-- single link -->
            <div class="space-y-1 pl-8 pt-4">
                <inertia-link :href="route('orders.index')" class="hover:text-primary transition block" :class="{'text-primary': route().current('orders.index')}">Orders</inertia-link>
                <a href="#" class="hover:text-primary transition block">Refunds</a>
                <a href="#" class="hover:text-primary transition block">Payments</a>
            </div>
            <!-- single link end -->
            <!-- single link -->
            <div class="pl-8 pt-4">
                <a href="#" @click.prevent="logout" class="hover:text-primary transition block">Logout</a>
            </div>
            <!-- single link end -->
        </div>
        <!-- profile links end -->
    </div>
</template>

<script>
export default {
    name: "Sidebar",
    methods: {
        logout() {
            this.$inertia.post(route('logout'));
        },
    },
}
</script>
