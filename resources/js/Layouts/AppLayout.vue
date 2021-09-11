<template>
    <!-- topbar -->
    <div class="hidden md:block bg-gray-100 border-b">
        <jet-banner />
        <div class="container flex justify-between px-8 py-2 text-sm">
            <div class="flex">
                <div class="flex items-center mr-6">
                    <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M11.2875 3.75C12.02 3.89292 12.6933 4.25119 13.221 4.77895C13.7488 5.30671 14.1071 5.97995 14.25 6.7125L11.2875 3.75ZM11.2875 0.75C12.8094 0.919077 14.2287 1.60063 15.3122 2.68276C16.3957 3.76488 17.079 5.18326 17.25 6.705L11.2875 0.75ZM16.5 12.69V14.94C16.5008 15.1489 16.458 15.3556 16.3744 15.547C16.2907 15.7384 16.168 15.9102 16.014 16.0514C15.8601 16.1926 15.6784 16.3001 15.4805 16.367C15.2827 16.4339 15.073 16.4588 14.865 16.44C12.5571 16.1892 10.3402 15.4006 8.39248 14.1375C6.58035 12.986 5.04398 11.4496 3.89248 9.6375C2.62496 7.6809 1.83616 5.45325 1.58998 3.135C1.57124 2.9276 1.59589 2.71857 1.66236 2.52122C1.72882 2.32387 1.83566 2.14252 1.97605 1.98872C2.11645 1.83491 2.28733 1.71203 2.47782 1.62789C2.66831 1.54375 2.87424 1.5002 3.08248 1.5H5.33248C5.69646 1.49642 6.04932 1.62531 6.3253 1.86265C6.60128 2.09999 6.78154 2.42959 6.83248 2.79C6.92745 3.51005 7.10357 4.21705 7.35748 4.8975C7.45839 5.16594 7.48023 5.45769 7.42041 5.73816C7.36059 6.01863 7.22163 6.27608 7.01998 6.48L6.06748 7.4325C7.13515 9.31016 8.68982 10.8648 10.5675 11.9325L11.52 10.98C11.7239 10.7784 11.9813 10.6394 12.2618 10.5796C12.5423 10.5198 12.834 10.5416 13.1025 10.6425C13.7829 10.8964 14.4899 11.0725 15.21 11.1675C15.5743 11.2189 15.907 11.4024 16.1449 11.6831C16.3827 11.9638 16.5091 12.3222 16.5 12.69Z" stroke="#C9151B" stroke-linecap="round" stroke-linejoin="round"></path>
                    </svg>
                    <a class="ml-2" :href="`tel:${$page.props.settings.general.contact_phone}`">{{ $page.props.settings.general.contact_phone }}</a>
                </div>
                <div class="flex items-center">
                    <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M3.00001 3H15C15.825 3 16.5 3.675 16.5 4.5V13.5C16.5 14.325 15.825 15 15 15H3.00001C2.17501 15 1.50001 14.325 1.50001 13.5V4.5C1.50001 3.675 2.17501 3 3.00001 3Z" stroke="#C9151B" stroke-linecap="round" stroke-linejoin="round"></path>
                        <path d="M16.5 4.5L9.00001 9.75L1.50001 4.5" stroke="#C9151B" stroke-linecap="round" stroke-linejoin="round"></path>
                    </svg>
                    <a :href="`mailto:${$page.props.settings.general.contact_email}`" class="ml-2">{{ $page.props.settings.general.contact_email }}</a>
                </div>
            </div>
            <div class="flex items-center">
                <a class="flex items-center" href="">
                    <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M13.5 1.5H4.5C3.67157 1.5 3 2.17157 3 3V15C3 15.8284 3.67157 16.5 4.5 16.5H13.5C14.3284 16.5 15 15.8284 15 15V3C15 2.17157 14.3284 1.5 13.5 1.5Z" stroke="#C9151B" stroke-linecap="round" stroke-linejoin="round"></path>
                        <path d="M9 13.5H9.0075" stroke="#C9151B" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                    </svg>
                    <span class="ml-2">Save big on our app!</span>
                </a>
            </div>
        </div>
    </div>
    <!-- topbar -->

    <sidebar-header />

    <slot />

    <!-- footer -->
    <footer class="bg-white pt-16 pb-12 border-t border-gray-100">
        <div class="container">
            <div class="xl:grid xl:grid-cols-3 xl:gap-8">
                <!-- footer text -->
                <div class="space-y-8 xl:col-span-1">
                    <inertia-link :href="route('home')" class="block w-28 md:w-40 h-9 md:h-10">
                        <img v-if="$page.props.settings.general.logo" :src="$page.props.settings.general.logo" class="w-full object-fill h-full" alt="Logo">
                        <div v-else class="w-full flex h-full justify-center items-center text-primary border-2 border-primary font-semibold font-roboto-condensed text-2xl">
                            {{ $page.props.settings.general.site_name }}
                        </div>
                    </inertia-link>
                    <p class="text-gray-500 text-base">
                        {{ $page.props.settings.general.tagline }}
                    </p>
                    <div class="flex space-x-6">
                       <!-- Play Store -->
                       <!-- App Store -->
                    </div>
                </div>
                <!-- footer text end -->
                <!-- footer links -->
                <div class="mt-12 col-span-2 grid md:grid-cols-3 gap-8 xl:mt-0">
                    <div class="">
                        <h3 class="text-sm font-bold text-gray-400 tracking-wider uppercase">
                            Quick Links
                        </h3>
                        <div class="mt-4 space-y-4">
                            <template v-for="navItem in $page.props.menus.quick_links.nav_items">
                                <inertia-link :href="navItem.link" class="text-base text-gray-500 hover:text-gray-900 block">
                                    {{ navItem.label }}
                                </inertia-link>
                            </template>
                        </div>
                    </div>
                    <div class="">
                        <h3 class="text-sm font-bold text-gray-400 tracking-wider uppercase">
                            Contact Us
                        </h3>
                        <div class="mt-4 space-y-4">
                            <p class="text-gray-500 hover:text-flex-900">{{ $page.props.settings.general.company_address }}</p>
                            <p class="text-gray-500 hover:text-flex-900">Email: {{ $page.props.settings.general.contact_email }}</p>
                            <p class="text-gray-500 hover:text-flex-900">Contact No: {{ $page.props.settings.general.contact_phone }}</p>
                        </div>
                    </div>
                    <div class="">
                        <h3 class="text-sm font-bold text-gray-400 tracking-wider uppercase">
                            Social Links
                        </h3>
                        <div class="mt-4 space-y-4">
                            <a target="_blank" :href="$page.props.settings.social.facebook" class="text-base text-gray-500 hover:text-gray-900 flex">
                                <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-5 h-5" viewBox="0 0 24 24"><path d="M18 2h-3a5 5 0 00-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 011-1h3z"></path></svg>
                                <span class="ml-3">Facebook</span>
                            </a>
                            <a target="_blank" :href="$page.props.settings.social.facebook" class="text-base text-gray-500 hover:text-gray-900 flex">
                                <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-5 h-5" viewBox="0 0 24 24"><path d="M23 3a10.9 10.9 0 01-3.14 1.53 4.48 4.48 0 00-7.86 3v1A10.66 10.66 0 013 4s-4 9 5 13a11.64 11.64 0 01-7 2c9 5 20 0 20-11.5a4.5 4.5 0 00-.08-.83A7.72 7.72 0 0023 3z"></path></svg>
                                <span class="ml-3">Twitter</span>
                            </a>
                            <a target="_blank" :href="$page.props.settings.social.facebook" class="text-base text-gray-500 hover:text-gray-900 flex">
                                <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-5 h-5" viewBox="0 0 24 24"><path d="M12 0C8.74 0 8.333.015 7.053.072 5.775.132 4.905.333 4.14.63c-.789.306-1.459.717-2.126 1.384S.935 3.35.63 4.14C.333 4.905.131 5.775.072 7.053.012 8.333 0 8.74 0 12s.015 3.667.072 4.947c.06 1.277.261 2.148.558 2.913.306.788.717 1.459 1.384 2.126.667.666 1.336 1.079 2.126 1.384.766.296 1.636.499 2.913.558C8.333 23.988 8.74 24 12 24s3.667-.015 4.947-.072c1.277-.06 2.148-.262 2.913-.558.788-.306 1.459-.718 2.126-1.384.666-.667 1.079-1.335 1.384-2.126.296-.765.499-1.636.558-2.913.06-1.28.072-1.687.072-4.947s-.015-3.667-.072-4.947c-.06-1.277-.262-2.149-.558-2.913-.306-.789-.718-1.459-1.384-2.126C21.319 1.347 20.651.935 19.86.63c-.765-.297-1.636-.499-2.913-.558C15.667.012 15.26 0 12 0zm0 2.16c3.203 0 3.585.016 4.85.071 1.17.055 1.805.249 2.227.415.562.217.96.477 1.382.896.419.42.679.819.896 1.381.164.422.36 1.057.413 2.227.057 1.266.07 1.646.07 4.85s-.015 3.585-.074 4.85c-.061 1.17-.256 1.805-.421 2.227-.224.562-.479.96-.899 1.382-.419.419-.824.679-1.38.896-.42.164-1.065.36-2.235.413-1.274.057-1.649.07-4.859.07-3.211 0-3.586-.015-4.859-.074-1.171-.061-1.816-.256-2.236-.421-.569-.224-.96-.479-1.379-.899-.421-.419-.69-.824-.9-1.38-.165-.42-.359-1.065-.42-2.235-.045-1.26-.061-1.649-.061-4.844 0-3.196.016-3.586.061-4.861.061-1.17.255-1.814.42-2.234.21-.57.479-.96.9-1.381.419-.419.81-.689 1.379-.898.42-.166 1.051-.361 2.221-.421 1.275-.045 1.65-.06 4.859-.06l.045.03zm0 3.678c-3.405 0-6.162 2.76-6.162 6.162 0 3.405 2.76 6.162 6.162 6.162 3.405 0 6.162-2.76 6.162-6.162 0-3.405-2.76-6.162-6.162-6.162zM12 16c-2.21 0-4-1.79-4-4s1.79-4 4-4 4 1.79 4 4-1.79 4-4 4zm7.846-10.405c0 .795-.646 1.44-1.44 1.44-.795 0-1.44-.646-1.44-1.44 0-.794.646-1.439 1.44-1.439.793-.001 1.44.645 1.44 1.439z"></path></svg>
                                <span class="ml-3">Instagram</span>
                            </a>
                            <a target="_blank" :href="$page.props.settings.social.facebook" class="text-base text-gray-500 hover:text-gray-900 flex">
                                <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-5 h-5" viewBox="0 0 24 24"><path d="M23.499 6.203a3.008 3.008 0 00-2.089-2.089c-1.87-.501-9.4-.501-9.4-.501s-7.509-.01-9.399.501a3.008 3.008 0 00-2.088 2.09A31.258 31.26 0 000 12.01a31.258 31.26 0 00.523 5.785 3.008 3.008 0 002.088 2.089c1.869.502 9.4.502 9.4.502s7.508 0 9.399-.502a3.008 3.008 0 002.089-2.09 31.258 31.26 0 00.5-5.784 31.258 31.26 0 00-.5-5.808zm-13.891 9.4V8.407l6.266 3.604z"></path></svg>
                                <span class="ml-3">Youtube</span>
                            </a>
                        </div>
                    </div>
                </div>
                <!-- footer links end -->
            </div>
        </div>
    </footer>
    <!-- footer end -->

    <!-- copyright -->
    <div class="bg-gray-800 py-4 mb-[3rem] lg:mb-0">
        <div class="container flex flex-wrap items-center justify-between">
            <p class="w-full md:w-1/2 text-white text-center mb-2 md:mb-0">© {{ $page.props.settings.general.site_name }} - All Rights Reserved</p>
            <div class="w-full md:w-1/2 flex justify-center">
                <img src="/images/methods.png" class="h-5" alt="Payment Gateway">
            </div>
        </div>
    </div>
</template>

<script>
import JetBanner from "@/Jetstream/Banner";
import JetDropdown from "@/Jetstream/Dropdown";
import JetDropdownLink from "@/Jetstream/DropdownLink";
import Notifications from "@/Components/Notifications";
import Sidebar from "@/Components/Sidebar/Index";
import CategoryMenu from "@/Components/Site/CategoryMenu";
import SidebarHeader from "@/Components/Site/SidebarHeader";

export default {
    components: {
        CategoryMenu,
        JetBanner,
        JetDropdown,
        JetDropdownLink,
        Notifications,
        Sidebar,
        SidebarHeader,
    },

    computed: {
        is_home_page() {
            return route().current('home');
        },
    },

    methods: {
        switchToTeam(team) {
            this.$inertia.put(route('current-team.update'), {
                'team_id': team.id
            }, {
                preserveState: false
            })
        },

        logout() {
            this.$inertia.post(route('logout'));
        },
    },

    mounted() {
        this.isLoading = false;
    }
}
</script>
