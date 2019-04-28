<template>
    <div class="container-fluid mt-3">
        <div class="row">
            <div class="col-sm"></div>
            <div class="col-sm">
                <div class="card">
                    <div class="card-header text-center">
                        <h3>Sign up</h3>
                    </div>
                    <div class="card-body">
                        <form class="text-center">
                            <div class="alert alert-danger" role="alert" v-if="regForm.error === 'email.registered'">
                                The email address is already registered
                            </div>
                            <div class="alert alert-danger" role="alert" v-if="regForm.error === 'password.too.weak'">
                                Password is too weak
                            </div>
                            <div class="alert alert-danger" role="alert" v-if="regForm.error === 'confirmation.error'">
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
            <div class="col-sm"></div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "Registration",
        data() {
            return {
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
                return this.regForm.password !== this.regForm.passwordConfirm
            },
            regFormIsIncomplete() {
                return this.regForm.email.length < 5 || this.confirmPassIsDifferent;
            }
        },
        methods: {
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
</style>