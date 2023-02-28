<template>
  <div>
    <form v-on:submit="sendMessage">
      <input v-model="name" type="text" placeholder="name" />
      <input v-model="surname" type="text" placeholder="surname" />
      <input required v-model="email" type="email" placeholder="email*" />
      <textarea required v-model="message" name="message"></textarea>
      <button type="submit">Send Message</button>
    </form>
  </div>
</template>

<script>
export default {
  name: "MessageSender",
  props: {
    // profileId,
  },

  data() {
    return {
      name: "",
      surname: "",
      email: "",
      message: "",
      validated: false,
      isLoading: false,
    };
  },
  methods: {
    sendMessage() {
      this.isLoading = true;

      axios
        .post("/api/message", {
          name: this.name,
          surname: this.surname,
          email: this.email,
          message: this.message,
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
