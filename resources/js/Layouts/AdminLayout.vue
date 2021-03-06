<template>
    <div>
        <jet-banner />
        <div class="flex h-screen antialiased text-gray-900 bg-gray-100 ">
            <!-- Loading screen -->
            <div
                v-show="isLoading"
                class="fixed inset-0 z-50 flex items-center justify-center text-2xl font-semibold text-white bg-opacity-70 bg-gray-700"
            >
                <div class="spinner"></div>
            </div>

            <!-- Sidebar -->
            <sidebar :home="route('admin.dashboard')" :items="sidebar" :isMobileMainMenuOpen="isMobileMainMenuOpen" @hamburger="isOpen => this.isMobileMainMenuOpen = isOpen" />

            <div class="flex flex-col flex-1 min-h-screen overflow-x-hidden overflow-y-auto">
                <!-- Navbar -->
                <header class="print:hidden relative z-30 bg-white shadow">
                    <div class="flex items-center justify-between p-2 border-b">
                        <!-- Mobile menu button -->
                        <button
                            @click="isMobileMainMenuOpen = !isMobileMainMenuOpen"
                            class="p-1 text-blue-400 transition-colors duration-200 rounded-md bg-blue-50 hover:text-blue-600 hover:bg-blue-100 md:hidden focus:outline-none focus:ring"
                        >
                            <span aria-hidden="true">
                                <svg
                                    class="w-8 h-8"
                                    xmlns="http://www.w3.org/2000/svg"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke="currentColor"
                                >
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                                </svg>
                            </span>
                        </button>

                        <div class="hidden md:block">
                            <slot name="header"></slot>
                        </div>

                        <!-- Right Buttons -->
                        <nav aria-label="Right Buttons" class="mr-3 flex items-center">
                            <div class="ml-3 relative hidden md:block">
                                <!-- Teams Dropdown -->
                                <jet-dropdown align="right" width="60" v-if="$page.props.jetstream.hasTeamFeatures">
                                    <template #trigger>
                                        <span class="inline-flex rounded-md">
                                            <button type="button" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:bg-gray-50 hover:text-gray-700 focus:outline-none focus:bg-gray-50 active:bg-gray-50 transition">
                                                {{ $page.props.user.current_team.name }}

                                                <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                                    <path fill-rule="evenodd" d="M10 3a1 1 0 01.707.293l3 3a1 1 0 01-1.414 1.414L10 5.414 7.707 7.707a1 1 0 01-1.414-1.414l3-3A1 1 0 0110 3zm-3.707 9.293a1 1 0 011.414 0L10 14.586l2.293-2.293a1 1 0 011.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z" clip-rule="evenodd" />
                                                </svg>
                                            </button>
                                        </span>
                                    </template>

                                    <template #content>
                                        <div class="w-60">
                                            <!-- Team Management -->
                                            <template v-if="$page.props.jetstream.hasTeamFeatures">
                                                <div class="block px-4 py-2 text-xs text-gray-400">
                                                    Manage Team
                                                </div>

                                                <!-- Team Settings -->
                                                <jet-dropdown-link :href="route('admin.teams.show', $page.props.user.current_team)">
                                                    Team Settings
                                                </jet-dropdown-link>

                                                <jet-dropdown-link :href="route('admin.teams.create')" v-if="$page.props.jetstream.canCreateTeams">
                                                    Create New Team
                                                </jet-dropdown-link>

                                                <div class="border-t border-gray-100"></div>

                                                <!-- Team Switcher -->
                                                <div class="block px-4 py-2 text-xs text-gray-400">
                                                    Switch Teams
                                                </div>

                                                <template v-for="team in $page.props.user.all_teams" :key="team.id">
                                                    <form @submit.prevent="switchToTeam(team)">
                                                        <jet-dropdown-link as="button">
                                                            <div class="flex items-center">
                                                                <svg v-if="team.id == $page.props.user.current_team_id" class="mr-2 h-5 w-5 text-green-400" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" stroke="currentColor" viewBox="0 0 24 24"><path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                                                <div>{{ team.name }}</div>
                                                            </div>
                                                        </jet-dropdown-link>
                                                    </form>
                                                </template>
                                            </template>
                                        </div>
                                    </template>
                                </jet-dropdown>
                            </div>

                            <div class="ml-3 relative">
                                <Notifications />
                            </div>

                            <!-- Settings Dropdown -->
                            <div class="ml-3 relative">
                                <jet-dropdown align="right" width="48">
                                    <template #trigger>
                                        <button v-if="$page.props.jetstream.managesProfilePhotos" class="flex text-sm border-2 border-transparent rounded-md focus:outline-none focus:border-gray-300 transition">
                                            <img class="h-10 w-10 rounded-md object-cover" :src="$page.props.user.profile_photo_url" :alt="$page.props.user.name" />
                                        </button>

                                        <span v-else class="inline-flex rounded-md">
                                            <button type="button" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition">
                                                {{ $page.props.user.name }}

                                                <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                                </svg>
                                            </button>
                                        </span>
                                    </template>

                                    <template #content>
                                        <!-- Account Management -->
                                        <div class="block px-4 py-2 text-xs text-gray-400">
                                            Manage Account
                                        </div>

                                        <jet-dropdown-link :href="route('admin.profile.show')">
                                            Profile
                                        </jet-dropdown-link>

                                        <jet-dropdown-link :href="route('admin.api-tokens.index')" v-if="$page.props.jetstream.hasApiFeatures">
                                            API Tokens
                                        </jet-dropdown-link>

                                        <div class="border-t border-gray-100"></div>

                                        <!-- Authentication -->
                                        <form @submit.prevent="logout">
                                            <jet-dropdown-link as="button">
                                                Log Out
                                            </jet-dropdown-link>
                                        </form>
                                    </template>
                                </jet-dropdown>
                            </div>
                        </nav>
                    </div>
                </header>

                <!-- Main content -->
                <main class="flex-1 overflow-x-hidden overflow-y-auto">
                    <div class="container mx-auto p-1 md:p-3 lg:px-6 lg:py-8">
                        <div class="overflow-hidden text-gray-500 text-xl border-gray-300 border-dashed">
                            <!-- Content -->
                            <slot></slot>
                            <!-- Content -->
                        </div>
                    </div>
                </main>
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

