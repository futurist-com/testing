<template>
  <v-app id="inspire">
    <v-container>
      <user-panel></user-panel>

      <v-content>
        <v-container fluid fill-height>
          <v-row justify="center">
            <v-col cols="12" md="6">
              <h3>Редактирование компании</h3>
              <v-form v-model="valid" ref="form" lazy-validation>
                <v-text-field
                  prepend-icon
                  name="name"
                  label="Название компании"
                  type="text"
                  v-model="company.name"
                  :rules="nameRules"
                  required
                ></v-text-field>
                <v-textarea
                  name="description"
                  label="Описание компании"
                  hint="Описание компании"
                  v-model="company.description"
                  id="description"
                ></v-textarea>
              </v-form>

              <v-list-item-avatar size="128">
                <v-img  :src="company.logo"></v-img>
              </v-list-item-avatar>
              <v-file-input accept="image/*" label="Загрузите логотип"></v-file-input>
              <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn v-on:click="updateCompany" color="primary" :disabled="!valid">Сохранить</v-btn>
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
      company: {},
      valid: true,
      name: "",
      description: "",
      logo: "",
      nameRules: [
        v => !!v || "Поле не может быть пустым",
        v => (v && v.length <= 100) || "Поле больше 100 символов."
      ]
    };
  },
  mounted() {
    let access_token = Vue.cookie.get("XSRF-TOKEN");
    this.getCompany();
  },
  methods: {
    getCompany: function() {
      let id = this.$route.params.id;
      api.call("get", `api/get-company/` + id).then(data => {
        this.company = data.data.company;
        console.log(this.company);
      });
    },
    updateCompany: function() {
      let data = {
        name: this.company.name,
        description: this.company.description
      };
      let id = this.$route.params.id
      if (this.$refs.form.validate()) {
        api.call("put", `/api/company/`+id, data).then(({ data }) => {
          this.$router.push("/dashboard");
        });
      }
    },

  }
};
</script>
