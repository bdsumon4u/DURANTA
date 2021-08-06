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
                        <h4 class="text-gray-700 font-medium">{{ home.name }}</h4>
                        <p class="text-gray-800">{{ home.phone }}</p>
                        <p class="text-gray-800">{{ home.address }}</p>
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
                        <h4 class="text-gray-700 font-medium">{{ office.name }}</h4>
                        <p class="text-gray-800">{{ office.phone }}</p>
                        <p class="text-gray-800">{{ office.address }}</p>
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
                        <h4 class="text-gray-700 font-medium">{{ billing.name }}</h4>
                        <p class="text-gray-800">{{ billing.phone }}</p>
                        <p class="text-gray-800">{{ billing.address }}</p>
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
    props: ['addresses'],
    components: {
        Sidebar,
        AppLayout,
    },
    computed: {
        home() {
            return this.addresses.find(address => address.type === 'home') ?? this.dummy;
        },
        office() {
            return this.addresses.find(address => address.type === 'office') ?? this.dummy;
        },
        billing() {
            return this.addresses.find(address => address.type === 'billing') ?? this.dummy;
        },
    },
    data() {
        return {
            dummy: {
                name: '',
                phone: '',
                division: '',
                district: '',
                town: '',
                address: '',
            }
        }
    }
}
</script>
