<template>
    <div class="relative">
        <div @click="open = ! open">
            <button class="relative h-10 w-10 focus:outline-none text-center text-gray-700 hover:text-primary border-transparent rounded-md shadow focus:outline-none focus:border-gray-300 transition flex items-center justify-center">
                <svg stroke="currentColor" fill="none" stroke-width="2" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round" height="24" width="24" xmlns="http://www.w3.org/2000/svg">
                    <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path>
                    <path d="M13.73 21a2 2 0 0 1-3.46 0"></path>
                </svg>
                <div v-if="notifications.unread" class="absolute top-0 right-0 w-6 h-6 text-white -mr-2 rounded-full bg-red-500">{{ notifications.unread }}</div>
            </button>
        </div>

        <!-- Full Screen Dropdown Overlay -->
        <div v-show="open" class="fixed inset-0 z-40" @click="open = false">
        </div>

        <transition
            enter-active-class="transition ease-out duration-200"
            enter-from-class="transform opacity-0 scale-95"
            enter-to-class="transform opacity-100 scale-100"
            leave-active-class="transition ease-in duration-75"
            leave-from-class="transform opacity-100 scale-100"
            leave-to-class="transform opacity-0 scale-95">
            <div v-show="open"
                 class="absolute z-50 mt-2 rounded-md shadow-lg w-72 -mr-16 md:mr-0 origin-top-right right-0"
                 style="display: none;"
                 @click="open = false">
                <div class="rounded-md ring-1 ring-black ring-opacity-5 py-1 bg-white">
                    <div class="hu z-10 aw fo right-0 sz pu uk ff">
                        <div class="text-sm font-bold fy uppercase py-2 px-4">Notifications</div>
                        <ul class="pt-1 px-2">
                            <li v-for="notification in notifications.latest" class="hover:bg-gray-200 my-1 rounded-sm" :class="[notification.read_at ? 'bg-gray-100' : 'bg-yellow-100']">
                                <a href="" @click.prevent="see(notification)" class="block px-2 py-2 nc">
                                    <span class="block text-sm mb-2">📣 <span class="rx text-gray-800">{{ notification.data.message }}</span></span>
                                    <span class="block text-xs font-weight-500 opacity-75">{{ notification.created_at }}</span>
                                </a>
                            </li>
                            <li v-if="notifications.count > 3" class="flex items-center justify-center">
                                <small class="text-xs -mt-1">.......</small>
                            </li>
                            <li class="flex mt-2 mb-1 space-x-1">
                                <strong v-if="!notifications.count" class="border p-2 text-red-500 w-full">Nothing Found.</strong>
                                <inertia-link v-if="notifications.unread > 0" class="p-2 bg-gray-200 hover:bg-gray-300 w-full text-sm grid place-content-center font-bold rounded-sm" href="" @click.prevent="markAsRead">Mark All As Read</inertia-link>
                                <inertia-link v-if="notifications.count > 3" class="p-2 bg-gray-200 hover:bg-gray-300 w-full text-sm grid place-content-center font-bold rounded-sm" :href="route(routePrefix + 'notifications')">View All</inertia-link>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </transition>
    </div>
</template>

<script>
export default {
    name: "Notifications",
    computed: {
        routePrefix() {
            if (this.$page.props.is_admin) {
                return 'admin.';
            }
            if (this.$page.props.is_seller) {
                return 'seller.';
            }
            return '';
        },
    },
    methods: {
        closeOnEscape(e) {
            if (this.open && e.keyCode === 27) {
                this.open = false;
            }
        },
        reloadList() {
            axios.get(route(this.routePrefix + 'notifications'))
                .then(({data}) => this.notifications = data)
                .catch(err => console.error(err));
        },
        see(notification) {
            this.$inertia.form({
                id: notification.id,
            }).post(route(this.routePrefix + 'notifications.see', notification), {
                onSuccess: this.reloadList,
            });
        },
        markAsRead() {
            this.$inertia.form({}).patch(route(this.routePrefix + 'notifications.read-all'), {
                onSuccess: () => {
                    this.reloadList();
                    this.emitter.emit('seen-all-notifications');
                }
            })
        }
    },
    data() {
        return {
            open: false,
            notifications: {
                count: 0,
                unread: 0,
                latest: []
            },
        };
    },
    mounted() {
        document.addEventListener('keydown', this.closeOnEscape);
        if (this.$page.props.user) {
            this.emitter.on('seen-notification', this.reloadList)
            this.reloadList();
        }
    }
}
</script>
