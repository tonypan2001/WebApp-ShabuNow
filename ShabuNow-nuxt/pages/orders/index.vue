<template>
    <MainContainer>
        <HeaderContainer>
            <HeaderText>
                คำสั่งซื้อของลูกค้า
            </HeaderText>
        </HeaderContainer>
        <hr>
        <ContentContainer>
            <div class="mt-4 flex justify-center items-center w-full">
                <InputField placeholder="ใส่จำนวนโต๊ะทั้งหมด" type="tableNumber" name="tableNumber"/>
                <Button class="py-3 ml-2">
                    ยืนยัน
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
export default {
    data() {
        return {
            tableNumbers: []
        }
    },
    created() {
        this.tableNumbers = this.tableNumbersGen(21)
    },
    methods: {
        tableNumbersGen(count) {
            const tableNumbers = []
            for(let i = 1; i<= count; i++) {
                tableNumbers.push(i);
            }
            return tableNumbers
        }
    }
}
</script>