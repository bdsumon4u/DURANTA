<template>
    <app-layout>
        <!-- account wrapper -->
        <div class="container lg:grid grid-cols-12 items-start gap-6 pt-4 pb-16">
            <!-- sidebar -->
            <sidebar />
            <!-- sidebar end -->

            <!-- account content -->
            <div class="col-span-9 grid md:grid-cols-3 gap-4 mt-6 lg:mt-0">
                <!-- single card -->
                <div class="shadow rounded bg-white px-4 pt-6 pb-8">
                    <div class="flex justify-between items center mb-4">
                        <h3 class="font-medium capitalize text-gray-800 text-lg">Home Address</h3>
                        <inertia-link :href="route('address', 'home')" class="text-primary">Edit</inertia-link>
                    </div>
                    <div class="space-y-1">
                        <h4 class="text-gray-700 font-medium">Sumon Ahmed</h4>
                        <p class="text-gray-800">example@mail.com</p>
                        <p class="text-gray-800">(123) 456-789</p>
                    </div>
                </div>
                <!-- single card end -->
                <!-- single card -->
                <div class="shadow rounded bg-white px-4 pt-6 pb-8">
                    <div class="flex justify-between items center mb-4">
                        <h3 class="font-medium capitalize text-gray-800 text-lg">Office Address</h3>
                        <inertia-link :href="route('address', 'office')" class="text-primary">Edit</inertia-link>
                    </div>
                    <div class="space-y-1">
                        <h4 class="text-gray-700 font-medium">Sumon Ahmed</h4>
                        <p class="text-gray-800">3891 Ranchview Dr.</p>
                        <p class="text-gray-800">Richardson, Califora</p>
                        <p class="text-gray-800">(123) 456-789</p>
                    </div>
                </div>
                <!-- single card end -->
                <!-- single card -->
                <div class="shadow rounded bg-white px-4 pt-6 pb-8">
                    <div class="flex justify-between items center mb-4">
                        <h3 class="font-medium capitalize text-gray-800 text-lg">Billing Address</h3>
                        <inertia-link :href="route('address', 'billing')" class="text-primary">Edit</inertia-link>
                    </div>
                    <div class="space-y-1">
                        <h4 class="text-gray-700 font-medium">Sumon Ahmed</h4>
                        <p class="text-gray-800">3891 Ranchview Dr.</p>
                        <p class="text-gray-800">Richardson, Califora</p>
                        <p class="text-gray-800">(123) 456-789</p>
                    </div>
                </div>
                <!-- single card end -->
            </div>
            <!-- account content end -->
        </div>
        <!-- account wrapper end -->
    </app-layout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout";
import Sidebar from "./Sidebar";

export default {
    name: "Dashboard",
    components: {
        Sidebar,
        AppLayout,
    },
}
</script>
