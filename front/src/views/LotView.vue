<template>
    <div class="container-fluid mt-5">
        <div class="card-group">
            <div class="card">
                <img :src="lot.imageUrl" class="card-img-top" :alt="lot.title">
            </div>
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">{{ lot.title }}</h5>
                    <p class="card-text">{{ lot.description }}</p>
                    <p class="card-text"><small class="text-muted">
                        Category: {{ lot.category }}<br />
                        Seller id: {{ lot.sellerId }}
                    </small></p>
                </div>
            </div>
            <div class="card">
                <div class="card-body" v-if="lot.status === 'created'">
                    <h5 class="card-title">Betting has not started yet</h5>
                </div>
                <div class="card-body" v-if="lot.status === 'betting'">
                    <h5 class="card-title">Betting in progress</h5>
                    <p class="card-text">Current bet: 2$</p>
                    <div class="text-center">
                        <label class="sr-only" for="inlineFormInputGroup">Bet amount</label>
                        <div class="input-group mb-2">
                            <div class="input-group-prepend">
                                <div class="input-group-text">&dollar;</div>
                            </div>
                            <input type="number" class="form-control" id="inlineFormInputGroup" placeholder="Bet amount">
                        </div>
                        <button type="button" class="btn btn-primary mb-2">Place your bet</button>
                    </div>
                </div>
                <div class="card-body" v-if="lot.status === 'closed'">
                    <h5 class="card-title">Betting finished</h5>
                    <p class="card-text">Buyer id: {{ lot.buyerId }}</p>
                </div>
            </div>
        </div>

        <div class="none">
            Lot id is: {{lotId}} <br />
            lot: {{ lot }}
        </div>
    </div>
</template>

<script>
    export default {
        name: "Lot",
        props: ["lotId"],
        data() {
            return {
                lot: "default lot",
                error: null,
            }
        },
        created() {
            this.refreshLot();
        },
        beforeRouteUpdate() {
            this.refreshLot();
        },
        methods: {
            refreshLot() {
                const context = this;
                this.axios.get('/lots.php?action=get&id=' + this.lotId)
                    .then((response) => {
                        context.lot = response.data
                    })
                    .catch((error) => {
                        console.error(error)
                        context.error = error
                    })
            }
        }
    }
</script>

<style scoped>
</style>