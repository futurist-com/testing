<template>
  <v-container grid-list-md text-xs-center></v-container>
</template>

<script>
import { SSL_OP_SSLREF2_REUSE_CERT_TYPE_BUG } from "constants";
import { METHODS } from "http";
import { mapGetters, mapActions } from "vuex";
export default {
  data: function() {
    return {
      id: null,
      company: {}
    };
  },
  computed: mapGetters(["currentCompany"]),
  created() {
    this.$store.dispatch("getCurrentCompany", this.$route.params.id);
    //this.getCompanyId()
  },
  methods: {
    
  }
};
</script>
