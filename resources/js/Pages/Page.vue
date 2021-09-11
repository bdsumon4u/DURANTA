<template>
    <app-layout>
        <div class="py-12 container">
            <div class="p-8 my-4 bg-white rounded-lg shadow">
                <div v-if="page.content_en && page.content_bn" class="flex justify-center mb-2 md:justify-end">
                    <button @click.prevent="lang = 'en'" class="hover:bg-gray-400 px-2" :class="{'bg-black text-white rounded': lang === 'en'}">EN</button>
                    <button @click.prevent="lang = 'bn'" class="hover:bg-gray-200 px-2" :class="{'bg-black text-white rounded': lang === 'bn'}">BN</button>
                </div>
                <h1 class="text-3xl font-semibold mb-4 text-center text-gray-700">{{ page.title }}</h1>
                <div v-show="lang === 'en'" v-html="page.content_en"></div>
                <div v-show="lang === 'bn'" v-html="page.content_bn"></div>
            </div>
        </div>
    </app-layout>
</template>

<script>
import AppLayout from "../Layouts/AppLayout";

export default {
    name: "Page",
    props: ['page'],
    components: {
        AppLayout,
    },
    data() {
        return {
            lang: !!this.page.content_en ? 'en' : 'bn',
        }
    }
}
</script>
