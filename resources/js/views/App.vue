<template>
  <div class="w-100">
    <HeaderComp />

    <router-view> </router-view>
  </div>
</template>

<script>
import HeaderComp from "../components/HeaderComp.vue";

export default {
  name: "App",
  components: {
    HeaderComp,
  },
  data() {
    return {};
  },

  methods: {},
};
</script>

<style>
</style>
