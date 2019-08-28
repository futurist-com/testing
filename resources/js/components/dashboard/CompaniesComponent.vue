<template>
  <v-container grid-list-md text-xs-center>
    <div>
      <v-layout row wrap class="mt-6">
        <v-flex xs1>
          <v-tooltip bottom>
            <template v-slot:activator="{ on }">
              <v-btn v-on="on" class="mx-2" fab color="primary" light>
                <router-link to="/add-company" light><v-icon light>add</v-icon></router-link>
              </v-btn>
            </template>
            <span>В компании вы можете создавать тесты и назначать их для проверки тестируемых.
            </span>
            
          </v-tooltip>
        </v-flex>
      </v-layout>
      <v-layout row wrap class="mt-2">
        <v-flex sm4 v-for="company in companies" key="company.id">
          <v-card>
            <v-card-title>{{company.name}}</v-card-title>
            <v-card-text>{{company.description}}</v-card-text>
            <v-card-actions>
              <v-btn text>Войти</v-btn>
            </v-card-actions>
          </v-card>
        </v-flex>
      </v-layout>
    </div>
  </v-container>
</template>

<script>
import { SSL_OP_SSLREF2_REUSE_CERT_TYPE_BUG } from "constants";
export default {
  data: function() {
    return {
      companies: null
    };
  },

  mounted() {
    api.call("get", "/api/get-company").then(({ data }) => {
      this.companies = data;
    });
  }
};
</script>
