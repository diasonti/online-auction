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
        created() {
            this.confirmToken();
        },
        beforeRouteUpdate() {
            this.confirmToken();
        },
    }

</script>

<style scoped>
</style>