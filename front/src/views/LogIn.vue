<template>
    <div class="container-fluid mt-3">
        <div class="row">
            <div class="col"></div>
            <div class="col">
                <div class="card">
                    <div class="card-header formHeader">
                        <h3 v-if="currentTab === 'login'">Sign in</h3>
                        <h3 v-if="currentTab === 'registration'">Sign up</h3>
                    </div>
                    <div class="card-body">
                        <form v-if="currentTab === 'login'">
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
                        <form v-if="currentTab === 'registration'">
                            <div class="alert alert-danger" role="alert" v-if="loginForm.error === 'email.registered'">
                                The email address is already registered
                            </div>
                            <div class="alert alert-danger" role="alert" v-if="loginForm.error === 'password.too.weak'">
                                Password is too weak
                            </div>
                            <div class="alert alert-danger" role="alert" v-if="loginForm.error === 'confirmation.error'">
                                Passwords do not match
                            </div>
                            <div class="form-group">
                                <label for="regNameInput">Full name</label>
                                <input type="text" class="form-control" id="regNameInput"
                                       placeholder="Enter full name" v-model="regForm.fullName">
                            </div>
                            <div class="form-group">
                                <label for="regEmailInput">Email</label>
                                <input type="email" class="form-control" id="regEmailInput"
                                       placeholder="Enter email" v-model="regForm.email">
                            </div>
                            <div class="form-group">
                                <label for="regPasswordInput">Password</label>
                                <input type="password" class="form-control" id="regPasswordInput"
                                       placeholder="Enter password" v-model="regForm.password">
                            </div>
                            <div class="form-group">
                                <label for="regPasswordConfirmInput">Repeat password</label>
                                <input type="password" class="form-control" id="regPasswordConfirmInput"
                                       placeholder="Enter password" v-model="regForm.passwordConfirm">
                            </div>
                            <button @click="submitRegistrationForm" :disabled="regFormIsIncomplete"
                                    type="button" class="btn btn-primary">
                                Sign up</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col"></div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "LogIn",
        data() {
            return {
                currentTab: 'login',
                loginForm: {
                    email: "",
                    password: "",
                    error: null
                },
                regForm: {
                    fullName: "",
                    email: "",
                    password: "",
                    passwordConfirm: "",
                    error: null
                }
            }
        },
        computed: {
            confirmPassIsDifferent() {
                return this.regForm.password === this.regForm.passwordConfirm
            },
            regFormIsIncomplete() {
                return this.regForm.email.length < 5 || this.confirmPassIsDifferent;
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
                    context.$router.push("index")
                }).catch((error) => {
                    context.loginForm.error = error
                })
            },
            submitRegistrationForm() {
                const context = this

                const formData = new FormData()
                formData.append('email', context.regForm.email)
                formData.append('fullName', context.regForm.fullName)
                formData.append('password', context.regForm.password)
                formData.append('passwordConfirm', context.regForm.passwordConfirm)

                this.axios.post('/registration.php', formData)
                    .then(response => {
                        if (response.data === 'ok') {
                            context.submitCustomLoginForm(formData.get('email'), formData.get('password'))
                        } else {
                            context.regForm.error = response.data;
                        }
                    }).catch((error) => {
                        context.regForm.error = error;
                });
            }
        },
    }
</script>

<style scoped>
    form {
        text-align: center;
    }

    .formHeader {
        text-align: center;
    }
</style>