<template>
  <div>
    <h1>{{ profile.user.name }}</h1>
    <MessageSender />
  </div>
</template>

<script>
import MessageSender from "../components/MessageSender.vue";

export default {
  components: {
    MessageSender,
  },
  data() {
    return {
      profile: [],
    };
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
          this.profile = res.data;
        })
        .catch((err) => {
          console.log(err);
        });
    },
  },
};
</script>

<style>
</style>
