<template>
  <div id="menu-company">
        <v-card>
          <v-navigation-drawer v-model="drawer" :mini-variant.sync="mini" permanent>
            <v-list-item>
              <v-list-item-avatar>
                <!--<v-img v-if="comp.logo!=''" :src="comp.logo"></v-img>-->
              </v-list-item-avatar>

              <v-list-item-title>{{currentCompany.name}}</v-list-item-title>
              
              <v-btn icon @click.stop="mini = !mini">
                <v-icon>mdi-chevron-left</v-icon>
              </v-btn>
            </v-list-item>

            <v-divider></v-divider>

            <v-list dense>
              <v-list-item
                v-for="(item, index) in items"
                v-bind:data="item"
                v-bind:key="index"
                link
              >
                <v-list-item-icon>
                  <v-icon>{{item.icon}}</v-icon>
                </v-list-item-icon>
                <v-list-item-content>
                  <v-list-item-title>
                    <router-link :to="`${item.route}`">{{item.title}}</router-link>
                  </v-list-item-title>
                </v-list-item-content>
              </v-list-item>
            </v-list>
          </v-navigation-drawer>
        </v-card>
      
  </div>
</template>

<script>
import { mapGetters, mapActions } from "vuex";
export default {
  //props: ["comp"],
  /*model: {
    prop: "comp"
  },*/
  data: function() {
    return {
      drawer: true,
      mini: false,
      items: [],
      comp:null,
    };
  },
  computed:{
    ...mapGetters(['currentCompany'])
    
  },
  mounted() {
    //this.comp=this.currentCompany
    //console.log(this.currentCompany.id)
    if (!this.currentCompany.id){
      let companyId= localStorage.getItem('company')
      this.$store.dispatch("getCurrentCompany", companyId)
    }else{
      this.company=this.currentCompany.id
    }
    //console.log(this.company);
    this.items = [
      { title: "К выбору компаний", icon: "mdi-home-city", route: "/dashboard" },
      {
        title: "Настройки компании",
        icon: "mdi-account",
        route: "/company/update"
      },
      {
        title: "Структура компании",
        icon: "mdi-account-group-outline",
        route: "/"
      },
      {
        title: "Тесты(доступыне)",
        icon: "mdi-account-group-outline",
        route: "/"
      },
      {
        title: "Создать тест",
        icon: "mdi-account-group-outline",
        route: "/company/create-test"
      }
    ];
  
  },
  
  /*computed: {
    company: {
      set: function() {
        return this.comp
      }
    }
  }*/
};
</script>
<style>

</style>