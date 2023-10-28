<template>
    <MainContainer>
        <HeaderContainer>
            <HeaderText>
                คำสั่งซื้อของลูกค้า
            </HeaderText>
        </HeaderContainer>
        <hr>
        <ContentContainer>

            <h1 class="mt-4 text-xl text-red-600 font-medium">จำนวนโต๊ะทั้งหมด : {{ counter.count }}</h1>
            <!-- Add table and Delete table-->
            <div class="mt-4 flex justify-center items-center w-full">
                <Button @click="incrementTable" class="py-3 ml-2">
                    <i class="bi bi-plus-circle text-xl mr-2"></i>
                    เพิ่มโต๊ะ
                </Button>
                <Button @click="decrementTable" class="py-3 ml-2">
                    <i class="bi bi-dash-circle text-xl mr-2"></i>
                    ลดโต๊ะ
                </Button>
            </div>

            <GridContainer class="mt-8">

                <!-- หมายเลขโต๊ะ -->
               <GraphicsTable :tableNumbers="tableNumbers"/>

            </GridContainer>

        </ContentContainer>
    </MainContainer>
</template>

<script>
import { reactive } from 'vue';

export default {
    data() {
        return {
            tableNumbers: [],
            counter: reactive({count:0}),
        }
    },
    created() {
        this.tableNumbers = this.tableNumbersGen(this.counter.count)
    },
    methods: {
        tableNumbersGen(count) {
            const tableNumbers = []
            for(let i = 1; i<= count; i++) {
                tableNumbers.push(i);
            }
            return tableNumbers
        },
        incrementTable() {
            // console.log("inc : " + this.counter.count)
            // console.log("inc : " + this.tableNumbers.length)
            this.counter.count++
            this.tableNumbers.push(this.tableNumbers.length + 1)
        },
        decrementTable() {
            if (this.tableNumbers.length > 0) {
                // console.log("dec : " + this.counter.count)
                // console.log("dec : " + this.tableNumbers.length)
                this.counter.count--
                this.tableNumbers.pop()
            }
        }
    }


}
</script>