export default {
    components: {
        JetBanner,
        JetDropdown,
        JetDropdownLink,
        Notifications,
        Sidebar,
    },

    data() {
        return {
            isLoading: true,
            isMobileMainMenuOpen: false,
            showingNavigationDropdown: false,
            current_team_id: this.$page.props.user.current_team_id,
            sidebar: [
                {
                    name: 'Dashboard',
                    icon: '<path d="M6 19h12V9.157l-6-5.454-6 5.454V19zm13 2H5a1 1 0 0 1-1-1v-9H1l10.327-9.388a1 1 0 0 1 1.346 0L23 11h-3v9a1 1 0 0 1-1 1zM7.5 13h2a2.5 2.5 0 1 0 5 0h2a4.5 4.5 0 1 1-9 0z"/>',
                    href: route('admin.dashboard'),
                },
                {
                    name: 'E-Commerce',
                    icon: '<path d="M21 11.646V21a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1v-9.354A3.985 3.985 0 0 1 2 9V3a1 1 0 0 1 1-1h18a1 1 0 0 1 1 1v6c0 1.014-.378 1.94-1 2.646zm-2 1.228a4.007 4.007 0 0 1-4-1.228A3.99 3.99 0 0 1 12 13a3.99 3.99 0 0 1-3-1.354 3.99 3.99 0 0 1-4 1.228V20h14v-7.126zM14 9a1 1 0 0 1 2 0 2 2 0 1 0 4 0V4H4v5a2 2 0 1 0 4 0 1 1 0 1 1 2 0 2 2 0 1 0 4 0z"/>',
                    open: route().current('admin.brands.index') || route().current('admin.brands.edit') || route().current('admin.categories.index') || route().current('admin.categories.edit') || route().current('admin.campaigns.index') || route().current('admin.campaigns.edit'),
                    items: [
                        {
                            name: 'Brands',
                            active: route().current('admin.brands.index') || route().current('admin.brands.edit'),
                            href: route('admin.brands.index'),
                        },
                        {
                            name: 'Categories',
                            active: route().current('admin.categories.index') || route().current('admin.categories.edit'),
                            href: route('admin.categories.index'),
                        },
                        {
                            name: 'Campaigns',
                            active: route().current('admin.campaigns.index') || route().current('admin.campaigns.edit'),
                            href: route('admin.campaigns.index'),
                        },
                    ],
                },
                {
                    name: 'Slider',
                    icon: '<path d="M5 11.1l2-2 5.5 5.5 3.5-3.5 3 3V5H5v6.1zm0 2.829V19h3.1l2.986-2.985L7 11.929l-2 2zM10.929 19H19v-2.071l-3-3L10.929 19zM4 3h16a1 1 0 0 1 1 1v16a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V4a1 1 0 0 1 1-1zm11.5 7a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3z"/>',
                    open: route().current('admin.slides.index') || route().current('admin.slides.create'),
                    items: [
                        {
                            name: 'Add New',
                            active: route().current('admin.slides.create'),
                            href: route('admin.slides.create'),
                        },
                        {
                            name: 'All Slides',
                            active: route().current('admin.slides.index'),
                            href: route('admin.slides.index'),
                        },
                    ],
                },
                {
                    name: 'Menus',
                    active: route().current('admin.menus'),
                    icon: '<path d="M3 4h18v2H3V4zm0 7h18v2H3v-2zm0 7h18v2H3v-2z"/>',
                    href: route('admin.menus'),
                },
                {
                    name: 'Products',
                    open: route().current('admin.products.index'),
                    icon: '<path d="M12 22C6.477 22 2 17.523 2 12S6.477 2 12 2s10 4.477 10 10-4.477 10-10 10zm0-2a8 8 0 1 0 0-16 8 8 0 0 0 0 16zm1.334-8a1.5 1.5 0 0 0 0-3H10.5v3h2.834zm0-5a3.5 3.5 0 0 1 0 7H10.5v3h-2V7h4.834z"/>',
                    items: [
                        {
                            name: 'All',
                            active: route().current('admin.products.index', {status: ''}),
                            href: route('admin.products.index', {status: ''}),
                        },
                        {
                            name: 'Pending',
                            active: route().current('admin.products.index', {status: 'PENDING'}),
                            href: route('admin.products.index', {status: 'PENDING'}),
                        },
                        {
                            name: 'Approved',
                            active: route().current('admin.products.index', {status: 'APPROVED'}),
                            href: route('admin.products.index', {status: 'APPROVED'}),
                        },
                    ],
                },
                {
                    name: 'Orders',
                    active: route().current('admin.orders.index'),
                    icon: '<path d="M8 4h13v2H8V4zM5 3v3h1v1H3V6h1V4H3V3h2zM3 14v-2.5h2V11H3v-1h3v2.5H4v.5h2v1H3zm2 5.5H3v-1h2V18H3v-1h3v4H3v-1h2v-.5zM8 11h13v2H8v-2zm0 7h13v2H8v-2z"/>',
                    href: route('admin.orders.index'),
                },
                {
                    name: 'Pages',
                    open: route().current('admin.pages.*'),
                    icon: '<path d="M5 8v12h14V8H5zm0-2h14V4H5v2zm15 16H4a1 1 0 0 1-1-1V3a1 1 0 0 1 1-1h16a1 1 0 0 1 1 1v18a1 1 0 0 1-1 1zM7 10h4v4H7v-4zm0 6h10v2H7v-2zm6-5h4v2h-4v-2z"/>',
                    items: [
                        {
                            name: 'View All',
                            href: route('admin.pages.index'),
                        },
                        {
                            name: 'Create New',
                            href: route('admin.pages.create'),
                        },
                    ],
                },
                {
                    name: 'Sellers',
                    open: route().current('admin.sellers.index') || route().current('admin.sellers.show') || route().current('admin.sellerships.edit'),
                    icon: '<path d="M7.83 20A3.001 3.001 0 1 1 4 16.17V7.83A3.001 3.001 0 1 1 7.83 4h8.34A3.001 3.001 0 1 1 20 7.83v8.34A3.001 3.001 0 1 1 16.17 20H7.83zm0-2h8.34A3.008 3.008 0 0 1 18 16.17V7.83A3.008 3.008 0 0 1 16.17 6H7.83A3.008 3.008 0 0 1 6 7.83v8.34A3.008 3.008 0 0 1 7.83 18zM5 6a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm14 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm0 14a1 1 0 1 0 0-2 1 1 0 0 0 0 2zM5 20a1 1 0 1 0 0-2 1 1 0 0 0 0 2z"/>',
                    items: [
                        {
                            name: 'Approved',
                            active: route().current('admin.sellers.index', {status: 'APPROVED'}),
                            href: route('admin.sellers.index', {status: 'APPROVED'}),
                        },
                        {
                            name: 'Pending',
                            active: route().current('admin.sellers.index', {status: 'PENDING'}),
                            href: route('admin.sellers.index', {status: 'PENDING'}),
                        },
                        {
                            name: 'Rejected',
                            active: route().current('admin.sellers.index', {status: 'rejected'}),
                            href: route('admin.sellers.index', {status: 'rejected'}),
                        },
                    ],
                },
                {
                    name: 'Payouts',
                    open: route().current('admin.payouts') || route().current('admin.payouts.paid') || route().current('admin.payouts.history'),
                    icon: '<path d="M11 2l7.298 2.28a1 1 0 0 1 .702.955V7h2a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1l-3.22.001c-.387.51-.857.96-1.4 1.33L11 22l-5.38-3.668A6 6 0 0 1 3 13.374V5.235a1 1 0 0 1 .702-.954L11 2zm0 2.094L5 5.97v7.404a4 4 0 0 0 1.558 3.169l.189.136L11 19.58 14.782 17H10a1 1 0 0 1-1-1V8a1 1 0 0 1 1-1h7V5.97l-6-1.876zM11 12v3h9v-3h-9zm0-2h9V9h-9v1z"/>',
                    items: [
                        {
                            name: 'PayNow',
                            active: route().current('admin.payouts'),
                            href: route('admin.payouts'),
                        },
                        {
                            name: 'History',
                            active: route().current('admin.payouts.history'),
                            href: route('admin.payouts.history'),
                        },
                    ],
                },
                {
                    name: 'Widgets',
                    icon: '<path d="M20.083 15.2l1.202.721a.5.5 0 0 1 0 .858l-8.77 5.262a1 1 0 0 1-1.03 0l-8.77-5.262a.5.5 0 0 1 0-.858l1.202-.721L12 20.05l8.083-4.85zm0-4.7l1.202.721a.5.5 0 0 1 0 .858L12 17.65l-9.285-5.571a.5.5 0 0 1 0-.858l1.202-.721L12 15.35l8.083-4.85zm-7.569-9.191l8.771 5.262a.5.5 0 0 1 0 .858L12 13 2.715 7.429a.5.5 0 0 1 0-.858l8.77-5.262a1 1 0 0 1 1.03 0zM12 3.332L5.887 7 12 10.668 18.113 7 12 3.332z"/>',
                    href: route('admin.widgets'),
                    active: route().current('admin.widgets'),
                },
                {
                    name: 'Settings',
                    icon: '<path d="M2.213 14.06a9.945 9.945 0 0 1 0-4.12c1.11.13 2.08-.237 2.396-1.001.317-.765-.108-1.71-.986-2.403a9.945 9.945 0 0 1 2.913-2.913c.692.877 1.638 1.303 2.403.986.765-.317 1.132-1.286 1.001-2.396a9.945 9.945 0 0 1 4.12 0c-.13 1.11.237 2.08 1.001 2.396.765.317 1.71-.108 2.403-.986a9.945 9.945 0 0 1 2.913 2.913c-.877.692-1.303 1.638-.986 2.403.317.765 1.286 1.132 2.396 1.001a9.945 9.945 0 0 1 0 4.12c-1.11-.13-2.08.237-2.396 1.001-.317.765.108 1.71.986 2.403a9.945 9.945 0 0 1-2.913 2.913c-.692-.877-1.638-1.303-2.403-.986-.765.317-1.132 1.286-1.001 2.396a9.945 9.945 0 0 1-4.12 0c.13-1.11-.237-2.08-1.001-2.396-.765-.317-1.71.108-2.403.986a9.945 9.945 0 0 1-2.913-2.913c.877-.692 1.303-1.638.986-2.403-.317-.765-1.286-1.132-2.396-1.001zM4 12.21c1.1.305 2.007 1.002 2.457 2.086.449 1.085.3 2.22-.262 3.212.096.102.195.201.297.297.993-.562 2.127-.71 3.212-.262 1.084.45 1.781 1.357 2.086 2.457.14.004.28.004.42 0 .305-1.1 1.002-2.007 2.086-2.457 1.085-.449 2.22-.3 3.212.262.102-.096.201-.195.297-.297-.562-.993-.71-2.127-.262-3.212.45-1.084 1.357-1.781 2.457-2.086.004-.14.004-.28 0-.42-1.1-.305-2.007-1.002-2.457-2.086-.449-1.085-.3-2.22.262-3.212a7.935 7.935 0 0 0-.297-.297c-.993.562-2.127.71-3.212.262C13.212 6.007 12.515 5.1 12.21 4a7.935 7.935 0 0 0-.42 0c-.305 1.1-1.002 2.007-2.086 2.457-1.085.449-2.22.3-3.212-.262-.102.096-.201.195-.297.297.562.993.71 2.127.262 3.212C6.007 10.788 5.1 11.485 4 11.79c-.004.14-.004.28 0 .42zM12 15a3 3 0 1 1 0-6 3 3 0 0 1 0 6zm0-2a1 1 0 1 0 0-2 1 1 0 0 0 0 2z"/>',
                    href: route('admin.settings'),
                    active: route().current('admin.settings'),
                },
            ],
        }
    },

    methods: {
        switchToTeam(team) {
            this.$inertia.put(route('admin.current-team.update'), {
                'team_id': team.id
            }, {
                preserveState: false
            })
        },

        logout() {
            this.$inertia.post(route('admin.logout'));
        },
    },

    mounted() {
        this.isLoading = false;
    }
}
</script>
