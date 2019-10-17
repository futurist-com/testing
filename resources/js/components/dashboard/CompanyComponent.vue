<template>
  <v-app id="inspire">
    <v-container>
      <user-panel></user-panel>
      <v-container grid-list-md text-xs-center>
        <div>
          <v-navigation-drawer app clipped>
            <v-list>
              <v-list-item>
                <v-list-item-action>
                  <v-icon>mdi-{{ 1 }}</v-icon>
                </v-list-item-action>
                <v-list-item-content>
                  <v-list-item-title>Page {{ 1 }}</v-list-item-title>
                </v-list-item-content>
              </v-list-item>
            </v-list>
          </v-navigation-drawer>

          <v-app-bar app clipped-left>
            <v-toolbar-title>App Bar</v-toolbar-title>
          </v-app-bar>
          <v-content>
            <v-container fluid>
              <v-fade-transition mode="out-in">
                <router-view></router-view>
              </v-fade-transition>
            </v-container>
          </v-content>
        </div>
      </v-container>
    </v-container>
  </v-app>
</template>

<script>
import { SSL_OP_SSLREF2_REUSE_CERT_TYPE_BUG } from "constants";
export default {
  data: function() {
    return {
      company: $route.params.id
    };
  },

  mounted() {
    api.call("get", "/api/get-company").then(({ data }) => {
      this.companies = data;
    });
  }
};
</script>
