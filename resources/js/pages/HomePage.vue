<template>
    <div class="container">
        <div class="card mt-2">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <h1>Questa è HomePage</h1>

                    <router-link class="btn btn-primary align-self-center" :to="{
              name: 'search'
            }">Vai a ricerca avanzata</router-link>
                </div>
            </div>
            <div class="card mt-2">
                <div class="card-body">
                    <div class="d-flex justify-content-center m-auto">
                        <select class="w-75 p-2 mx-2" v-model="selectedSpecId" name="" id="">
                            <option v-for="spec in specs" :key="spec.id" :value="spec.id">
                                {{ spec.name }}
                            </option>
                        </select>
                        <router-link class="btn btn-primary mx-2" :to="{
                name: 'search',
                params: { spec: selectedSpecId },
              }">Search</router-link>
                    </div>
                </div>
            </div>
        </div>

        <!-- Step 2
            Chiamata axios per avere elenco specs, le cicliamo e con v-model associamo la spec a selectedSpecId.

        Step 3
            In questo router link passiamo il nome della rotta della pagina di ricerca
            e possiamo associargli un oggetto params (oggetto predefinito del routing)
            come se fosse un props. In questo caso gli abbiamo passato solo spec.
            Vai a SearchPage.vue per step 4
    -->

        <div v-for="sponsored in sponsoredProfiles" :key="sponsored.id" class="card mt-3">
            <div class="card-body">
                <div class="row">
                    <div class="col-6 d-flex">
                        <div v-if="!sponsored.image" class="col-5">
                            <img class="img-fluid" src="../../../public/img/userDoctor.jpeg" alt="" />
                        </div>
                        <div v-else class="col-5">
                            <img class="img-fluid rounded-circle" :src="`storage/${sponsored.image}`" alt="" />
                        </div>
                    </div>
                    <div class="col-6">
                        <h5>
                            <router-link :to="`/profile/${sponsored.id}`">
                                Dr. {{ sponsored.user.name }} {{ sponsored.user.surname }}
                            </router-link>
                        </h5>
                        <h5>{{ sponsored.reviews.length }} recensioni</h5>
                        <h5>specializzazioni:
                            <ul>
                                <li v-for="spec in sponsored.specs" :key="spec.id">
                                    {{spec.name}}
                                </li>
                            </ul>
                        </h5>
                        <h5>{{ sponsored.address }},{{ sponsored.city }}</h5>
                        <h5>Tu chiamami sul trap phone: {{ sponsored.phone }}</h5>
                        <router-link class="btn btn-outline-primary" :to="`/profile/${sponsored.id}`">
                            Vedi medico
                        </router-link>
                    </div>
                </div>
            </div>
        </div>

    </div>
</template>

<script>
    export default {
        name: "HomePage",
        components: {},
        data() {
            return {
                selectedSpecId: "",
                specs: [],
                isLoading: false,
                sponsoredProfiles: [],
            };
        },

        mounted() {
            this.getSpecs();
            this.getAllSponsored();
        },

        methods: {
            getSpecs() {
                axios
                    .get("http://localhost:8000/api/profiles/specs")
                    .then((res) => {
                        //   console.log(res.data);
                        this.specs = res.data;
                        //   this.specs = res.data.specs;
                    })
                    .catch((err) => {
                        console.log(err);
                    })
                    .then(() => {
                        this.isLoading = false;
                    });
                //   this.selectedSpecId = "";
            },
            getAllSponsored() {
                this.isLoading = true;
                axios
                    .get("http://localhost:8000/api/profiles/sponsored")
                    .then((res) => {
                        //   console.log(res.data);
                        this.sponsoredProfiles = res.data;
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
