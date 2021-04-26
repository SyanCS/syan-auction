<template>
  <v-container
    id="regular-forms"
    fluid
    tag="section"
  >
    <v-row>
      <v-col cols="12">
        <base-material-card
          color="primary"
          icon="mdi-gavel"
          inline
          class="px-5 py-3 ml-0"
        >
          <template v-slot:after-heading>
            <div class="display-2 font-weight-light">
              {{item.name}}
            </div>
          </template>
          
            <v-alert
              v-if="item.status != 'EXPIRED'"
              border="bottom"
              color="light-blue lighten-2"
              type="info"
              class="ma-3"
              style="min-width: 200px; position: absolute; top: 0; right:0;"
            >
              {{item.countdown}}
            </v-alert>

            <v-alert
              v-else
              border="bottom"
              color="red lighten-2"
              type="warning"
              class="ma-3"
              style="min-width: 200px; position: absolute; top: 0; right:0;"
            >
              Expired
            </v-alert>

          <v-row class="mt-10">
            <v-col
              cols="5"
              class="text-center"
            >
              <v-card
                class="mx-auto mt-0 d-inline-flex v-card--account"
                outlined
                max-height="300"
                max-width="300"
              >
                <v-img
                  :src="imgURL"
                  height="100%"
                  width="100%"
                />                
              </v-card>
            </v-col>
            <v-col
              cols="1"
            >
            </v-col>
            <v-col
              cols="auto"
              style="min-width: 200px;"
              class="ml-20"
            >
              <v-text-field
                v-model="item.name"
                color="primary"
                label="Item Name"
                filled
                readonly
              />

              <v-textarea
                outlined
                rows="5"
                cols="50"
                label="Description"
                filled
                :value="item.descr"
              />

              <v-text-field
                v-model="minimumAuctionBid"
                color="primary"
                label="Current Bid"
                filled
                readonly
              />
            </v-col>
          </v-row>
          <v-row>
            <v-col v-if="item.status != 'EXPIRED'"
              cols="6"
            >
              <v-checkbox
                v-model="autoBidCheckBox"
                @change="toggleAutoBid()"
                label="Activate Auto Bid"
              />
            </v-col>
            <v-col cols="6" v-if="item.status != 'EXPIRED'">
              <template v-if="highestBid && loggedUser.id == highestBid.user_id">
                <v-alert
                  border="bottom"
                  color="green"
                  type="success"
                  class="ma-3"
                  max-width="400"
                >
                  Your bid is the HIGHEST for this item!
                </v-alert>
              </template>
              <template v-else>
                <validation-observer v-slot="{ handleSubmit }">
                  <v-form class="pt-1" @submit.prevent="handleSubmit(makeBid)" >
                    <v-row>
                      <v-col cols="3">
                        <validation-provider
                          v-slot="{ errors }"
                          name="bid"
                          rules="required"
                        >
                          <v-text-field
                            v-model="bid"
                            :error-messages="errors"
                            color="secondary"
                            type="number"
                            width="100px"
                            label="Place Your Bid"
                          />
                        </validation-provider>
                      </v-col>
                      <v-col cols="6">
                        <v-btn
                          color="success"
                          min-width="100"
                          type="submit"
                        >
                          Bid Now
                        </v-btn>
                      </v-col>
                    </v-row>
                  </v-form>
                </validation-observer>
              </template>
            </v-col>
          </v-row>
        </base-material-card>
      </v-col>
    </v-row>
  </v-container>
</template>

<script>
  import BidsService from '@/services/BidsService'
  import AuctionItemsService from '@/services/AuctionItemsService'
  import AutoBidsItems from '@/services/AutoBidsItems'
  import dayjs from 'dayjs'

  export default {
    name: 'ViewAuctionItem',

    components: { 

    },

    data: () => ({
      item:{},
      bid: null,
      highestBid: null,
      autoBidCheckBox: false,
    }),

    mounted () {
      if(this.$route.params.id){
        this.getItem(this.$route.params.id)
      }
      this.getItemHighestBid(this.$route.params.id)
      this.getAutoBidCheckBox()
    },

    computed: {
      imgURL() {
        if(this.item.image){
          return "http://localhost:8765/auction_items/"+this.item.image
        }
      },
      minimumAuctionBid() {
        if(this.highestBid){
          return this.highestBid.amount
        }
        return this.item.minimum_bid
      },
      loggedUser() {
        return JSON.parse(localStorage.getItem('user'))
      }
    },

    watch: {
      item(newValue) {
        this.bindCountdown(newValue)
      }
    },

    methods: {

      toggleAutoBid() {
        if(this.autoBidCheckBox){
          AutoBidsItems.save(this.$route.params.id)
          .then((response) => {
            if(response.data.message == "Erro"){
              throw 500
            }
            this.$toast.success('Auto Bid Active.', '',{position:'topRight'})
          })
          .catch(error => {
            console.log(error)
            this.$toast.error('Error.', '',{position:'topRight'})
          })
        }else{
          AutoBidsItems.delete(this.$route.params.id)
          .then((response) => {
            if(response.data.message == "Erro"){
              throw 500
            }
            this.$toast.success('Auto Bid Removed.', '',{position:'topRight'})
          })
          .catch(error => {
            console.log(error)
            this.$toast.error('Error.', '',{position:'topRight'})
          })
        }
      },

      getAutoBidCheckBox() {
        AutoBidsItems.getLoggedUserItemAutoBid(this.$route.params.id)
        .then((response) => {
          if(response.data.autoBidItem){
             this.autoBidCheckBox = true
          }
        })
        .catch(error => {
          console.log(error)
          this.$toast.error('Error.', '',{position:'topRight'})
        })
      },

      makeBid() {
        
        if (parseInt(this.bid) <= parseInt(this.minimumAuctionBid)){
          this.$toast.error('Invalid Bid.', '',{position:'topRight'})
          return false
        }

        BidsService.bid(this.bid,this.$route.params.id)
        .then((response) => {
          if(response.data.message == "Erro"){
            throw 500
          }
          this.$toast.success('Sucess.', '',{position:'topRight'})

          this.getItem(this.$route.params.id)
          this.getItemHighestBid(this.$route.params.id)
        })
        .catch(error => {
          console.log(error)
          this.$toast.error('Error.', '',{position:'topRight'})
        })
      },

      getItem(id) {
        AuctionItemsService.getItem(id)
        .then(response => {
          this.item = response.data.auctionItem
        })
        .catch(error => {
          console.log(error)
          this.$toast.error('Error retrieving Auction Item.', '',{position:'topRight'})
        })
      },

      getItemHighestBid(id) {
        BidsService.getItemHighestBid(id)
        .then(response => {
          if(response.data.bid){
            console.log(response.data.bid)
            this.highestBid = response.data.bid
          }
        })
        .catch(error => {
          console.log(error)
          this.$toast.error('Error retrieving item highest bid.', '',{position:'topRight'})
        })
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
    },
  }
</script>