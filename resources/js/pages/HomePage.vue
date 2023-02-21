<template>
  <div>
    <h1>Questa è HomePage</h1>

    <select v-model="selectedSpecId" name="" id="">
      <option v-for="spec in specs" :key="spec.id" :value="spec.id">
        {{ spec.name }}
      </option>
    </select>
    <!-- <button v-on:click="searchProfilesSpecs">Search</button> -->
    <router-link
      class="btn btn-primary"
      :to="{ name: 'search', params: { spec: selectedSpecId } }"
      >Search</router-link
    >
  </div>
</template>

  <script>
export default {
  name: "SearchPage",
  components: {},
  data() {
    return {
      selectedSpecId: "",
      specs: [],
      isLoading: false,
      pagination: {},
    };
  },

  mounted() {
    this.getSpecs();
  },

  methods: {
    getSpecs() {
      this.isLoading = true;
      axios
        .get("http://localhost:8000/api/profiles")
        .then((res) => {
          //   console.log(res.data);
          this.specs = res.data;
        })
        .catch((err) => {
          console.log(err);
        })
        .then(() => {
          this.isLoading = false;
        });
    },
  },
};
</script>

  <style lang="scss" scoped>
</style>
