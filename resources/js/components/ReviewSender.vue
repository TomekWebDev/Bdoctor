<template>
    <div>
        <form @submit.prevent="sendReview">
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label"><span class="text-danger">*</span>Nome</label>
                <input required v-model="name" type="text" placeholder="name" class="form-control" />
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label"><span class="text-danger">*</span>Recensione</label>
                <textarea required v-model="review" name="review" placeholder="Recensione"
                    class="form-control"></textarea>
            </div>
            <div v-if="reviewConfirmation != ''" class="alert alert-success">
                {{reviewConfirmation}}
            </div>
            <div id="emailHelp" class="form-text mb-3">
                La sua recensione verrà pubblicata.
            </div>
            <button style="background-color: #076dbb" type="submit" class="btn btn-primary mb-3">
                Submit
            </button>
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
                reviewConfirmation: '',
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
                        this.reviewConfirmation = res.data;
                        this.name = "";
                        this.review = "";
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
