<template>
  <v-app id="inspire">
    <user-panel></user-panel>
    <div class="card-body mt-10">
      <v-container grid-list-md text-xs-center>
        <slot />
      </v-container>
    </div>
    <footer-panel></footer-panel>
  </v-app>
</template>

<script>
import { mapGetters, mapActions } from "vuex";
export default {
  name: "DefaultLayout",
  data: function() {
    return {};
  },
  methods: {}
};
</script>
