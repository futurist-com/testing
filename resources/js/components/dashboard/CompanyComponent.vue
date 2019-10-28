<template>
  <v-app id="inspire">
    <user-panel></user-panel>
    <div class="card-body">
      <v-container grid-list-md text-xs-center>
        <div>
          <v-layout row wrap class="mt-10">
            <v-row>
              <v-card>
                <v-navigation-drawer v-model="drawer" :mini-variant.sync="mini" permanent>
                  <v-list-item>
                    <v-list-item-avatar>
                      <v-img v-if="company.logo!=''" :src="company.logo"></v-img>
                      <v-img v-else src="/public/img/no_image.jpeg"></v-img>
                      <img src="/public/img/no_images.png">
                    </v-list-item-avatar>
                    
                    <v-list-item-title>{{company.name}}</v-list-item-title>

                    <v-btn icon @click.stop="mini = !mini">
                      <v-icon>mdi-chevron-left</v-icon>
                    </v-btn>
                  </v-list-item>

                  <v-divider></v-divider>

                  <v-list dense>
                    <v-list-item  link>
                      <v-list-item-icon>
                        <v-icon>mdi-home-city</v-icon>
                      </v-list-item-icon>
                      <v-list-item-content>
                        <v-list-item-title><router-link to="/dashboard">К выбору компании </router-link></v-list-item-title>
                      </v-list-item-content>
                    </v-list-item>
                    <v-list-item  link>
                      <v-list-item-icon>
                        <v-icon>mdi-account</v-icon>
                      </v-list-item-icon>
                      <v-list-item-content>
                        <v-list-item-title><router-link :to="`/company/update/${company.id}`">Изменить компанию</router-link></v-list-item-title>
                      </v-list-item-content>
                    </v-list-item>
                  </v-list>
                </v-navigation-drawer>
              </v-card>
            </v-row>
          </v-layout>
        </div>
      </v-container>
    </div>
  </v-app>
</template>

<script>
import { SSL_OP_SSLREF2_REUSE_CERT_TYPE_BUG } from "constants";
export default {
  data: function() {
    return {
      company: {
        name:'',
        logo:''
      },
      drawer: true,
      mini: true,
      items: [
        { title: "К выбору компаний", icon: "mdi-home-city" },
        { title: "Настройки компании", icon: "mdi-account" },
        { title: "Структура компании", icon: "mdi-account-group-outline" }
      ], 
      id:null,
    };
  },

  mounted() {
    this.id=this.$route.params.id;
    //console.log(this.company);
    api.call("get", "/api/get-company/"+this.id).then((resp) => {
      this.company = resp.data.company;
      console.log(this.company)
    }).catch(response=>{
      //console.log(response)
    });
    //console.log(this.company)
  }
};
</script>
