<template>
    <div class="container">
        <div class="row">
            <div class="col-6">
                <div v-if="profile.image" class="col-5 my-3">
                    <img style="aspect-ratio: 1/1; object-fit: cover" class="img-fluid rounded-circle"
                        :src="profile.image" alt="" />
                </div>
                <div v-else class="col-5 my-3">
                    <img class="img-fluid rounded-circle" src="../../../public/img/userDoctor.jpeg" alt="" />
                </div>
                <h5>Dr. {{ profile.user.name }} {{ profile.user.surname }}</h5>
                <h5>{{ profile.address }}, {{ profile.city }}</h5>
                <h5>{{ profile.phone }}</h5>
                <h5>{{ profile.description }}</h5>
                <h5>{{ profile.services }}</h5>

            </div>

            <div class="col-6">
                <h2>manda messaggio</h2>
                <MessageSender />
                <h2>manda review</h2>
                <ReviewSender />
                <h2>manda rating</h2>
                <RatingSender />
                <div class="mb-3 font-italic">
                    I campi contrassegnati con <span class="text-danger">*</span> sono
                    obbligatori
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import MessageSender from "../components/MessageSender.vue";
    import ReviewSender from "../components/ReviewSender.vue";
    import RatingSender from "../components/RatingSender.vue";

    export default {
        name: "ShowPage",
        components: {
            MessageSender,
            ReviewSender,
            RatingSender,
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
                    .get("/api/profiles/" + this.$route.params.id)
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

<style lang="scss" scoped></style>
