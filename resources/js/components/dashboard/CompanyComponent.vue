<template>
  <v-app id="inspire">
    <user-panel></user-panel>
    <div class="card-body">
      <v-container grid-list-md text-xs-center>
        <menu-company-component
          v-bind:company="company"
        ></menu-company-component>
      </v-container>
    </div>
  </v-app>
</template>

<script>
import { SSL_OP_SSLREF2_REUSE_CERT_TYPE_BUG } from "constants";
import { METHODS } from 'http';
export default {
  data: function() {
    return {
      company: {
        name:'',
        logo:'',
        id:'',
      },
      
      items: [
      ], 
      id:null,
    };
  },

  mounted() {
    this.id=this.$route.params.id;
    //console.log(this.company);
    api.call("get", "/api/get-company/"+this.id).then((resp) => {
      this.company = resp.data.company;
      //console.log(this.company)
      this.id=this.company.id
    }).catch(response=>{
      //console.log(response)
    });
    this.items= [
        { title: "К выбору компаний", icon: "mdi-home-city",route:"/"},
        { title: "Настройки компании", icon: "mdi-account",route:"company/update/"+this.id },
        { title: "Структура компании", icon: "mdi-account-group-outline",route:"/" }
      ]
    //console.log(this.company)
  },
  methods:{
    getCompanyId:function(){
      return this.company.id 
    }
  }
  
};
</script>
