<template>
    <app-layout>
        <!-- order complete wrapper -->
        <div class="max-w-3xl mx-auto px-4 pt-16 pb-24 text-center">
            <div class="mb-8">
                <img src="/images/complete.png" class="w-16 inline-block">
            </div>
            <h2 class="text-gray-800 font-medium text-3xl mb-3">
                YOUR ORDER IS COMPLETED!
            </h2>
            <p class="text-gray-600">
                Thank you for your order! Your order is placed and will be processed within 3-6 hours. You will
                receive a confirmation message when your order status is changed.
            </p>
            <div class="mt-10">
                <inertia-link :href="route('home')" class="bg-primary border border-primary text-white px-6 py-3 font-medium rounded-md uppercase hover:bg-transparent hover:text-primary transition text-center">Continue shopping</inertia-link>
            </div>
        </div>
        <!-- order complete wrapper end -->
    </app-layout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout";

export default {
    name: "Complete",
    components: {
        AppLayout,
    }
}
</script>
