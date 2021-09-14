<template>
    <app-layout>
        <!-- account wrapper -->
        <div class="container lg:grid grid-cols-12 items-start gap-6 pt-4 pb-8">
            <!-- sidebar -->
            <sidebar />
            <!-- sidebar end -->

            <!-- account content -->
            <div class="col-span-9 bg-white shadow rounded px-6 pt-5 pb-7 mt-6 lg:mt-0">
                <update-password-form />
            </div>
            <!-- account content end -->
        </div>
        <!-- account wrapper end -->
    </app-layout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout";
import UpdatePasswordForm from "./UpdatePasswordForm";
import Sidebar from "../Sidebar";

export default {
    name: "PasswordManager",
    components: {
        Sidebar,
        UpdatePasswordForm, AppLayout,
    },
    created() {
        this.makeTitle(this.$page.props.settings.general.site_name + ' | Password')
    }
}
</script>
