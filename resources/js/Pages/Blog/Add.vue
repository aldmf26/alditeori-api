<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { router, Head, useForm } from '@inertiajs/vue3';
import Button from '../../Components/Button.vue';
import { quillEditor } from 'vue3-quill'
import { computed, ref } from 'vue'

// const content = ref('');

const form = useForm({
    judul: null,
    img_heading: null,
    content: null
})
const loading = ref(false)

const submit = () => {
    loading.value = true
    router.post('/blog/add', form)
};
const tampilan = ref(false)
const error = ref('')

const validateImageUrl = () => {
    const urlRegex = /^(ftp|http|https):\/\/[^ "]+$/;
    if (form.img_heading.trim() === '') {
        error.value = 'Field is required.';
    } else if (!urlRegex.test(form.img_heading)) {
        error.value = 'Invalid URL.';
    } else {
        error.value = '';
    }
}


defineProps({ user: Object, title: String })
const isFormValid = computed(() => {
    return form.judul && form.judul.length > 0 &&
        form.img_heading && form.img_heading.length > 0 &&
        form.content && form.content.length > 0 &&
        !error.value;
});

</script>

<template>

    <Head title="Blog" />

    <AuthenticatedLayout>
        <template #header>
            <div class="flex items-center mb-10 ">
                <Button :href="route('blog.index')" title="">
                    <svg class="mr-2" width="25px" height="25px" viewBox="0 0 32 32" version="1.1"
                        xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                        xmlns:sketch="http://www.bohemiancoding.com/sketch/ns">

                        <title>arrow-left-square</title>
                        <desc>Created with Sketch Beta.</desc>
                        <defs>

                        </defs>
                        <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"
                            sketch:type="MSPage">
                            <g id="Icon-Set" sketch:type="MSLayerGroup" transform="translate(-412.000000, -983.000000)"
                                fill="#000000">
                                <path
                                    d="M434,998 L423.414,998 L427.535,993.879 C427.926,993.488 427.926,992.855 427.535,992.465 C427.145,992.074 426.512,992.074 426.121,992.465 L420.465,998.121 C420.225,998.361 420.15,998.689 420.205,999 C420.15,999.311 420.225,999.639 420.465,999.879 L426.121,1005.54 C426.512,1005.93 427.145,1005.93 427.535,1005.54 C427.926,1005.15 427.926,1004.51 427.535,1004.12 L423.414,1000 L434,1000 C434.553,1000 435,999.553 435,999 C435,998.448 434.553,998 434,998 L434,998 Z M442,1011 C442,1012.1 441.104,1013 440,1013 L416,1013 C414.896,1013 414,1012.1 414,1011 L414,987 C414,985.896 414.896,985 416,985 L440,985 C441.104,985 442,985.896 442,987 L442,1011 L442,1011 Z M440,983 L416,983 C413.791,983 412,984.791 412,987 L412,1011 C412,1013.21 413.791,1015 416,1015 L440,1015 C442.209,1015 444,1013.21 444,1011 L444,987 C444,984.791 442.209,983 440,983 L440,983 Z"
                                    id="arrow-left-square" sketch:type="MSShapeGroup">

                                </path>
                            </g>
                        </g>
                    </svg>
                </Button>

                <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">{{ title }}</h2>

            </div>
            <!-- <span class="cursor-pointer bg-cyan-500 p-3 text-white" @click="tampilan = !tampilan">{{tampilan ? 'Edit HTML code' : 'Teks Editor'}}</span> -->
            <form @submit.prevent="form.post('/blog/add')" class="mt-5">
                <div class="grid grid-cols-2 w-1/4 gap-y-5 mb-5">
                    <label for="">Judul</label>
                    <input v-model="form.judul" required class="w-96 rounded-lg" type="text" placeholder="judul">
                    <label for="">Gambar Utama</label>
                    <div>
                        <input v-model="form.img_heading"
                            :class="error ? 'text-red-500 border-lg  focus:outline-red-500' : ''"
                            @input="validateImageUrl" required type="text" class="w-96 rounded-lg"
                            placeholder="link gambar">
                        <span v-if="error" style="color: red;">{{ error }}</span>
                    </div>

                </div>
                <span class="text-yellow-500 text-lg"><em>Untuk gambar konten menggunakan link saja, klik icon paling
                        ujung disebelah icon gambar !</em></span>
                <quill-editor v-model:value="form.content" />
                <!-- <div v-else>
                    <textarea class="bg-gray-800 w-full text-gray-300 font-mono text-sm leading-5 p-2"
                        v-model="form.content"></textarea>
                </div> -->
                <!-- <input type="text" v-model="form.judul">
                <div v-if="form.errors.judul">{{ form.errors.judul }}</div> -->
                <div role="status" class="mt-4" v-show="loading">
                    <svg aria-hidden="true" class="w-8 h-8 text-gray-200 animate-spin dark:text-gray-600 fill-blue-600"
                        viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
                            fill="currentColor" />
                        <path
                            d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
                            fill="currentFill" />
                    </svg>
                    <span class="sr-only">Loading...</span>
                </div>
                <Button href="#" @click="submit" class="mt-5" title="Simpan" v-show="isFormValid && !loading">
                    <svg class="mr-3" width="25px" height="25px" viewBox="0 0 24 24" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path d="M8.5 12.5L10.5 14.5L15.5 9.5" stroke="#1C274C" stroke-width="1.5"
                            stroke-linecap="round" stroke-linejoin="round" />
                        <path
                            d="M22 12C22 16.714 22 19.0711 20.5355 20.5355C19.0711 22 16.714 22 12 22C7.28595 22 4.92893 22 3.46447 20.5355C2 19.0711 2 16.714 2 12C2 7.28595 2 4.92893 3.46447 3.46447C4.92893 2 7.28595 2 12 2C16.714 2 19.0711 2 20.5355 3.46447C21.5093 4.43821 21.8356 5.80655 21.9449 8"
                            stroke="#1C274C" stroke-width="1.5" stroke-linecap="round" />
                    </svg>
                </Button>
            </form>
            <div>


            </div>
        </template>


    </AuthenticatedLayout>
</template>
