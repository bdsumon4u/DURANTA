<template>
    <app-layout>
        <!-- account wrapper -->
        <div class="container lg:grid grid-cols-12 items-start gap-6 pt-4 pb-8">
            <!-- sidebar -->
            <sidebar />
            <!-- sidebar end -->

            <!-- account content -->
            <div class="col-span-9 bg-white shadow rounded px-6 pt-5 pb-7 mt-6 lg:mt-0">
                <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
                    <div v-if="$page.props.jetstream.canUpdateProfileInformation">
                        <update-profile-information-form :user="$page.props.user" />

                        <jet-section-border />
                    </div>

                    <div v-if="$page.props.jetstream.canManageTwoFactorAuthentication">
                        <two-factor-authentication-form class="mt-10 sm:mt-0" />

                        <jet-section-border />
                    </div>

                    <logout-other-browser-sessions-form :sessions="sessions" class="mt-10 sm:mt-0" />

                    <template v-if="$page.props.jetstream.hasAccountDeletionFeatures">
                        <jet-section-border />

                        <delete-user-form class="mt-10 sm:mt-0" />
                    </template>
                </div>
            </div>
            <!-- account content end -->
        </div>
        <!-- account wrapper end -->
    </app-layout>
</template>

<script>
    import AppLayout from '@/Layouts/AppLayout'
    import DeleteUserForm from './DeleteUserForm'
    import JetSectionBorder from '@/Jetstream/SectionBorder'
    import LogoutOtherBrowserSessionsForm from './LogoutOtherBrowserSessionsForm'
    import Sidebar from "../Sidebar";
    import TwoFactorAuthenticationForm from './TwoFactorAuthenticationForm'
    import UpdatePasswordForm from './UpdatePasswordForm'
    import UpdateProfileInformationForm from './UpdateProfileInformationForm'

    export default {
        props: ['sessions'],

        components: {
            AppLayout,
            DeleteUserForm,
            JetSectionBorder,
            LogoutOtherBrowserSessionsForm,
            Sidebar,
            TwoFactorAuthenticationForm,
            UpdatePasswordForm,
            UpdateProfileInformationForm,
        },
    }
</script>
