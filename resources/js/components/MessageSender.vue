<template>
    <div>
        <form v-on:submit="sendMessage">
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Nome</label>
                <input v-model="name" type="text" placeholder="name" class="form-control" />
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Cognome</label>
                <input v-model="surname" type="text" placeholder="surname" class="form-control" />
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label"><span class="text-danger">*</span>Email</label>
                <input required v-model="email" type="email" placeholder="email" class="form-control" />
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label"><span class="text-danger">*</span>Messaggio</label>
                <textarea required v-model="message" name="message" placeholder="Messaggio"
                    class="form-control"></textarea>
            </div>
            <div id="emailHelp" class="form-text mb-3">
                Le informazioni saranno visibili solo dal medico.
            </div>
            <button style="background-color: #076dbb" type="submit" class="btn btn-primary mb-3">Submit</button>
        </form>
    </div>
</template>

<script>
    export default {
        name: "MessageSender",
        props: {
            // profileId,
        },

        data() {
            return {
                name: "",
                surname: "",
                email: "",
                message: "",
                validated: false,
                isLoading: false,
            };
        },
        methods: {
            sendMessage() {
                this.isLoading = true;

                axios
                    .post("/api/message", {
                        name: this.name,
                        surname: this.surname,
                        email: this.email,
                        message: this.message,
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
