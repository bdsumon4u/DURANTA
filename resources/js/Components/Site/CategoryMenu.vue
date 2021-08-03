<template>
    <div class="w-full bg-white shadow border group-hover:opacity-100 group-hover:visible transition duration-300 z-50 divide-y divide-gray-200 divide-dashed" :class="class">
        <!-- single category -->
        <a href="#" class="px-6 py-3 flex items-center hover:bg-gray-100 transition">
            <img src="/images/icons/bed.svg" class="w-5 h-5 object-contain">
            <span class="ml-6 text-gray-600 text-sm font-semibold">Bedroom</span>
        </a>
        <!-- single category end -->
        <!-- single category -->
        <a href="#" class="px-6 py-3 flex items-center hover:bg-gray-100 transition">
            <img src="/images/icons/restaurant.svg" class="w-5 h-5 object-contain">
            <span class="ml-6 text-gray-600 text-sm font-semibold">Furniture</span>
        </a>
        <!-- single category end -->
        <!-- single category -->
        <a href="#" class="px-6 py-3 flex items-center hover:bg-gray-100 transition">
            <img src="/images/icons/bed-2.svg" class="w-5 h-5 object-contain">
            <span class="ml-6 text-gray-600 text-sm font-semibold">Mattress</span>
        </a>
        <!-- single category end -->
        <!-- single category -->
        <a href="#" class="px-6 py-3 flex items-center hover:bg-gray-100 transition">
            <img src="/images/icons/office.svg" class="w-5 h-5 object-contain">
            <span class="ml-6 text-gray-600 text-sm font-semibold">Office</span>
        </a>
        <!-- single category end -->
        <!-- single category -->
        <a href="#" class="px-6 py-3 flex items-center hover:bg-gray-100 transition">
            <img src="/images/icons/terrace.svg" class="w-5 h-5 object-contain">
            <span class="ml-6 text-gray-600 text-sm font-semibold">Outdoor</span>
        </a>
        <!-- single category end -->
        <!-- single category -->
        <a href="#" class="px-6 py-3 flex items-center hover:bg-gray-100 transition">
            <img src="/images/icons/sofa.svg" class="w-5 h-5 object-contain">
            <span class="ml-6 text-gray-600 text-sm font-semibold">Sofa</span>
        </a>
        <!-- single category end -->
    </div>
</template>

<script>
export default {
    name: "CategoryMenu",
    props: ['class'],
}
</script>
