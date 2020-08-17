<template>
  <v-col class="align-centr justify-center">
    <v-row class="align-centr justify-center">
      <v-col cols="12" md="6">
        <h3>Редактирование компании</h3>
        <v-form>
          <v-text-field
            prepend-icon
            name="name"
            label="Название компании"
            type="text"
            v-model="currentCompany.name"
            required
          ></v-text-field>
          <v-textarea
            name="description"
            label="Описание компании"
            hint="Описание компании"
            v-model="currentCompany.description"
            id="description"
          ></v-textarea>
        </v-form>
        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn v-on:click="updateCompany" color="primary">Сохранить</v-btn>
        </v-card-actions>
      </v-col>
    </v-row>
  </v-col>
</template>

<script>
import { mapGetters, mapActions } from "vuex";
export default {
  data: function() {
    return {
      company: {},
      //valid: true,
      //name: this.currentCompany.name,
      //description: this.currentCompany.description,
      logo: ""
      /*nameRules: [
        v => !!v || "Поле не может быть пустым",
        v => (v && v.length <= 100) || "Поле больше 100 символов."
      ]*/
    };
  },
  computed: {
    ...mapGetters(["currentCompany"])
  },
  watch: {
    /*currentCompany: function() {
      this.name = currentCompany.name;
      this.description = currentCompany.name;
    }*/
  },
  mounted() {
    let access_token = Vue.cookie.get("XSRF-TOKEN");
    //this.getCompany();
  },
  methods: {
    getCompany: function() {
      let id = this.currentCompany.id;
      api.call("get", `api/get-company/` + id).then(data => {
        this.company = data.data.company;
        this.name = this.company.name;
        this.description = this.company.description;
        //console.log(this.company);
      });
    },
    updateCompany: function() {
      let data = {
        name: this.currentCompany.name,
        description: this.currentCompany.description
      };
      let id = this.currentCompany.id;
      //if (this.$refs.form.validate()) {
      api.call("put", `/api/company/` + id, data).then(({ data }) => {
        this.$router.push("/dashboard");
      });
      //}
    },
    onUpload: function(event) {
      console.log(event);
      let fd = new FormData();
      fd.append("image", event, event.name);
      api.call("post", `api/upload-logo`, fd).then(data => {
        console.log("upload logo suesses");
      });
    }
  }
};
</script>
