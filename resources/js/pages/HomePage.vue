<template>
  <div class="container">
    <div class="card mt-2">
      <div class="card-body">
        <div class="d-flex justify-content-between">
          <h1>Questa è HomePage</h1>

          <router-link
            class="btn btn-primary align-self-center"
            :to="{
              name: 'search',
              params: { specializations: specs },
            }"
            >Vai a ricerca avanzata</router-link
          >
        </div>
      </div>
      <div class="card mt-2">
        <div class="card-body">
          <div class="d-flex justify-content-center m-auto">
            <select
              class="w-75 p-2 mx-2"
              v-model="selectedSpecId"
              name=""
              id=""
            >
              <option v-for="spec in specs" :key="spec.id" :value="spec.id">
                {{ spec.name }}
              </option>
            </select>
            <router-link
              class="btn btn-primary mx-2"
              :to="{
                name: 'search',
                params: { spec: selectedSpecId },
              }"
              >Search</router-link
            >
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
      pagination: {},
      profiles: [],
    };
  },

  mounted() {
    this.getSpecs();
    this.getSponsoredProfiles();
  },

  methods: {
    getSpecs() {
      this.isLoading = true;
      axios
        .get("http://localhost:8000/api/profiles")
        .then((res) => {
          //   console.log(res.data);
          this.specs = res.data;
        })
        .catch((err) => {
          console.log(err);
        })
        .then(() => {
          this.isLoading = false;
        });
    },
    getSponsoredProfiles() {
      this.isLoading = true;
      axios
        .get("http://localhost:8000/api/profiles/sponsored")
        .then((res) => {
          //   console.log(res.data);
          let allProfiles = res.data;

          allProfiles.filter(function (profile) {
            let thisSponsors = profile.sponsors;
            let expiration = thisSponsors;
          });
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
