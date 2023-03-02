<template>
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <div class="row d-flex">
                    <!-- images -->
                    <div class="col-lg-4 col-md-5 col-sm-5 col-6 mx-auto">
                        <div class="my-3 p-2">
                            <div v-if="profile.image" class="col-12 my-3">
                                <img style="aspect-ratio: 1/1; object-fit: cover" class="img-fluid rounded-circle"
                                    :src="profile.image" alt="" />
                            </div>
                            <div v-else class="col-12 my-3">
                                <img class="img-fluid rounded-circle" src="../../../public/img/userDoctor.jpeg"
                                    alt="" />
                            </div>
                        </div>
                    </div>
                    <!-- main info -->
                    <div class="col-lg-8 col-md-7 col-sm-7 align-self-center">
                        <div class="card my-3 p-3">
                            <h3 class="my-3">
                                Dr. {{ profile.user.name }} {{ profile.user.surname }}
                            </h3>
                            <div class="mb-3">
                                <span v-for="spec in profile.specs" :key="spec.id" class="badge bg-primary m-1">
                                    {{ spec.name }}
                                </span>
                            </div>
                            <div class="card mb-3 p-2">
                                <div v-if="profile.ratings.length">
                                    Voto
                                    <strong> {{ getVoteAverage(profile.ratings) }}</strong> in
                                    base a <strong>{{ profile.ratings.length }}</strong> voti
                                </div>
                                <div v-else>Questo medico non ha ancora voti</div>
                                <div v-if="profile.reviews.length">
                                    <strong>{{ profile.reviews.length }}</strong> recensioni
                                </div>
                                <div v-else>Questo medico non ha ancora recensioni</div>

                            </div>
                            <div class="card mb-3 p-2">
                                <div class="mb-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                        class="bi bi-geo-alt-fill" viewBox="0 0 16 16">
                                        <path
                                            d="M8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10zm0-7a3 3 0 1 1 0-6 3 3 0 0 1 0 6z" />
                                    </svg>
                                    {{ profile.address }}, {{ profile.city }}
                                </div>
                                <div>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                        class="bi bi-telephone-fill" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd"
                                            d="M1.885.511a1.745 1.745 0 0 1 2.61.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.678.678 0 0 0 .178.643l2.457 2.457a.678.678 0 0 0 .644.178l2.189-.547a1.745 1.745 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.634 18.634 0 0 1-7.01-4.42 18.634 18.634 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877L1.885.511z" />
                                    </svg>
                                    {{ profile.phone }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- messages,review and rating senders -->
        </div>
        <!-- description and services offered -->
        <div class="row">
            <div class="col-lg-4 col-md-12">
                <div class="card my-3 p-2">
                    <!-- Message Sender -->
                    <p>
                        <button style="background-color: #076dbb" class="btn btn-primary w-100" type="button"
                            data-bs-toggle="collapse" data-bs-target="#collapseExample" aria-expanded="false"
                            aria-controls="collapseExample">
                            Invia un messaggio al Dr. {{ profile.user.surname }}
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-caret-down-fill" viewBox="0 0 16 16">
                                <path
                                    d="M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z" />
                            </svg>
                        </button>
                    </p>
                    <div class="collapse" id="collapseExample">
                        <div class="card card-body mb-3">
                            <MessageSender />
                            <div class="font-italic">
                                I campi contrassegnati con
                                <span class="text-danger">*</span> sono obbligatori
                            </div>
                        </div>
                    </div>
                    <!-- Review Sender -->
                    <p>
                        <button style="background-color: #076dbb" class="btn btn-primary w-100" type="button"
                            data-bs-toggle="collapse" data-bs-target="#collapseReviews" aria-expanded="false"
                            aria-controls="collapseReviews">
                            Lascia una recensione
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-caret-down-fill" viewBox="0 0 16 16">
                                <path
                                    d="M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z" />
                            </svg>
                        </button>
                    </p>
                    <div class="collapse" id="collapseReviews">
                        <div class="card card-body mb-3">
                            <ReviewSender />
                            <div class="font-italic">
                                I campi contrassegnati con
                                <span class="text-danger">*</span> sono obbligatori
                            </div>
                        </div>
                    </div>
                    <!-- Rating Sender -->
                    <p>
                        <button style="background-color: #076dbb" class="btn btn-primary w-100" type="button"
                            data-bs-toggle="collapse" data-bs-target="#collapseRating" aria-expanded="false"
                            aria-controls="collapseRating">
                            Dai un voto ai servizi
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-caret-down-fill" viewBox="0 0 16 16">
                                <path
                                    d="M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z" />
                            </svg>
                        </button>
                    </p>
                    <div class="collapse" id="collapseRating">
                        <div class="card card-body mb-3">
                            <RatingSender />
                            <div class="font-italic">
                                I campi contrassegnati con
                                <span class="text-danger">*</span> sono obbligatori
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-8 col-md-12 card my-3 p-2">
                <h4>Descrizione</h4>
                <div class="card mb-3 p-2">
                    <div>{{ profile.description }}</div>
                </div>

                <h4>Prestazioni</h4>
                <div class="card mb-3 p-2">
                    <div>{{ profile.services }}</div>
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
            getVoteAverage(parametro) {
                let voteSum = 0;
                parametro.forEach((rating) => {
                    voteSum += rating.vote;
                });
                let voteAverage = Math.round(voteSum / parametro.length);
                return voteAverage;
            },
        },
    };
</script>

<style lang="scss" scoped></style>
