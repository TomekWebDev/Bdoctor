<template>
    <div>
        <form @submit.prevent="sendMessage">
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label"><span class="text-danger">*</span>Nome</label>
                <input required v-model="name" type="text" placeholder="Inserisci nome" class="form-control" />
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label"><span class="text-danger">*</span>Cognome</label>
                <input required v-model="surname" type="text" placeholder="Inserisci cognome" class="form-control" />
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label"><span class="text-danger">*</span>Email</label>
                <input required v-model="email" type="email" placeholder="Inserisci email" class="form-control" />
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label"><span class="text-danger">*</span>Messaggio</label>
                <textarea required v-model="message" name="message" placeholder="Messaggio"
                    class="form-control"></textarea>
            </div>
            <div v-if="messageConfirmation != ''" class="alert alert-success">
                {{messageConfirmation}}
            </div>
            <div id="emailHelp" class="form-text mb-3">
                Le informazioni saranno visibili solo dal medico.
            </div>
            <button style="background-color: #076dbb" type="submit" class="btn btn-primary mb-3">
                Invia
            </button>
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
                messageConfirmation: "",
            };
        },
        mounted() {
            console.log(this.variabile);
        },
        methods: {
            sendMessage() {
                this.isLoading = true;
                console.log("Before request");
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
                        this.messageConfirmation = res.data;
                        this.name = '';
                        this.surname = '';
                        this.email = '';
                        this.message = '';
                    })
                    .catch((err) => {
                        console.log(err);
                    })
                    .then(() => {
                        this.isLoading = false;
                    });
                console.log("After request");
            },
        },
    };
</script>

<style lang="scss" scoped>
</style>
