<template>
  <div>
    <form v-on:submit="sendReview">
      <input v-model="name" type="text" placeholder="name" />
      <textarea v-model="review" name="review"></textarea>
      <button type="submit">Send Review</button>
    </form>
  </div>
</template>

<script>
export default {
  name: "ReviewSender",
  props: {
    // profileId,
  },

  data() {
    return {
      name: "",
      review: "",
      validated: false,
      isLoading: false,
    };
  },
  methods: {
    sendReview() {
      this.isLoading = true;

      axios
        .post("/api/review", {
          name: this.name,
          review: this.review,
          profile_id: this.$route.params.id,
        })
        .then((res) => {
          console.log(res.data);
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
