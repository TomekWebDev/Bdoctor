<template>
  <div>
    <SearchBar />

    <ul v-for="profile in profiles" :key="profile.id">
      <li>Profile id: {{ profile.id }}</li>
      <li v-for="spec in profile.specs" :key="spec.id">
        Nome della spec: {{ spec.name }}
      </li>
      <li> <router-link :to="`/profile/${profile.id}`"> {{ profile.user.name }} </router-link> </li>
    </ul>

    <PaginationComp @on-page-change="getProfiles" :pagination="pagination" />
  </div>
</template>



  <script>
import SearchBar from "../components/SearchBar.vue";
import PaginationComp from "../components/PaginationComp.vue";

export default {
  name: "SearchPage",
  components: {
    SearchBar,
    PaginationComp,
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
    getProfiles(page) {
      this.isLoading = true;
      axios
        .get("http://localhost:8000/api/profiles?page=" + page)
        .then((res) => {
          console.log(res.data);
          // this.posts = res.data.data;
          const { data, current_page, last_page } = res.data;
          this.profiles = data;
          this.pagination = {
            lastPage: last_page,
            currentPage: current_page,
          };
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
