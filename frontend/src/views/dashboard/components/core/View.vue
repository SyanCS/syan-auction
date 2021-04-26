<template>
  <v-content>
    <router-view id="content-wrap" />

    <dashboard-core-footer
      id="dashboard-core-footer"
    />
  </v-content>
</template>

<script>
  export default {
    name: 'DashboardCoreView',

    components: {
      DashboardCoreFooter: () => import('./Footer'),
    },
  }
</script>

<style scoped>
  #dashboard-core-footer {
    position: absolute;
    bottom: 0;
    width: 100%;
    height: 5rem;
  }
  #content-wrap {
    padding-bottom: 5rem;    /* Footer height */
  }  
</style>
