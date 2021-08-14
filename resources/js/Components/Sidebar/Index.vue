<template>
    <aside
        class="print:hidden flex-shrink-0 fixed z-50 inset-y-0 w-64 max-h-screen overflow-hidden transition-all transform bg-gray-800 border-r md:static"
        :class="{'-translate-x-full md:translate-x-0': !isMobileMainMenuOpen}"
    >
        <div class="flex flex-col h-full" :class="{'pt-15 md:pt-0': isMobileMainMenuOpen}">
            <div class="relative block bg-gray-900 pl-3 pr-10 md:pr-3 py-2">
                <inertia-link class="block" :href="home">
                    <div class="flex flex-row items-center justify-center h-11 w-full">
                        <jet-application-mark class="block h-9 w-auto" />
                        <div class="text-white ml-2 font-bold text-2xl truncate">{{ $page.props.app_name }}</div>
                    </div>
                </inertia-link>
                <button @click.prevent="$emit('hamburger', !isMobileMainMenuOpen)" class="md:hidden absolute text-white w-8 h-8 bg-blue-600 hover:bg-blue-700 focus:ring-blue-700 top-3 right-1 flex items-center justify-center rounded-md">
                    <svg class="fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24">
                        <path d="M12 10.586l4.95-4.95 1.414 1.414-4.95 4.95 4.95 4.95-1.414 1.414-4.95-4.95-4.95 4.95-1.414-1.414 4.95-4.95-4.95-4.95L7.05 5.636z"/>
                    </svg>
                </button>
            </div>

            <!-- Sidebar links -->
            <nav id="sidebar" aria-label="Main" class="flex-1 px-2 py-4 space-y-2 text-gray-300 overflow-y-auto md:overflow-y-hidden hover:overflow-y-auto">
                <div class="mb-3 relative md:hidden">
                    <!-- Teams Dropdown -->
                    <jet-dropdown align="right" width="60" v-if="$page.props.jetstream.hasTeamFeatures">
                        <template #trigger>
                            <span class="flex justify-center rounded-md">
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
                                    <jet-dropdown-link :href="route('teams.show', $page.props.user.current_team)">
                                        Team Settings
                                    </jet-dropdown-link>

                                    <jet-dropdown-link :href="route('teams.create')" v-if="$page.props.jetstream.canCreateTeams">
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
                <template v-for="(item, key) in items" :key="key">
                    <sidebar-item :item="item" />
                </template>
            </nav>

            <!-- Sidebar footer -->
            <div class="flex-shrink-0 px-2 py-4 space-y-2">
                <div class="text-white text-center font-bold">
                    Load Time: 127ms
                </div>
                <a
                    href="/telescope"
                    target="_blank"
                    class="flex items-center justify-center w-full px-4 py-2 text-sm text-white bg-blue-600 rounded-md hover:bg-blue-700 focus:outline-none focus:ring focus:ring-blue-700 focus:ring-offset-1 focus:ring-offset-white"
                >
                    <span aria-hidden="true">
                        <svg
                            class="w-4 h-4 mr-2"
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4"
                            />
                        </svg>
                    </span>
                    <span>Telescope</span>
                </a>
            </div>
        </div>
    </aside>
</template>

<script>
import JetApplicationMark from "@/Jetstream/ApplicationMark";
import JetDropdown from "@/Jetstream/Dropdown";
import JetDropdownLink from "@/Jetstream/DropdownLink";
import SidebarItem from "@/Components/Sidebar/Item";

export default {
    name: "SidebarIndex",

    props: {
        home: String,
        items: Array,
        isMobileMainMenuOpen: Boolean,
    },

    components: {
        JetApplicationMark,
        JetDropdown,
        JetDropdownLink,
        SidebarItem,
    },

    data() {
        return {
            mobileMenuOpen: this.isMobileMainMenuOpen,
        };
    },
}
</script>
