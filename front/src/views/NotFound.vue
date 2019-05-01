<template>
    <div class="container-fluid mt-3">
        <div class="row">
            <div class="col-sm"></div>
            <div class="col-sm">
                <div class="card">
                    <div class="card-header text-center">
                        <h3>Page not found</h3>
                    </div>
                    <div class="card-body">
                        Something went wrong
                    </div>
                </div>
            </div>
            <div class="col-sm"></div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "NotFound",
        data() {
            return {
                loginForm: {
                    email: "",
                    password: "",
                    error: null
                },
            }
        },
        methods: {
            submitLoginForm() {
                return this.submitCustomLoginForm(this.loginForm.email, this.loginForm.password)
            },
            submitCustomLoginForm(email, password) {
                const context = this
                this.$store.dispatch('checkCredentials', {
                    email: email,
                    password: password,
                }).then(() => {
                    context.$router.replace("/")
                }).catch((error) => {
                    context.loginForm.error = error
                })
            },
        },
    }
</script>

<style scoped>
</style>