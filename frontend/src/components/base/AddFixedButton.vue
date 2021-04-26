<template>
  
  <v-fab-transition>
    <v-btn
      color="green"
      dark
      fixed
      bottom
      right
      fab
      style="margin-bottom: 4.5rem"
      @click="$emit('clicked')"
    >
      <v-icon>mdi-plus</v-icon>
    </v-btn>
  </v-fab-transition>

</template>


<script>

  export default {
    name: 'AddFixedButton',

    props: {
    },
    
  }
</script>
