<template>
    <div class="border-l-2 border-purple-600 duration-500 transition-all">
        <div class="flex p-3 pt-1">
            <form class="w-full">
                <div class="flex flex-wrap justify-between">
                    <div class="pt-7 pb-2 px-2 -mx-1 bg-white border shadow-md relative rounded-md w-full lg:w-1/2 mt-5">
                        <h2 class="flex bg-white border py-1 px-2 rounded-md absolute left-0 -top-3">
                            <label class="text-sm font-bold" for="brands">Brands</label>
                        </h2>
                        <Multiselect id="brands" v-model="selected.brands" :options="selectable.brands" mode="multiple" searchable openDirection="top" valueProp="id" label="name" trackBy="name" placeholder="Brands" />
                    </div>
                    <div class="pt-7 pb-2 px-2 -mx-1 bg-white border shadow-md relative rounded-md w-full lg:w-1/2 mt-5">
                        <h2 class="flex bg-white border py-1 px-2 rounded-md absolute left-0 -top-3">
                            <label class="text-sm font-bold" for="categories">Categories</label>
                        </h2>
                        <Multiselect id="categories" v-model="selected.categories" :options="selectable.categories" mode="multiple" searchable openDirection="top" valueProp="id" label="name" trackBy="name" placeholder="Categories" />
                    </div>
                    <div class="pt-7 pb-2 px-2 -mx-1 bg-white border shadow-md relative rounded-md w-full lg:w-1/2 mt-5">
                        <h2 class="flex bg-white border py-1 px-2 rounded-md absolute left-0 -top-3">
                            <label class="text-sm font-bold" for="number-of-products">Number Of Products</label>
                        </h2>
                        <input id="number-of-products" name="number_of_products" v-model="number_of_products" class="block w-full px-2 py-1 border rounded-md text-gray-700 bg-gray-100 appearance-none focus:outline-none focus:bg-gray-200 focus:shadow-inner" />
                    </div>
                    <div class="pt-7 pb-2 px-2 -mx-1 bg-white border shadow-md relative rounded-md w-full lg:w-1/2 mt-5">
                        <h2 class="flex bg-white border py-1 px-2 rounded-md absolute left-0 -top-3">
                            <label class="text-sm font-bold" for="ordering">Ordering</label>
                        </h2>
                        <div class="w-full flex bg-white rounded rounded-l-none">
                            <div class="w-1/2 radio-uc inline-flex rounded-lg">
                                <input
                                    v-model="ordering"
                                    type="radio"
                                    value="latest"
                                    id="order-latest"
                                    name="ordering"
                                    checked="checked"
                                    class="hidden"
                                />
                                <label
                                    for="order-latest"
                                    class="w-full text-center self-center text-black py-1 px-2 rounded-lg cursor-pointer hover:opacity-75">
                                    Latest
                                </label>
                            </div>
                            <div class="w-1/2 radio-uc inline-flex rounded-lg">
                                <input
                                    v-model="ordering"
                                    type="radio"
                                    value="random"
                                    name="ordering"
                                    id="order-random"
                                    class="hidden"
                                />
                                <label
                                    for="order-random"
                                    class="w-full text-center self-center text-black py-1 px-2 rounded-lg cursor-pointer hover:opacity-75">
                                    Random
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
import Multiselect from "@vueform/multiselect";

export default {
    name: "Products",
    props: ['element', 'index', 'selectable'],
    components: {
        Multiselect,
    },
    data() {
        return {
            selected: {
                brands: this.element.brands.split(','),
                categories: this.element.categories.split(','),
            },
            ...this.element,
        }
    },
    watch: {
        'selected.brands': function(curr, old) {
            this.$emit('widget', {
                index: this.index,
                data: {
                    brands: curr.join(),
                },
            });
        },
        'selected.categories': function(curr, old) {
            this.$emit('widget', {
                index: this.index,
                data: {
                    categories: curr.join(),
                },
            });
        },
        number_of_products: function(curr, old) {
            this.$emit('widget', {
                index: this.index,
                data: {
                    number_of_products: curr,
                },
            });
        },
        ordering: function(curr, old) {
            this.$emit('widget', {
                index: this.index,
                data: {
                    ordering: curr,
                },
            });
        },
    },
}
</script>

<style scoped>
@import "~@vueform/multiselect/themes/default.css";

.radio-uc input[type=radio]:checked~label {
    background-color: #171717;
    color: white;
}
</style>
