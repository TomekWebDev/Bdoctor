<template>
  <div class="w-100">
    <router-view> </router-view>
    <!-- <HeaderComp /> -->
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
      <div class="container-fluid">
        <router-link class="navbar-brand" :to="{ name: 'home' }">
          Navbar
        </router-link>
        <button
          class="navbar-toggler"
          type="button"
          data-bs-toggle="collapse"
          data-bs-target="#navbarNav"
          aria-controls="navbarNav"
          aria-expanded="false"
          aria-label="Toggle navigation"
        >
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav">
            <li class="nav-item">
              <router-link
                class="nav-link active"
                aria-current="page"
                :to="{ name: 'home' }"
              >
                Home
              </router-link>
            </li>

            <li class="nav-item">
              <router-link class="nav-link" :to="{ name: 'search' }"
                >Pagina di ricerca
              </router-link>
            </li>
          </ul>
        </div>
      </div>
    </nav>
  </div>
</template>

<script>
// import HeaderComp from "../components/HeaderComp.vue";

export default {
  name: "App",
  components: {
    // HeaderComp,
  },
  data() {
    return {};
  },

  methods: {},
};
</script>

<style>
</style>
