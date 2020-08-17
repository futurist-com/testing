<template>
  <v-app id="inspire">
    <user-panel></user-panel>
    <div class="card-body mt-10">
      <v-container grid-list-md text-xs-center>
        <v-row>
          <menu-company-component v-bind:comp="company"></menu-company-component>
          <v-col class="align-left justify-center">
          <slot/>  
          </v-col>
        </v-row>
      </v-container>
    </div>
    <footer-panel></footer-panel>
  </v-app>
</template>

<script>
//import MenuCompanyComponentVue from "../MenuCompanyComponent";
import { mapGetters, mapActions } from "vuex";
export default {
  name:'company-layout',
  data: function() {
    return {
      company:null,
         }
  },
  computed: mapGetters(["currentCompany"]),
  mounted() {
    if (!this.currentCompany.id){
      this.company= localStorage.getItem('company')
    }else{
      this.company=this.currentCompany.id
    }
  },
  methods: {
    
  }
};
</script>
