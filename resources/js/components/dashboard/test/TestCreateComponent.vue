<template>
  <v-app id="inspire">
    <user-panel></user-panel>
    <div class="card-body mt-10">
      <v-container grid-list-md text-xs-center>
        <menu-company-component v-bind:comp="company"></menu-company-component>
      </v-container>
    </div>
  </v-app>
</template>

<script>
import MenuCompanyComponentVue from "../MenuCompanyComponent";
import { mapGetters, mapActions } from "vuex";export default {
  data: function() {
    return {
      id: null,
      company: {}
    };
  },
  computed:mapGetters(['currentCompany']),
  created() {
     //this.$store.dispatch('getCurrentCompany', this.$route.params.id)
     //this.getCompanyId()
      },
  methods: {
    
  }
};
</script>
