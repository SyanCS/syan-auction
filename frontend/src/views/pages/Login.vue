<template>
  <v-container
    id="login"
    class="fill-height justify-center"
    tag="section"
  >
    <v-row justify="center">
      <v-slide-y-transition appear>
        <base-material-card
          color="success"
          light
          max-width="100%"
          width="400"
          class="px-5 py-3"
        >
          <template v-slot:heading>
            <div class="text-center">
              <h1 class="display-2 font-weight-bold mb-2">
                Login
              </h1>
            </div>
          </template>

          <v-card-text class="text-center">
            <v-text-field
              color="secondary"
              label="Email..."
              prepend-icon="mdi-email"
              v-model="email"
            />

            <v-text-field
              class="mb-8"
              color="secondary"
              label="Password..."
              type="password"
              prepend-icon="mdi-lock-outline"
              v-model="password"
            />

            <pages-btn
              large
              color=""
              depressed
              class="v-btn--text success--text"
              @click="authentication()"
            >
              Entrar
            </pages-btn>
          </v-card-text>
        </base-material-card>
      </v-slide-y-transition>
    </v-row>
  </v-container>
</template>

<script>

  import APIService from '@/services/APIService.js'
  import UsersService from '@/services/UsersService.js'

  export default {
    name: 'PagesLogin',

    components: {
      PagesBtn: () => import('./components/Btn'),
    },

    data: () => ({
      email: '',
      password: ''
    }),
    methods: {
      authentication () {
        return UsersService.authentication(this.email,this.password)
        .then(response => {
          localStorage.setItem('user', JSON.stringify(response.data.user))
          localStorage.setItem('jwt', response.data.token)

          if (localStorage.getItem('jwt') != null) {
            this.$router.push('/')
            //this.$router.push('/')
          } else {
            return false
          }
        })
        .catch(error => {
          console.log('There was an error:', error.response) // Logs out the error
          return false
        })
      },
    },
  }
</script>
