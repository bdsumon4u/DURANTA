<template>
    <component :is="layout">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Notifications
            </h2>
        </template>

        <div class="max-w-lg mx-auto flex flex-col border border">
            <div class="bg-white text-center text-sm text-gray-500 font-bold px-5 py-2 shadow border-b border-gray-300 uppercase">
                Recent Notifications
            </div>

            <div class="w-full overflow-hidden bg-white">
                <ul class="pt-1 px-2">
                    <li v-for="notification in data" class="hover:bg-gray-200 my-1 rounded-sm" :class="[notification.read_at ? 'bg-gray-100' : 'bg-yellow-100']">
                        <a href="" @click.prevent="see(notification)" class="block px-2 py-2 nc">
                            <span class="block text-sm mb-2">📣 <span class="rx text-gray-800">{{ notification.data.message }}</span></span>
                            <span class="block text-xs font-weight-500 opacity-75">{{ notification.created_at }}</span>
                        </a>
                    </li>
                </ul>
                <div class="mb-2">
                    <pagination :links="notifications.meta.links" />
                </div>
            </div>
        </div>
    </component>
</template>

<script>
import AdminLayout from "@/Layouts/AdminLayout";
import SellerLayout from "@/Layouts/SellerLayout";
import AppLayout from "@/Layouts/AppLayout";
import Pagination from "@/Components/Pagination";


export default {
    name: "Notifications",
    props: ['notifications'],
    components: {
        Pagination,
        AdminLayout,
        SellerLayout,
        AppLayout,
    },
    computed: {
        userType() {
            if (this.$page.props.is_admin) {
                return 'admin';
            }
            if (this.$page.props.is_seller) {
                return 'seller';
            }
            return '';
        },
        routePrefix() {
            return this.userType ? `${this.userType}.` : '';
        },
        layout() {
            if (this.userType === 'admin') {
                return 'AdminLayout';
            }
            if (this.userType === 'seller') {
                return 'SellerLayout';
            }
            return 'AppLayout';
        }
    },
    methods: {
        read(notification) {
            this.data = this.data.filter(item => {
                if (notification === undefined || item.id === notification.id) {
                    item.read_at = true;
                }
                return item;
            });
        },
        see(notification) {
            this.$inertia.form({
                id: notification.id,
            }).post(route(this.routePrefix + 'notifications.see', notification), {
                onSuccess: () => {
                    this.read(notification);
                    this.emitter.emit('seen-notification')
                },
            });
        }
    },
    data() {
        return {
            data: this.notifications.data,
        }
    },
    created() {
        this.makeTitle('Notifications')
    },
    mounted() {
        this.emitter.on('seen-all-notifications', this.read)
    }
}
</script>
