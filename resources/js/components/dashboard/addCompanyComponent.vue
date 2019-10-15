<template>
  <v-app id="inspire">
    <v-container>
      <user-panel></user-panel>

      <v-content>
        <v-container fluid fill-height>
          <v-row  justify="center">
            <v-col cols="12" md="6">
              <h3>Создание компании</h3>
              <v-form v-model="valid" ref="form" lazy-validation>
                <v-text-field
                  prepend-icon
                  name="name"
                  label="Название компании"
                  type="text"
                  v-model="name"
                  required
                ></v-text-field>
                <v-textarea
                  name="description"
                  label="Описание компании"
                  
                  hint="Hint text"
                  v-model="description"
                  id="description"
                ></v-textarea>
              </v-form>

              <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn v-on:click="createCompany" color="primary" :disabled="!valid">Создать</v-btn>
              </v-card-actions>
            </v-col>
          </v-row>
        </v-container>
      </v-content>

      <footer-panel></footer-panel>
    </v-container>
  </v-app>
</template>

<script>
export default {
  data: function() {
    return {
      valid: true,
      name: "",
      description: "",
      nameRules: [v => !!v || "Поле не может быть пустым"]
    };
  },
  mounted() {
    let access_token = Vue.cookie.get("XSRF-TOKEN");
  },
  methods: {
    createCompany: function() {
      let data = {
        name: this.name,
        description: this.description
      };
      if (this.$refs.form.validate()) {
        api.call("post", "/api/add-company", data).then(({ data }) => {
            this.$router.push("/dashboard");
        });
      }
    }
  }
};
</script>
