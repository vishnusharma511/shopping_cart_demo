<script>
    import { ref } from 'vue'
    import { Dialog, DialogPanel, DialogTitle, TransitionChild, TransitionRoot } from '@headlessui/vue'
    import { XIcon } from '@heroicons/vue/outline'
    import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
    import { Head } from '@inertiajs/inertia-vue3';
    import { Inertia } from "@inertiajs/inertia";

    const products = [
        {
            id: 1,
            name: 'Throwback Hip Bag',
            href: '#',
            color: 'Salmon',
            price: '$90.00',
            quantity: 1,
            imageSrc: 'https://tailwindui.com/img/ecommerce-images/shopping-cart-page-04-product-01.jpg',
            imageAlt: 'Salmon orange fabric pouch with match zipper, gray zipper pull, and adjustable hip belt.',
        },
        {
            id: 2,
            name: 'Medium Stuff Satchel',
            href: '#',
            color: 'Blue',
            price: '$32.00',
            quantity: 1,
            imageSrc: 'https://tailwindui.com/img/ecommerce-images/shopping-cart-page-04-product-02.jpg',
            imageAlt:
                'Front of satchel with blue canvas body, black straps and handle, drawstring top, and front zipper pouch.',
        },
        // More products...
    ];

    const open = ref(true)
    export default {
        components:{
            BreezeAuthenticatedLayout,Inertia,Head
        },
        props: {
            cart: Object,
            total:Object
        },
        methods : {
            productDelete(productId,userId) {
                Inertia.post(
                    route("productRemove", {
                        product_id: productId,
                        created_by: userId
                    })
                );
            },
            productCount(productId,userId) {
                console.log(productId);
                console.log(userId);
                Inertia.post(
                    route("addNumber", {
                        product_id: productId,
                        created_by: userId,
                        quantity:document.getElementById("count").valueOf().value
                    })
                );
            },
        }
    }
</script>

<template>
    <Head title="Cart" ></Head>

    <BreezeAuthenticatedLayout>
        <div class="bg-white">
            <div class="max-w-2xl mx-auto py-10 px-4  sm:px-6 lg:max-w-7xl lg:px-8">
                <h2 class="text-2xl font-extrabold tracking-tight text-gray-900">Cart</h2>
                <div class="mt-8 relative overflow-x-auto shadow-md sm:rounded-lg">
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                Image
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Product name
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Price
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Action
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(product,index) in cart"  :key="cart1-`${index}`" class="odd:bg-white even:bg-gray-50 odd:dark:bg-gray-800 even:dark:bg-gray-700">
                                <th scope="row" class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap">
                                    <img :src="product.imageSrc" alt="product-image" class="inline-block h-12 w-12 rounded-full ring-2 ring-white" />
                                </th>
                                <td class="px-6 py-4">{{ product.name }}</td>
                                <td class="px-6 py-4">${{ product.price }} X {{ product.prod_card.quantity }}</td>
                                <select class="custom-input pr-8" id="count" name="count" @change="productCount(product.id,$page.props.auth.user.id)">
                                    <option :value=1>1</option>
                                    <option :value=2>2</option>
                                    <option :value=3>3</option>
                                    <option :value=4>4</option>
                                    <option :value=5>5</option>
                                </select>
                                <button class="inline-block bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
                                        @click="productDelete(product.id,$page.props.auth.user.id)">Delete
                                </button>
                            </tr>

                            <tr class="bg-slate-700">
                                <th scope="row" class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap"></th>
                                <td class="px-6 py-4 text-white">Total</td>
                                <td class="px-6 py-4 text-white">${{ total }}</td>
                                <td class="px-6 py-4 text-white"></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </BreezeAuthenticatedLayout>
</template>