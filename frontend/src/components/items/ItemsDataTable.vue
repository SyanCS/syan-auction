<template>
  <v-container
    id="data-tables"
    tag="section"
  >
    <base-material-card
      color="primary"
      icon="mdi-gavel"
      inline
      class="px-5 py-3 ml-0"
    >
      <template v-slot:after-heading>
        <div class="display-2 font-weight-light">
          Auction Items
        </div>
      </template>

      <v-text-field
        v-model="search"
        append-icon="mdi-magnify"
        class="ml-auto"
        label="Search"
        hide-details
        single-line
        style="max-width: 250px;"
      />

      <v-divider class="mt-10" />
  
      <v-data-table 
        :headers="headers"
        :items="items"
        :search.sync="search"
        :page.sync="page"
      >

        <template v-slot:item="row">
          <tr>
            <td class="button">{{row.item.id}}</td>
            <td class="button">{{row.item.name}}</td>
            <td class="button">{{row.item.descr}}</td>
            <td class="button">{{"$ "+row.item.minimum_bid}}</td>
            <td class="button">{{formatEnding(row.item.ending)}}</td>
            <td v-if="row.item.countdown" class="button">{{row.item.countdown}}</td>
            <td v-else class="button">
                <v-progress-circular
                  indeterminate
                  color="black"
                ></v-progress-circular>
            </td>
            
            <td id="actions" width="200px">
              <v-btn
                class="ma-2"
                color="success"
                @click="bidNow(row.item.id)"
              >
                BID NOW
              </v-btn>
            </td>

          </tr>
        </template>
      </v-data-table>
    </base-material-card>
  </v-container>
</template>

<script>

  import dayjs from 'dayjs'

  export default {
    name: 'ItemsDataTable',

    props: {
      items: {
        type: Array,
        default: () => [],
      },
    },

    data: () => ({
      page: 1,
      search: undefined,
      headers: [
        {
          text: '#',
          value: 'id',
        },
        {
          text: 'Name',
          value: 'name',
        },
        {
          text: 'Description',
          value: 'descr',
        },
        {
          text: 'Started Bid',
          value: 'minimum_bid',
        },
        {
          text: 'Auction Ending',
          value: 'ending',
        },
        {
          text: 'Countdown',
          value: 'ending',
        },
        {
          sortable: false,
          text: 'Actions',
          value: 'actions',
        },
      ],
    }),

    computed: {

    },

    watch: {
      items(newValue) {
        newValue.forEach(element => {
          this.bindCountdown(element)
        })
      }
    },

    methods: {
      bidNow (id) {
        this.$router.push('/auction-items/view/'+id)
      },
      formatEnding (date) {
        return dayjs(date).format('YYYY-MM-DD H:mm:ss')
      },
      bindCountdown (element){
        setInterval(() => {
          var now = dayjs();
          var countDownDate = dayjs(element.ending);
          var distance = countDownDate - now;
          
          if (distance <= 0) {
            this.$set(element, 'countdown', "Expired")
            return
          }

          var days = Math.floor(distance / (1000 * 60 * 60 * 24));
          var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
          var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
          var seconds = Math.floor((distance % (1000 * 60)) / 1000);
            
          this.$set(element, 'countdown', days+" Days "+ hours.toString().padStart(2,'0')+":"+minutes.toString().padStart(2,'0')+":"+seconds.toString().padStart(2,'0'))

        }, 1000);
      },
    }

  }
</script>

<style scoped>
  .v-data-table td{
    padding: 12px 8px !important;
  }
  
  td#actions{
    padding-left: 0px !important;
  }
</style>