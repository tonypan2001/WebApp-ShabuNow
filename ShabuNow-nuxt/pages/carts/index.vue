<template>
    <MainContainer>
        <HeaderContainer>
            <HeaderText>
                ตะกร้าสินค้า
            </HeaderText>
        </HeaderContainer>
        <hr>
        <ContentContainer>
            <!-- Ordered List -->
            <CartListCard v-for="order in orders" :imageUrl="order.imageUrl">

                <div v-slot:cart_menu>
                    {{ order.name }}
                </div>
                <div v-slot:cart_price>
                    {{ order.id }}
                </div>
            </CartListCard>

            <!-- Total Price -->
            <TotalPrice>

                <div class="flex justify-center items-center">
                    <h1 class="text-2xl text-gray-700 mr-2">รวมการสั่งซื้อ:</h1>
                    <span id="original_price" class="text-red-600 font-semibold text-3xl ease-linear duration-150">฿ 500</span>
                </div>



                <hr>
                <!-- Add menu button -->
                <Button class="mt-8 py-4 w-full md:w-auto">
                <i class="bi bi-plus-lg mr-1"></i>
                    เพิ่มเมนูอาหาร
                </Button>

            </TotalPrice>

        </ContentContainer>
    </MainContainer>
</template>

<script setup lang="ts">
import CartListCard from '../../components/CartListCard.vue'

export default {
    components: {
        CartListCard
    },
    // data() {
    //     return {
    //         foods: [
    //             {
    //                 imageUrl: 'https://img.freepik.com/free-photo/delicious-vietnamese-food-including-pho-ga-noodles-spring-rolls-white-wall_181624-34158.jpg?w=1480&t=st=1694914784~exp=1694915384~hmac=28ce6696273496ac0f862aacccb0f3fcf9bb4b466ea118dc34c9bc3aaac883b0',
    //                 title: 'Salad',
    //                 price: '75'
    //             },
    //             {
    //                 imageUrl: 'https://img.freepik.com/free-photo/fried-pork-with-garlic-pepper-served-with-rice-fried-egg_1150-27374.jpg?w=1480&t=st=1694917028~exp=1694917628~hmac=817a4137204b388d2caebdb1832e665b25d9137da1a062d8ac87461377696e95',
    //                 title: 'Fried Pork Rice',
    //                 price: '85'
    //             },
    //             {
    //                 imageUrl: 'https://img.freepik.com/free-photo/fried-chicken-parts-fusilli-white-plate_114579-72409.jpg?w=1480&t=st=1694919254~exp=1694919854~hmac=42c4ec7371dcd64d7efcd793238b259b333273cb049d67c36d4a4b26a29294a7',
    //                 title: 'Pasta and Chicken',
    //                 price: '125'
    //             },
    //             {
    //                 imageUrl: 'https://img.freepik.com/free-photo/stir-fried-instant-noodles-with-seafood-variety-vegetable_1150-27317.jpg?w=740&t=st=1694933851~exp=1694934451~hmac=a4574fd32652c87e0203d95bf152a23675fcca588220cc5edd22b30321a3eef4',
    //                 title: 'Spaghetti',
    //                 price: '145'
    //             },
    //         ]
    //     }
    // },
}

const { data: orders, pending } = await useMyFetch<any>("order", {})

</script>