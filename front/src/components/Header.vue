<template>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <router-link to="/" class="navbar-brand">Logo</router-link>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto"></ul>
            <form class="form-inline my-2 my-lg-0">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-if="!loggedIn">
                            Profile
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown" v-if="!loggedIn">
                            <router-link to="/login" class="dropdown-item">Sign in</router-link>
                            <div class="dropdown-divider"></div>
                            <router-link to="/register" class="dropdown-item">Sign up</router-link>
                        </div>
                        <div v-if="loggedIn">
                            <button @click="logout" class="btn btn-warning">Log out</button>
                        </div>
                    </li>
                </ul>
                <input class="form-control mr-sm-2" type="search" placeholder="Search..." aria-label="Search">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
            </form>
        </div>
    </nav>
</template>

<script>
    export default {
        name: "Header",
        computed: {
            loggedIn() {
                return this.$store.getters.token
            }
        },
        methods: {
            logout() {
                const context = this
                this.$store.dispatch('logOut', {})
                    .then(() => {
                        context.$router.replace("index")
                    }).catch((error) => {
                    console.error(error)
                })
            }
        }
    }
</script>

<style scoped>

</style>