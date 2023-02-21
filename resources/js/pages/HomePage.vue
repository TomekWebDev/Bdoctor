<template>
  <div>
    <h1>Questa è HomePage</h1>

    <select v-model="selectedSpecId" name="" id="">
      <option v-for="spec in specs" :key="spec.id" :value="spec.id">
        {{ spec.name }}
      </option>
    </select>
    <!-- <button v-on:click="searchProfilesSpecs">Search</button> -->
    <router-link :to="{ name: 'search', params: { spec: selectedSpecId } }">Search</router-link>

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
      selectedSpecId: "",
      specs: [],
      isLoading: false,
      pagination: {},
    };
  },

  mounted() {
    this.getProfiles();
  },

  methods: {
    getProfiles() {
      this.isLoading = true;
      axios
        .get("http://localhost:8000/api/profiles")
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
    searchProfilesSpecs() {
      axios
        .post("http://localhost:8000/api/profiles", {
          spec: this.selectedSpecId,
        })
        .then((res) => {
          console.log(res.data);
          // ripopolo l'arrauy dopo la chiamata POST
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
  },
};
</script>

  <style lang="scss" scoped>
</style>
