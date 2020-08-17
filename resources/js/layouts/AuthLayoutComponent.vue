<template>
  <v-app id="inspire">
    <slot/>
  </v-app>
</template>

<script>
import { mapGetters, mapActions } from "vuex";
export default {
  name: "authLayout",
  data: function() {
    return {};
  },
  methods: {}
};
</script>
