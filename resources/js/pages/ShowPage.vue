<template>
  <div>
    <SearchBarComp />
  </div>
</template>



<script>
import SearchBarComp from "./components/SearchBarComp.vue";
import HeaderComp from "./components/HeaderComp.vue";

export default {
  name: "ShowPage",
  components: {
    SearchBarComp,
    HeaderComp,
  },
  data() {
    return {};
  },

  methods: {},
};
</script>

<style lang="scss" scoped>
</style>
