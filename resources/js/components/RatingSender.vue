<template>
    <div>
        <form v-on:submit="sendRating">
            <select required v-model="voteId" name="vote" id="" class="form-select mb-3">
                <option disabled value=""><span class="text-danger">*</span>Seleziona un voto</option>
                <option v-for="rating in ratings" :key="rating" :value="rating.id">
                    {{ rating.vote }}
                </option>
            </select>
            <button style="background-color: #076dbb" type="submit" class="btn btn-primary mb-3">Submit</button>
        </form>
    </div>
</template>

<script>
    export default {
        name: "RatingSender",
        props: {
            // profileId,
        },

        data() {
            return {
                ratings: [],
                voteId: "",
            };
        },

        mounted() {
            this.getRatings();
        },

        methods: {
            getRatings() {
                axios
                    .get("http://localhost:8000/api/rating")
                    .then((res) => {
                        // this.posts = res.data.data;
                        this.ratings = res.data;
                    })
                    .catch((err) => {
                        console.log(err);
                    });
            },

            sendRating() {
                this.isLoading = true;

                axios
                    .post("/api/rating", {
                        rating_id: this.voteId,
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
