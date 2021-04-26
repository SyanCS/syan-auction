<template>
  <v-container
    id="dashboard"
    tag="section"
    fluid
  >
    <v-row  dense class="mt-n5">
      <v-col sm="12">
        <items-data-table :items="items" />
      </v-col>
    </v-row>
  </v-container>
</template>

<script>


  import AuctionItemsService from '@/services/AuctionItemsService'

  export default {
    name: 'Home',
    components: {
      ItemsDataTable: () => import('@/components/items/ItemsDataTable')
    },

    data () {
      return {
        items: []
      }
    },

    mounted () {
      this.getItems();
    },

    computed: {
      
    },

    methods: {
      getItems(id) {
        AuctionItemsService.getAllItems()
        .then(response => {
          this.items = response.data.auctionItems
        })
        .catch(error => {
          console.log(error)
          this.$toast.error('Error retrieving auction items.', '',{position:'topRight'})
        })
      },
    },
  }
</script>
