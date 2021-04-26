<template>
  <v-app-bar
    id="app-bar"
    absolute
    app
    color="transparent"
    flat
    height="75"
  >

    <v-dialog v-model="dialogAutoBid" max-width="290">
      <v-card>
        <v-card-title class="headline">Configure Auto Bid</v-card-title>
        <v-card-text>
          <v-container>
            <v-row>
              <v-form>
                <v-text-field
                  v-model="autoBidAmount"
                  color="secondary"
                  type="number"
                  label="Auto Bid Amount"
                />
              </v-form>
            </v-row>
          </v-container>
        </v-card-text>
        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn color="green darken-1" text @click="dialog = false">Close</v-btn>
          <v-btn color="green darken-1" @click="saveAutoBid()">Confirm</v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>

    <v-btn
      class="mr-3"
      elevation="1"
      fab
      small
      @click="$vuetify.breakpoint.smAndDown ? setDrawer(!drawer) : $emit('input', !value)"
    >
      <v-icon v-if="value">
        mdi-view-quilt
      </v-icon>

      <v-icon v-else>
        mdi-dots-vertical
      </v-icon>
    </v-btn>

    <v-toolbar-title
      class="hidden-sm-and-down font-weight-light"
      v-text="$route.name"
    />

    <v-spacer />

    <v-menu
      bottom
      left
      offset-y
      origin="top right"
      transition="scale-transition"
    >
      <template v-slot:activator="{ attrs, on }">
        <v-btn
          class="ml-2"
          min-width="0"
          text
          v-bind="attrs"
          v-on="on"
        >
          <v-badge
            color="red"
            overlap
            bordered
          >
            <template v-slot:badge>
              <span>{{notifications.length}}</span>
            </template>

            <v-icon>mdi-bell</v-icon>
          </v-badge>
        </v-btn>
      </template>

      <v-list
        :tile="false"
        nav
      >
        <div>
          <app-bar-item
            v-for="(n, i) in notifications"
            :key="`item-${i}`"
          >
            <v-list-item-title v-text="n" />
          </app-bar-item>
        </div>
      </v-list>
    </v-menu>
     <v-menu
      bottom
      left
      min-width="200"
      offset-y
      origin="top right"
      transition="scale-transition"
    >
      <template v-slot:activator="{ attrs, on }">
        <v-btn
          class="ml-2"
          min-width="0"
          text
          v-bind="attrs"
          v-on="on"
        >
          <v-icon>mdi-cog</v-icon>
        </v-btn>
      </template>

      <v-list
        :tile="false"
        flat
        nav
      >
        <app-bar-item
        >
          <v-list-item-title @click="openDialog()"> Configure Auto Bid </v-list-item-title>
        </app-bar-item>
      </v-list>
    </v-menu>
  </v-app-bar>
</template>

<script>
  // Components
  import { VHover, VListItem } from 'vuetify/lib'

  // Utilities
  import { mapState, mapMutations } from 'vuex'
  import AutoBidsService from '@/services/AutoBidsService'

  export default {
    name: 'DashboardCoreAppBar',

    components: {
      AppBarItem: {
        render (h) {
          return h(VHover, {
            scopedSlots: {
              default: ({ hover }) => {
                return h(VListItem, {
                  attrs: this.$attrs,
                  class: {
                    'black--text': !hover,
                    'white--text secondary elevation-12': hover,
                  },
                  props: {
                    activeClass: '',
                    dark: hover,
                    link: true,
                    ...this.$attrs,
                  },
                }, this.$slots.default)
              },
            },
          })
        },
      },
    },

    props: {
      value: {
        type: Boolean,
        default: false,
      },
    },

    data: () => ({
      notifications: [
        'Someone did a higher bid in the Item #20',
        'Congragulations! You are the winner of the item #3',
        'Attention, your wallet is low in cash '
      ],
      dialogAutoBid: false,
      autoBidAmount: null
    }),

    computed: {
      ...mapState(['drawer']),
    },

    mounted(){
      this.getUserAutoBid()
    },

    methods: {
      ...mapMutations({
        setDrawer: 'SET_DRAWER',
      }),
      openDialog () {
        this.dialogAutoBid = true
      },
      saveAutoBid() {
        AutoBidsService.saveAutoBidAmount(this.autoBidAmount)
        .then((response) => {
          if(response.data.message == "Erro"){
            throw 500
          }
          this.$toast.success('Auto bid amount configured.', '',{position:'topRight'})
        })
        .catch(error => {
          console.log(error)
          this.$toast.error('Error.', '',{position:'topRight'})
        })
      },
      getUserAutoBid() {
        AutoBidsService.getUserAutoBid(JSON.parse(localStorage.getItem('user')).id)
        .then((response) => {
          if(response.data.message == "Erro"){
            throw 500
          }
          this.autoBidAmount = response.data.autoBid.amount
        })
        .catch(error => {
          console.log(error)
          this.$toast.error('Error retrieving user auto bid.', '',{position:'topRight'})
        })
      },
    },
  }
</script>
