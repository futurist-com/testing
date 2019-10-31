<template>
  <div>
    <v-layout row wrap class="mt-10">
      <v-row>
        <v-card>
          <v-navigation-drawer v-model="drawer" :mini-variant.sync="mini" permanent>
            <v-list-item>
              <v-list-item-avatar>
                <v-img v-if="company.logo!=''" :src="company.logo"></v-img>
              </v-list-item-avatar>

              <v-list-item-title>{{company.name}}</v-list-item-title>

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
      </v-row>
    </v-layout>
  </div>
</template>

<script>
export default {
  props:['company'],
  data: function() {
    return {
        drawer: true,
      mini: true,
      items: [],
    };
  },
  mounted() {
     this.items= [
        { title: "К выбору компаний", icon: "mdi-home-city",route:"/"},
        { title: "Настройки компании", icon: "mdi-account",route:"company/update/"+this.id },
        { title: "Структура компании", icon: "mdi-account-group-outline",route:"/" }
      ]
      console.log(this.company);
  }
};
</script>
