<script>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
import { Head } from '@inertiajs/inertia-vue3';
import { Inertia } from "@inertiajs/inertia";
    export default {
        components:{
            BreezeAuthenticatedLayout,Head,Inertia
        },
        props: {
            products: Object,
        },
        methods : {
            productAdd(productId,userId) {
                Inertia.post(
                    route("productStore", {
                        product_id: productId,
                        created_by: userId
                    })
                );
            },
        }
    }
</script>

<template>
    <Head title="Dashboard" ></Head>

    <BreezeAuthenticatedLayout>
        <div class="bg-white">
            <div class="max-w-2xl mx-auto py-10 px-4  sm:px-6 lg:max-w-7xl lg:px-8">
                <h2 class="text-2xl font-extrabold tracking-tight text-gray-900">All Product's</h2>
                <div class="mt-6 grid grid-cols-1 gap-y-10 gap-x-6 sm:grid-cols-2 lg:grid-cols-4 xl:gap-x-8">
                    <div v-for="(product,index) in products"  :key="item-`${index}`" class="group relative">
                        <div class="w-full min-h-80 bg-gray-200 aspect-w-1 aspect-h-1 rounded-md overflow-hidden group-hover:opacity-75 lg:h-80 lg:aspect-none">
                            <img :src="product.imageSrc" alt="productimageAlt" class="w-full h-full object-center object-cover lg:w-full lg:h-full" />
                        </div>
                        <div class="mt-4 flex justify-between">
                            <div>
                                <h3 class="text-sm text-gray-700">
                                    <!--<span aria-hidden="true" class="absolute inset-0" />-->
                                    {{ product.name }}
                                </h3>
                                <p class="mt-1 text-sm text-gray-500">{{ product.description }}</p>
                            </div>
                            <p class="text-sm font-medium text-gray-900">{{ product.price }}</p>
                        </div>
                        <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
                                 @click="productAdd(product.id,$page.props.auth.user.id)">Add
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </BreezeAuthenticatedLayout>
</template>
