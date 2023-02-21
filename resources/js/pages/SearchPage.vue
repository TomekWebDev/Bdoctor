<template>
  <div>
    <h1>Questa è SearchPage</h1>

    <ul v-for="profile in profiles" :key="profile.id">
      <li>Profile id: {{ profile.id }}</li>
      <li v-for="spec in profile.specs" :key="spec.id">
        Nome della spec: {{ spec.name }}
      </li>
      <li>
        <router-link :to="`/profile/${profile.id}`">
          {{ profile.user.name }}
        </router-link>
      </li>
      {{
        pippo
      }}
    </ul>
    {{}}
  </div>
</template>

  <script>
export default {
  name: "SearchPage",
  components: {},
  data() {
    return {
      profiles: [],
      specs: [],
      pippo: "",
      isLoading: false,
      pagination: {},
      selectedSpecId: this.$route.params.spec,
    };
  },

  mounted() {
    // this.getProfiles();
    this.searchProfilesSpecs();
  },

  methods: {
  //   getProfiles() {
  //     this.isLoading = true;
  //     axios
  //       .get("http://localhost:8000/api/profiles")
  //       .then((res) => {
  //         console.log(res.data);
  //         this.profiles = res.data.profiles;
  //         this.pippo = res.data.pippo;
  //       })
  //       .catch((err) => {
  //         console.log(err);
  //       })
  //       .then(() => {
  //         this.isLoading = false;
  //       });
  //   },
  // },
  searchProfilesSpecs() {
      axios
          .post('http://localhost:8000/api/profiles', {
              spec: this.selectedSpecId,
          })
          .then((res) => {
              console.log(res.data);
              this.profiles = res.data.profiles;
              this.specs = res.data.specs;
          })
          .catch((err) => {
              console.log(err);
          })
          .then(() => {
              this.isLoading = false;
            });
        },
      }
};
</script>

  <style lang="scss" scoped>
</style>
