<template>
    <app-layout>
        <!-- breadcrumb -->
        <breadcrumb :items="[{title: 'Products'}]" />
        <!-- breadcrumb end -->

        <!-- products wrapper -->
        <div class="container grid lg:grid-cols-4 gap-6 pt-4 pb-16 items-start relative">
            <!-- sidebar -->
            <div class="col-span-1 bg-white px-4 pt-4 pb-6 shadow rounded overflow-hidden absolute lg:static left-4 top-16 z-10 w-72 lg:w-full lg:block" :class="{'hidden': !showFilter}">
                <div class="divide-gray-200 divide-y space-y-5 relative">
                    <!-- sorting -->
                    <div class="relative">
                        <div @click="showFilter = false" class="lg:hidden text-gray-400 hover:text-primary text-lg absolute right-0 top-0 cursor-pointer">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24">
                                <path fill="none" d="M0 0h24v24H0z"/>
                                <path fill="currentColor" d="M12 10.586l4.95-4.95 1.414 1.414-4.95 4.95 4.95 4.95-1.414 1.414-4.95-4.95-4.95 4.95-1.414-1.414 4.95-4.95-4.95-4.95L7.05 5.636z"/>
                            </svg>
                        </div>
                        <h3 class="text-xl text-gray-800 mb-3 uppercase font-medium">Sorting</h3>
                        <div class="space-y-2">
                            <select
                                class="w-full text-sm text-gray-600 px-4 py-3 border-gray-300 shadow-sm rounded focus:ring-primary focus:border-primary">
                                <option>Default sorting</option>
                                <option>Price low-high</option>
                                <option>Price high-low</option>
                                <option>Latest product</option>
                            </select>
                        </div>
                    </div>
                    <!-- sorting end -->
                    <!-- category filter -->
                    <div class="pt-4">
                        <h3 class="text-xl text-gray-800 mb-3 uppercase font-medium">Categories</h3>
                        <div class="space-y-2">
                            <!-- single category -->
                            <div class="flex items-center">
                                <input type="checkbox" id="Bedroom"
                                       class="text-primary focus:ring-0 rounded-sm cursor-pointer">
                                <label for="Bedroom" class="text-gray-600 ml-3 cursor-pointer">Bedroom</label>
                                <div class="ml-auto text-gray-600 text-sm">(15)</div>
                            </div>
                            <!-- single category end -->
                            <!-- single category -->
                            <div class="flex items-center">
                                <input type="checkbox" id="Sofa"
                                       class="text-primary focus:ring-0 rounded-sm cursor-pointer">
                                <label for="Sofa" class="text-gray-600 ml-3 cursor-pointer">Sofa</label>
                                <div class="ml-auto text-gray-600 text-sm">(05)</div>
                            </div>
                            <!-- single category end -->
                            <!-- single category -->
                            <div class="flex items-center">
                                <input type="checkbox" id="Office"
                                       class="text-primary focus:ring-0 rounded-sm cursor-pointer">
                                <label for="Office" class="text-gray-600 ml-3 cursor-pointer">Office</label>
                                <div class="ml-auto text-gray-600 text-sm">(09)</div>
                            </div>
                            <!-- single category end -->
                            <!-- single category -->
                            <div class="flex items-center">
                                <input type="checkbox" id="Outdoor"
                                       class="text-primary focus:ring-0 rounded-sm cursor-pointer">
                                <label for="Outdoor" class="text-gray-600 ml-3 cursor-pointer">Outdoor</label>
                                <div class="ml-auto text-gray-600 text-sm">(19)</div>
                            </div>
                            <!-- single category end -->
                        </div>
                    </div>
                    <!-- category filter end -->
                    <!-- brand filter -->
                    <div class="pt-4">
                        <h3 class="text-xl text-gray-800 mb-3 uppercase font-medium">Brands</h3>
                        <div class="space-y-2">
                            <!-- single brand name -->
                            <div class="flex items-center">
                                <input type="checkbox" id="Dominik"
                                       class="text-primary focus:ring-0 rounded-sm cursor-pointer">
                                <label for="Dominik" class="text-gray-600 ml-3 cursor-pointer">Dominik</label>
                                <div class="ml-auto text-gray-600 text-sm">(15)</div>
                            </div>
                            <!-- single brand name end -->
                            <!-- single brand name -->
                            <div class="flex items-center">
                                <input type="checkbox" id="Karl"
                                       class="text-primary focus:ring-0 rounded-sm cursor-pointer">
                                <label for="Karl" class="text-gray-600 ml-3 cursor-pointer">Karl</label>
                                <div class="ml-auto text-gray-600 text-sm">(18)</div>
                            </div>
                            <!-- single brand name end -->
                            <!-- single brand name -->
                            <div class="flex items-center">
                                <input type="checkbox" id="Maxing"
                                       class="text-primary focus:ring-0 rounded-sm cursor-pointer">
                                <label for="Maxing" class="text-gray-600 ml-3 cursor-pointer">Maxing</label>
                                <div class="ml-auto text-gray-600 text-sm">(09)</div>
                            </div>
                            <!-- single brand name end -->
                            <!-- single brand name -->
                            <div class="flex items-center">
                                <input type="checkbox" id="Ernest"
                                       class="text-primary focus:ring-0 rounded-sm cursor-pointer">
                                <label for="Ernest" class="text-gray-600 ml-3 cursor-pointer">Ernest</label>
                                <div class="ml-auto text-gray-600 text-sm">(12)</div>
                            </div>
                            <!-- single brand name end -->
                        </div>
                    </div>
                    <!-- brand filter end -->
                    <!-- price filter -->
                    <div class="pt-4">
                        <h3 class="text-xl text-gray-800 mb-3 uppercase font-medium">Price</h3>
                        <div class="mt-4 flex items-center">
                            <input type="text"
                                   class="w-full border-gray-300 focus:ring-0 focus:border-primary px-3 py-1 text-gray-600 text-sm shadow-sm rounded"
                                   placeholder="min">
                            <span class="mx-3 text-gray-500">-</span>
                            <input type="text"
                                   class="w-full border-gray-300 focus:ring-0 focus:border-primary px-3 py-1 text-gray-600 text-sm shadow-sm rounded"
                                   placeholder="mix">
                        </div>
                    </div>
                    <!-- price filter end -->
                    <!-- size filter -->
                    <div class="pt-4">
                        <h3 class="text-xl text-gray-800 mb-3 uppercase font-medium">size</h3>
                        <div class="flex items-center gap-2">
                            <!-- single size -->
                            <div class="size-selector">
                                <input type="radio" name="size" class="hidden" id="size-xs">
                                <label for="size-xs"
                                       class="text-xs border border-gray-200 rounded-sm h-6 w-6 flex items-center justify-center cursor-pointer shadow-sm text-gray-600">
                                    XS
                                </label>
                            </div>
                            <!-- single size end -->
                            <!-- single size -->
                            <div class="size-selector">
                                <input type="radio" name="size" class="hidden" id="size-s">
                                <label for="size-s"
                                       class="text-xs border border-gray-200 rounded-sm h-6 w-6 flex items-center justify-center cursor-pointer shadow-sm text-gray-600">
                                    S
                                </label>
                            </div>
                            <!-- single size end -->
                            <!-- single size -->
                            <div class="size-selector">
                                <input type="radio" name="size" class="hidden" id="size-m" checked>
                                <label for="size-m"
                                       class="text-xs border border-gray-200 rounded-sm h-6 w-6 flex items-center justify-center cursor-pointer shadow-sm text-gray-600">
                                    M
                                </label>
                            </div>
                            <!-- single size end -->
                            <!-- single size -->
                            <div class="size-selector">
                                <input type="radio" name="size" class="hidden" id="size-l">
                                <label for="size-l"
                                       class="text-xs border border-gray-200 rounded-sm h-6 w-6 flex items-center justify-center cursor-pointer shadow-sm text-gray-600">
                                    L
                                </label>
                            </div>
                            <!-- single size end -->
                            <!-- single size -->
                            <div class="size-selector">
                                <input type="radio" name="size" class="hidden" id="size-xl">
                                <label for="size-xl"
                                       class="text-xs border border-gray-200 rounded-sm h-6 w-6 flex items-center justify-center cursor-pointer shadow-sm text-gray-600">
                                    XL
                                </label>
                            </div>
                            <!-- single size end -->
                        </div>
                    </div>
                    <!-- size filter end -->
                    <!-- color filter -->
                    <div class="pt-4">
                        <h3 class="text-xl text-gray-800 mb-3 uppercase font-medium">color</h3>
                        <div class="flex items-center gap-2">
                            <!-- single color -->
                            <div class="color-selector">
                                <input type="radio" name="color" class="hidden" id="color-red" checked>
                                <label for="color-red" style="background-color : #fc3d57"
                                       class="text-xs border border-gray-200 rounded-sm h-5 w-5 flex items-center justify-center cursor-pointer shadow-sm">
                                </label>
                            </div>
                            <!-- single color end -->
                            <!-- single color -->
                            <div class="color-selector">
                                <input type="radio" name="color" class="hidden" id="color-white">
                                <label for="color-white" style="background-color : #fff"
                                       class="text-xs border border-gray-200 rounded-sm h-5 w-5 flex items-center justify-center cursor-pointer shadow-sm">
                                </label>
                            </div>
                            <!-- single color end -->
                            <!-- single color -->
                            <div class="color-selector">
                                <input type="radio" name="color" class="hidden" id="color-black">
                                <label for="color-black" style="background-color : #000"
                                       class="text-xs border border-gray-200 rounded-sm h-5 w-5 flex items-center justify-center cursor-pointer shadow-sm">
                                </label>
                            </div>
                            <!-- single color end -->
                        </div>
                    </div>
                    <!-- color filter end -->
                </div>
            </div>
            <!-- sidebar end -->

            <!-- products -->
            <div class="col-span-3">
                <!-- sorting -->
                <div class="mb-4 flex items-center">
                    <button @click="showFilter =! showFilter"
                    class="bg-primary border border-primary text-white px-10 py-3 font-medium rounded uppercase hover:bg-transparent hover:text-primary transition lg:hidden text-sm mr-3 focus:outline-none">
                    Filter
                    </button>
                </div>
                <!-- sorting end -->
                <!-- product wrapper -->
                <div class="grid lg:grid-cols-4 md:grid-cols-3 grid-cols-2 lg:gap-4 md:gap-3 gap-2">
                    <!-- single product -->
                    <template v-for="i in [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12]">
                        <product :i="i" />
                    </template>
                    <!-- single product end -->
                </div>
                <!-- product wrapper end -->
            </div>
            <!-- products end -->
        </div>
        <!-- products wrapper end -->
    </app-layout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout";
import Product from "@/Components/Site/Product";
import Breadcrumb from "@/Components/Site/Breadcrumb";

export default {
    name: "Products",
    components: {
        AppLayout,
        Breadcrumb,
        Product,
    },
    data() {
        return {
            showFilter: false,
        };
    },
}
</script>
