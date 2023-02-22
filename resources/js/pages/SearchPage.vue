<template>
  <div>
    <h1>Questa è SearchPage</h1>

    <div v-if="profiles.length <= 0">Non ci sono specialisti in</div>

    <ul v-else v-for="profile in profiles" :key="profile.id">
      <li>Profile id: {{ profile.id }}</li>
      <li v-for="spec in profile.specs" :key="spec.id">
        Nome della spec: {{ spec.name }}
      </li>
      <li>
        <router-link :to="`/profile/${profile.id}`">
          {{ profile.user.name }}
        </router-link>
      </li>
    </ul>
  </div>
</template>

  <script>
export default {
  name: "SearchPage",
  components: {},
  data() {
    return {
      profiles: [],
      specs: this.$route.params.specializations,
      isLoading: false,
      pagination: {},
      // Step 4
      // Associamo il dato passato nel router link a un nuovo data di vue.
      // $route è l'oggetto che arriva tramite router .params per entrare nell'oggetto parametro
      selectedSpecId: this.$route.params.spec,
    };
  },

  mounted() {
    this.searchProfilesSpecs();
  },

  methods: {
    searchProfilesSpecs() {
      axios
        .post("http://localhost:8000/api/profiles", {
          spec: this.selectedSpecId,
        })
        .then((res) => {
          //   console.log(res.data);
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
    // Step 5
    // In questa chiamata axios (post) mandiamo il nuovo data che abbiamo salvato
    // vai alla store di profile controller guest per step 6
  },
};
</script>

  <style lang="scss" scoped>
</style>
