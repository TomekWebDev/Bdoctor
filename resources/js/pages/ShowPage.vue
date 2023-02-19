<template>
  <div>
    <h1>{{ profile.user.name }}</h1> 
  </div>
</template>

<script>
export default {

  components: {

  },
  data() {
    return {
      profile : [],
    }
  },

  mounted() {
    this.getProfiles();
  },

  methods: {
    getProfiles() {
      axios
        .get("http://localhost:8000/api/profiles/" + this.$route.params.id)
        .then((res) => {
          // this.posts = res.data.data;
          this.profile = res.data
        })
        .catch((err) => {
          console.log(err);
        })
    },
  },
  };
</script>

<style>

</style>