<template>
  <div>
    <SearchBar />

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
import SearchBar from "../components/SearchBar.vue";

export default {
  name: "SearchPage",
  components: {
    SearchBar,
  },
  data() {
    return {
      profiles: [],
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
          this.profiles = res.data;
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
