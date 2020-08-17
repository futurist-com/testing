<template>
              <v-col cols="12" md="11">
                <h3>Создание теста</h3>
                <v-form v-model="valid" ref="form" lazy-validation>
                  <v-row>
                    <v-col>
                      <v-text-field
                        prepend-icon
                        name="name"
                        label="Название теста"
                        type="text"
                        v-model="nameTest"
                        required
                        :rules="nameRules"
                      ></v-text-field>
                      <v-textarea
                        name="description"
                        label="Описание теста"
                        hint="Описание теста"
                        v-model="description"
                        id="description"
                      ></v-textarea>
                      <v-switch v-model="timeLimitCheck" label="Ограничен по времени"></v-switch>
                      <v-text-field
                        v-if="timeLimitCheck"
                        prepend-icon
                        name="time-limit"
                        label="Ограничение по времени в минутах"
                        type="number"
                        v-model="time_limit"
                        required
                        :rules="timeLimitRules"
                      ></v-text-field>
                    </v-col>
                    <v-col cols="6">
                      <v-switch v-model="skip" label="Позволять пропускать вопросы"></v-switch>
                      <v-switch v-model="revers" label="Повторять пропущенные вопросы"></v-switch>
                      <v-switch v-model="rev" label="Задавать вопросы по порядку"></v-switch>
                      <v-select
                        v-model="type"
                        :items="typeTestOption"
                        label="Тип теста"
                        :rules="typeTestRules"
                      ></v-select>
                      
                    </v-col>
                  </v-row>
                </v-form>

                <v-card-actions>
                  <v-spacer></v-spacer>
                  <v-btn v-on:click="create()" color="primary" :disabled="!valid">Далее</v-btn>
                </v-card-actions>
              </v-col>
</template>

<script>
import { mapGetters, mapActions } from "vuex";
export default {
  data: function() {
    return {
      id: null,
      company: null,
      nameTest: null,
      valid: true,
      nameRules: [
        v => !!v || "Поле не может быть пустым",
        v => (v && v.length < 500) || "Поле  превышает  250 символов."
      ],
      description: null,
      timeLimitCheck: false,
      timeLimitRules: [
        v => (v && v > 0) || "Поле  не может быть отрицательным."
      ],

      time_limit: null,
      skip: false,
      revers: false,
      rev: false,
      type: false,
      typeTestRules: [v => !!v || "Выберите тип теста."],
      typeTestOption: [
        { text: "Психологический тест", value: 1 },
        { text: "Профессиональный тест", value: 2 },
        { text: "Опрос", value: 3 }
      ],
      timeLimitCheck: false
    };
  },
  computed: mapGetters(["currentCompany"]),
  mounted() {
    /*if (!this.currentCompany.id){
      this.company= localStorage.getItem('company')
    }else{
      this.company=this.currentCompany.id
    }
    console.log(this.company);*/
    //this.$store.dispatch('getCurrentCompany', this.$route.params.id)
    //this.getCompanyId()
  },
  methods: {
    create: function() {
      if (this.$refs.form.validate()) {
        let data = {
          name: this.nameTest,
          description: this.description,
          time_limit: this.time_limit,
          skip: this.skip,
          revers: this.revers,
          question_order: this.rev,
          types_test: this.type,
          company_id:currentCompany.id
        };
        this.$store.dispatch("createTest", data);
      }
    }
  }
};
</script>
