<template>
    <app-layout>
        <!-- breadcrumb -->
        <breadcrumb :items="[{title: 'Products', link: route('products')}, {title: 'Italian L Shape Sofa'}]" />
        <!-- breadcrumb end -->

        <!-- product view -->
        <div class="container pt-4 pb-6 grid lg:grid-cols-2 gap-6">
            <!-- product image -->
            <div>
                <div>
                    <img id="main-img" src="/images/products/product9.jpg" class="w-full">
                </div>
                <div class="grid grid-cols-5 gap-4 mt-4">
                    <div>
                        <img src="/images/products/product9.jpg" class="single-img w-full cursor-pointer border border-primary">
                    </div>
                    <div>
                        <img src="/images/products/product1.jpg" class="single-img w-full cursor-pointer border">
                    </div>
                    <div>
                        <img src="/images/products/product8.jpg" class="single-img w-full cursor-pointer border">
                    </div>
                    <div>
                        <img src="/images/products/product12.jpg" class="single-img w-full cursor-pointer border">
                    </div>
                    <div>
                        <img src="/images/products/product11.jpg" class="single-img w-full cursor-pointer border">
                    </div>
                </div>
            </div>
            <!-- product image end -->
            <!-- product content -->
            <div>
                <h2 class="md:text-3xl text-2xl font-medium uppercase mb-2">Italian L Shape Sofa</h2>
                <div class="space-y-2">
                    <p class="text-gray-800 font-semibold space-x-2">
                        <span>Availability: </span>
                        <span class="text-green-600">In Stock</span>
                    </p>
                    <p class="space-x-2">
                        <span class="text-gray-800 font-semibold">Brand: </span>
                        <span class="text-gray-600">Apex</span>
                    </p>
                    <p class="space-x-2">
                        <span class="text-gray-800 font-semibold">Category: </span>
                        <span class="text-gray-600">Sofa</span>
                    </p>
                    <p class="space-x-2">
                        <span class="text-gray-800 font-semibold">SKU: </span>
                        <span class="text-gray-600">BE45VGRT</span>
                    </p>
                </div>
                <div class="mt-4 flex items-baseline gap-3">
                    <span class="text-primary font-semibold text-xl">$450.00</span>
                    <span class="text-gray-500 text-base line-through">$500.00</span>
                </div>
                <p class="mt-4 text-gray-600">
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Enim exercitationem quaerat excepturi
                    labore blanditiis
                </p>
                <!-- size -->
                <div class="mt-4">
                    <h3 class="text-base text-gray-800 mb-1">Size</h3>
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
                <!-- size end -->
                <!-- color -->
                <div class="mt-4">
                    <h3 class="text-base text-gray-800 mb-1">Color</h3>
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
                <!-- color end -->
                <!-- quantity -->
                <div class="mt-4">
                    <h3 class="text-base text-gray-800 mb-1">Quantity</h3>
                    <div class="flex border border-gray-300 text-gray-600 divide-x divide-gray-300 w-max">
                        <div class="h-8 w-8 text-xl flex items-center justify-center cursor-pointer select-none">-</div>
                        <div class="h-8 w-10 flex items-center justify-center">4</div>
                        <div class="h-8 w-8 text-xl flex items-center justify-center cursor-pointer select-none">+</div>
                    </div>
                </div>
                <!-- color end -->
                <!-- add to cart button -->
                <div class="flex gap-3 border-b border-gray-200 pb-5 mt-6">
                    <a href="#" class="bg-primary border border-primary text-white px-8 py-2 font-medium rounded uppercase hover:bg-transparent hover:text-primary transition text-sm flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24">
                            <path fill="none" d="M0 0h24v24H0z"/>
                            <path fill="currentColor" d="M4 6.414L.757 3.172l1.415-1.415L5.414 5h15.242a1 1 0 0 1 .958 1.287l-2.4 8a1 1 0 0 1-.958.713H6v2h11v2H5a1 1 0 0 1-1-1V6.414zM6 7v6h11.512l1.8-6H6zm-.5 16a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zm12 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3z"/>
                        </svg>
                        <span class="font-semibold ml-1">Add To Cart</span>
                    </a>
                </div>
                <!-- add to cart button end -->
            </div>
            <!-- product content end -->
        </div>
        <!-- product view end -->

        <!-- product details and review -->
        <div class="container pb-16">
            <!-- detail buttons -->
            <h3 class="border-b border-gray-200 font-roboto text-gray-800 pb-3 font-medium">
                Product Details
            </h3>
            <!-- details button end -->

            <!-- details content -->
            <div class="lg:w-4/5 xl:w-3/5 pt-6">
                <div class="space-y-3 text-gray-600">
                    <p>
                        Incredible graphics performanceMacBook Air can take on more graphics-intensive projects than
                        ever. For the first time, content creators can edit and seamlessly play back multiple streams of
                        full‑quality 4K video without dropping a frame.
                    </p>
                    <p>
                        Incredible graphics performanceMacBook Air can take on more graphics-intensive projects than
                        ever. For the first time, content creators can edit and seamlessly play back multiple streams of
                        full‑quality 4K video without dropping a frame.
                    </p>
                    <p>
                        Apps on MacBook Air can use machine learning (ML) to automatically retouch photos like a pro,
                        make smart tools such as magic wands and audio filters more accurate at auto‑detection, and so
                        much more. That’s not just brain power — that’s the power of a full stack of ML technologies.
                    </p>
                </div>
                <!-- details table -->
                <table class="table-auto border-collapse w-full text-left text-gray-600 text-sm mt-6">
                    <tr>
                        <th class="py-2 px-4 border border-gray-300 w-40 font-medium">Color</th>
                        <td class="py-2 px-4 border border-gray-300">Black, Brown, Red</td>
                    </tr>
                    <tr>
                        <th class="py-2 px-4 border border-gray-300 w-40 font-medium">Material</th>
                        <td class="py-2 px-4 border border-gray-300">Artificial Leather</td>
                    </tr>
                    <tr>
                        <th class="py-2 px-4 border border-gray-300 w-40 font-medium">Weight</th>
                        <td class="py-2 px-4 border border-gray-300">55kg</td>
                    </tr>
                </table>
                <!-- details table -->
            </div>
            <!-- details content end -->
        </div>
        <!-- product details and review end -->

        <!-- related products -->
        <div class="container pb-16">
            <h2 class="text-xl md:text-2xl font-medium font-roboto text-gray-800 uppercase mb-6">Related Products</h2>
            <!-- product wrapper -->
            <div class="grid lg:grid-cols-6 sm:grid-cols-3 grid-cols-2 lg:gap-6 md:gap-4 gap-2">
                <!-- single product -->
                <template v-for="i in [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12]">
                    <product :i="i" />
                </template>
                <!-- single product end -->
            </div>
            <!-- product wrapper end -->
        </div>
        <!-- related products end -->
    </app-layout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout";
import Product from "@/Components/Site/Product";
import Breadcrumb from "@/Components/Site/Breadcrumb";

export default {
    name: "Show",
    components: {
        AppLayout,
        Breadcrumb,
        Product,
    }
}
</script>
