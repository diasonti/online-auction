<template>
    <div class="container-fluid mt-3">
        <div class="row">
            <div class="col-sm"></div>
            <div class="col-sm">
                <div class="card">
                    <div class="card-header text-center">
                        <h3>Sign in</h3>
                    </div>
                    <div class="card-body">
                        <form class="text-center">
                            <div class="alert alert-danger" role="alert" v-if="loginForm.error === 'bad.credentials'">
                                Wrong email or password
                            </div>
                            <div class="form-group">
                                <label for="loginEmailInput">Email</label>
                                <input type="email" class="form-control" id="loginEmailInput"
                                       placeholder="Enter email" v-model="loginForm.email">
                            </div>
                            <div class="form-group">
                                <label for="loginPasswordInput">Password</label>
                                <input type="password" class="form-control" id="loginPasswordInput"
                                       placeholder="Enter password" v-model="loginForm.password">
                            </div>
                            <button @click="submitLoginForm" type="button" class="btn btn-primary">Sign in</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-sm"></div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "LogIn",
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