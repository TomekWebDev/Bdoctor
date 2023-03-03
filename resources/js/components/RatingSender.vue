<template>
    <div>
        <form @submit.prevent="sendRating">
            <select required v-model="voteId" name="vote" id="" class="form-select mb-3">
                <option disabled value="">
                    <span class="text-danger">*</span>Seleziona un voto
                </option>
                <option v-for="rating in ratings" :key="rating.id + 'R'" :value="rating.id">
                    {{ rating.vote }}
                </option>
            </select>
            <div v-if="ratingConfirmation != ''" class="alert alert-success">
                {{ratingConfirmation}}
            </div>
            <button style="background-color: #076dbb" type="submit" class="btn btn-primary mb-3">
                Submit
            </button>
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
                ratingConfirmation: '',
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
                        this.ratingConfirmation = res.data;
                        // function to reset the variable and hide the success alert on the page after 5 seconds
                        setTimeout(() => {
                            this.ratingConfirmation = '';
                        }, 5000);
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
