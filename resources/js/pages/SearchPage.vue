<template>
  <div>
    <h1>Questa è SearchPage</h1>

    <button v-on:click="reviewsFilterTopDown">Filtra per recensioni + -</button>
    <button v-on:click="reviewsFilterDownTop">Filtra per recensioni - +</button>
    <button v-on:click="ratingFilterTopDown">Filtra per rating + -</button>
    <button v-on:click="ratingFilterDownTop">Filtra per rating - +</button>

    <div v-if="profiles.length <= 0">Non ci sono specialisti in</div>

    <ul v-else v-for="profile in profiles" :key="profile.id">
      <li>Profile id: {{ profile.id }}</li>
      <li v-for="spec in profile.specs" :key="spec.id">
        Nome della spec: {{ spec.name }}
      </li>
      <li>Media voti: {{ profile.ratings }}</li>
      <li>
        <router-link :to="`/profile/${profile.id}`">
          {{ profile.user.name }}
        </router-link>
      </li>
    </ul>
  </div>
</template>

  <script>
export default {
  name: "SearchPage",
  components: {},
  data() {
    return {
      profiles: [],
      specs: this.$route.params.specializations,
      isLoading: false,
      pagination: {},
      sorted: [],
      // Step 4
      // Associamo il dato passato nel router link a un nuovo data di vue.
      // $route è l'oggetto che arriva tramite router .params per entrare nell'oggetto parametro
      selectedSpecId: this.$route.params.spec,
    };
  },

  mounted() {
    this.searchProfilesSpecs();
  },

  methods: {
    searchProfilesSpecs() {
      axios
        .post("http://localhost:8000/api/profiles", {
          spec: this.selectedSpecId,
        })
        .then((res) => {
          //   console.log(res.data);
          this.profiles = res.data.profiles;
          this.specs = res.data.specs;
        })
        .catch((err) => {
          console.log(err);
        })
        .then(() => {
          this.isLoading = false;
        });
    },
    // Step 5
    // In questa chiamata axios (post) mandiamo il nuovo data che abbiamo salvato
    // vai alla store di profile controller guest per step 6

    reviewsFilterTopDown() {
      this.profiles.sort((a, b) => {
        // sort prende gli oggetti a coppie e li paragona
        // in questo caso gli diciamo di confrontare quanto sono lunghe le array delle recensioni.
        return b.reviews.length - a.reviews.length;
      });

      // display the sorted array of objects
      console.log(this.profiles);
    },
    reviewsFilterDownTop() {
      this.profiles.sort((a, b) => {
        return a.reviews.length - b.reviews.length;
      });

      // display the sorted array of objects
      console.log(this.profiles);
    },
    ratingFilterTopDown() {
      this.profiles.sort(function (a, b) {
        // salviamo variabili che rappresentano le array di singoli rating (che sono oggetti) per il profilo a e b che verranno confrontati.
        let ratingA = a.ratings;
        let ratingB = b.ratings;
        // inizzializzo var per le somme
        let sumA = 0;
        let sumB = 0;
        ratingA.forEach(function (element, index) {
          // nel foreach vado a prendere ad ogni giro di ciclo il voto numerico all'interno dell'oggetto rating
          sumA += element.vote;
        });
        // calcolo media dei voti numerici facendo (Somma voti numerici di A) diviso (la lunghezza dell'array di oggetti dei singoli rating di A)
        let avgA = sumA / ratingA.length;

        ratingB.forEach(function (element, index) {
          sumB += element.vote;
        });
        let avgB = sumB / ratingB.length;

        // con questa condizione diciamo alla funzione sort quali sono i termini che deve prendere in considerazione per ordinare gli oggetti.
        // se non glie lo indichiamo, sort esegue in automatico la comparazione tra i parametri di partenza (a, b)
        if (avgB < avgA) {
          return -1;
        } else if (avgB > avgA) {
          return 1;
        } else {
          return 0;
        }
      });
      console.log(this.profiles);
    },
    ratingFilterDownTop() {
      this.profiles.sort(function (a, b) {
        let ratingA = a.ratings;
        let ratingB = b.ratings;
        let sumA = 0;
        let sumB = 0;
        ratingA.forEach(function (element, index) {
          sumA += element.vote;
        });
        let avgA = sumA / ratingA.length;

        ratingB.forEach(function (element, index) {
          sumB += element.vote;
        });
        let avgB = sumB / ratingB.length;
        if (avgA < avgB) {
          return -1;
        } else if (avgA > avgB) {
          return 1;
        } else {
          return 0;
        }
      });
      console.log(this.profiles);
    },
  },
};
</script>

  <style lang="scss" scoped>
</style>
