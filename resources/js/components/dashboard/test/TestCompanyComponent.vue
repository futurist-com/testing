<template>
  <v-app id="inspire">
    <user-panel></user-panel>
    <menu-company-component v-bind:comp="company"></menu-company-component>
    <div class="card-body mt-10">
      <v-container grid-list-md text-xs-center>
        <v-row>
          
          <v-col class="align-left justify-center">
            <v-row class="align-left justify-center">
              <v-col cols="12" md="11">
                <h3>Создание теста</h3>
                <v-form>
                  <v-row>
                    <v-col>
                    <v-text-field
                      prepend-icon
                      name="name"
                      label="Название теста"
                      type="text"
                      v-model="name"
                      required
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
                    ></v-text-field>

                    </v-col>
                    <v-col cols="6">
                    
                    <v-switch v-model="skip" label="Позволять пропускать поросы"></v-switch>
                    <v-switch v-model="revers" label="Повторять пропущенные вопросы"></v-switch>
                    <v-switch v-model="rev" label="Задавать вопросы по порядку"></v-switch>
                    <v-select  v-model="type" :items="typeTestOption" label="Тип теста"></v-select>
                  </v-col>
                  </v-row>
                </v-form>

                <v-card-actions>
                  <v-spacer></v-spacer>
                  <v-btn v-on:click="create" color="primary">Далее</v-btn>
                </v-card-actions>
              </v-col>
            </v-row>
          </v-col>
        </v-row>
      </v-container>
    </div>
  </v-app>
</template>

<script>
import MenuCompanyComponentVue from "../MenuCompanyComponent";
import { mapGetters, mapActions } from "vuex";
export default {
  data: function() {
    return {
      id: null,
      company: {},
      typeTestOption: ["Психологический тест", "Профессиональный тест", "Опрос"],
      timeLimitCheck:false,
    };
  },
  computed: mapGetters(["currentCompany"]),
  created() {
    //this.$store.dispatch('getCurrentCompany', this.$route.params.id)
    //this.getCompanyId()
  },
  methods: {
    create:function(){
     let data={
        name:this.name,
        description:this.description,
        time_limit:this.time_limit,
        skip:this.skip,
        revers:this.revers,
        question_order:this.rev,
        types_test:this.type
  }
      this.$store.dispatch('createTest', data)
    }
  }
};
</script>
