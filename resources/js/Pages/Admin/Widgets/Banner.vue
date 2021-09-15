<template>
    <div class="border-l-2 border-purple-600 overflow-hidden duration-500 transition-all">
        <div class="flex p-3 pt-1">
            <form class="w-full">
                <div class="flex flex-wrap">
                    <div class="pb-2 px-4 bg-white border shadow-md relative rounded-md w-full">
                        <ImagePicker name="image" :value="image" @pick="file => image = file" />
                    </div>
                </div>
                <div class="flex flex-wrap">
                    <div class="pt-7 pb-2 px-4 bg-white border shadow-md relative rounded-md w-full mt-5">
                        <h2 class="flex bg-white border py-1 px-2 rounded-md absolute left-0 -top-3">
                            <label class="text-sm font-bold" for="link">Link</label>
                        </h2>
                        <input id="link" name="link" v-model="link" class="block w-full px-2 py-1 border rounded-md text-gray-700 bg-gray-100 appearance-none focus:outline-none focus:bg-gray-200 focus:shadow-inner" />
                    </div>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
import ImagePicker from "@/Components/ImagePicker";

export default {
    name: "Banner",
    props: ['element', 'index'],
    components: {
        ImagePicker,
    },
    data() {
        return {
            ...this.element,
        }
    },
    watch: {
        image: function(curr, old) {
            this.$emit('widget', {
                index: this.index,
                data: {
                    image: curr,
                },
            });
        },
        link: function(curr, old) {
            this.$emit('widget', {
                index: this.index,
                data: {
                    link: curr,
                },
            });
        },
    }
}
</script>
