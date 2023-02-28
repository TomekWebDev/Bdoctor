<template>
    <!-- <HeaderComp /> -->
    <header>
        <nav class="navbar navbar-expand-lg" style="background-color: #076DBB" data-bs-theme="dark">
            <div class="container-fluid">
                <router-link class="navbar-brand" :to="{ name: 'homepage' }">
                    BDoctors.it
                </router-link>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <router-link class="nav-link active" aria-current="page" :to="{ name: 'homepage' }">
                                Home
                            </router-link>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="/login">Login</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="/register">Register</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        
    </header>
</template>

<script>
    export default {
        name: "HeaderComp",
    };
</script>

<style></style>
