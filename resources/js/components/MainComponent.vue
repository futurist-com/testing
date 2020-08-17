<template>
  <div>
    <component :is="layout">
      <router-view></router-view>
    </component>
  </div>
</template>

<script>
export default {
  mounted() {},
  computed: {
    layout() {
      return this.$route.meta.layout || "default-layout-component";
    }
  }
};
</script>
