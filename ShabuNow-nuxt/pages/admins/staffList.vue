<template>
<MainContainer>
  <HeaderContainer>
    <HeaderText>
      รายชื่อพนักงานสตาฟ
    </HeaderText>
  </HeaderContainer>
  <hr>
  <ContentContainer>
    <!-- Staff List -->
    <Table :datas="tableData" :headers="tableHeaders" class="mt-8">
      <template v-slot:title>
        พนักงานสตาฟทั้งหมด
      </template>
    </Table>
      
  </ContentContainer>
</MainContainer>
</template>

<script>
export default {
  data() {
    return {
      // add some datas to table
      tableHeaders: [
        'Name',
        'Status',
      ],
      // add table headers
      tableData: [
        ['Prompan Uechanwech', 'Active'],
        ['Prompan Uechanwech', 'Active'],
        ['Prompan Uechanwech', 'Active'],
        ['Prompan Uechanwech', 'Active'],
        ['Prompan Uechanwech', 'Active'],
      ],
    }
  }
}
</script>
