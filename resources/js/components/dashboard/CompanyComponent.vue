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
import { SSL_OP_SSLREF2_REUSE_CERT_TYPE_BUG } from "constants";
import { METHODS } from "http";
import MenuCompanyComponentVue from "./MenuCompanyComponent.vue";
export default {
  data: function() {
    return {
      id: null,
      company: {}
    };
  },
  created() {
     this.getCompanyId()
    //console.log(this.company)

    /*this.id = this.$route.params.id;
    //console.log(this.id);
    api
      .call("get", "/api/get-company/" + this.id)
      .then(resp => {
        //this.company = resp.data.company;
        //this.id=this.company.id
        Vue.set(this, 'comp', resp.data.company)
        //console.log(this.company)
        //console.log(this.company);
        //this.id = this.company.id;
      })
      .catch(response => {
        //console.log(response)
      });
     */
    //this.getCompanyId()
  },
  /*beforeMount(){
   
    
     console.log(this.company)
  },
  */
  methods: {
    getCompanyId: function() {
      var id = this.$route.params.id;
      api
        .call("get", "/api/get-company/" + id)
        .then(resp => {
          this.company = resp.data.company;
          //console.log(this.company)
        })
        .catch(response => {
          //console.log(response)
        });
    }
  }/*,
  computed: {
    companyProps: {
      get: function() {
        return this.company;
      }
    }
  }*/
};
</script>
