<template>
  <v-container grid-list-md text-xs-center>
    <div>
      <v-layout row wrap class="mt-2">
        <v-flex xs1>
          
          <v-btn class="mx-2" fab dark color="indigo">
            
            <router-link to="/add-company"><v-icon dark>add</v-icon></router-link>
            </v-btn>
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
export default {
  data: function() {
    return {
      companies: null
    };
  },

  mounted() {
    //console.log("Component mounted.");
    api.call("get", "/api/get-company").then(({ data }) => {
      //console.log(data);
      this.companies = data;
      console.log(this.companies);
    });
    /*axios
      .get("/api/get-company")
      .then(resp => {
        //console.log(resp);
        this.companies = resp.data;
      })
      .catch(({ response }) => {
      });*/
  }
};
</script>
