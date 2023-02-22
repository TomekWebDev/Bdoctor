<template>
  <div>
    <h1></h1>
    <h5>Dr. {{ profile.user.name }} {{ profile.user.surname }}</h5>
    <h5>{{ profile.address }}, {{ profile.city }}</h5>
    <h5>{{ profile.phone }}</h5>
    <h5>{{ profile.description }}</h5>
    <h5>{{ profile.services }}</h5>
    <h2>manda messaggio</h2>
    <MessageSender />
    <h2>manda review</h2>
    <ReviewSender />
    <h2>manda rating</h2>
    <RatingSender />
  </div>
</template>

<script>
import MessageSender from "../components/MessageSender.vue";
import ReviewSender from "../components/ReviewSender.vue";
import RatingSender from "../components/RatingSender.vue";

export default {
  components: {
    MessageSender,
    ReviewSender,
    RatingSender,
  },
  data() {
    return {
      profile: {},
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
