<template>
    <div class="container-fluid mt-3">
        <div class="row">
            <div class="col-md"></div>
            <div class="col-md">
                <div class="card">
                    <div class="card-header text-center">
                        <h3>Create new lot</h3>
                    </div>
                    <div class="card-body">
                        <form class="text-center">
                            <div class="form-group">
                                <label for="titleInput">Title</label>
                                <input type="text" class="form-control" id="titleInput"
                                       placeholder="Enter lot title" v-model="newLotForm.title">
                            </div>
                            <div class="form-group">
                                <label for="imageUrlInput">Image url</label>
                                <input type="text" class="form-control" id="imageUrlInput"
                                       placeholder="Enter image url" v-model="newLotForm.imageUrl">
                            </div>
                            <div class="form-group">
                                <label for="descriptionInput">Description</label>
                                <textarea class="form-control" id="descriptionInput" v-model="newLotForm.description"
                                          rows="3" placeholder="Enter lot's description"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="categoryInput">Select category</label>
                                <select class="form-control" id="categoryInput" v-model="newLotForm.category">
                                    <option value="books">Books</option>
                                    <option value="gifts">Gifts</option>
                                    <option value="toys">Toys</option>
                                    <option value="clothing">Clothing</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="startingPriceInput">Starting price</label>
                                <div class="input-group mb-2">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">&dollar;</div>
                                    </div>
                                    <input type="number" min="1" step="0.01"
                                           class="form-control" id="startingPriceInput"
                                           placeholder="Starting price" v-model="newLotForm.startingPrice">
                                </div>
                            </div>
                            <p><small>Lot will be put up for betting immediately for 1 hour</small></p>
                            <button @click="submitCreateLotForm" type="button" class="btn btn-primary">Create</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md"></div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "NewLot",
        data() {
            return {
                newLotForm: {
                    title: '',
                    imageUrl: '',
                    description: '',
                    category: '',
                    startingPrice: 1.00
                },
                error: null,
            }
        },
        created() {
            this.checkAuth();
        },
        beforeRouteUpdate() {
            this.checkAuth();
        },
        methods: {
            submitCreateLotForm() {
                const context = this
                const form = new FormData()
                form.append('action', 'create')
                form.append('title', this.newLotForm.title)
                form.append('imageUrl', this.newLotForm.imageUrl)
                form.append('description', this.newLotForm.description)
                form.append('category', this.newLotForm.category)
                form.append('startingPrice', this.newLotForm.startingPrice)
                this.axios.post('/lots.php', form)
                    .then((response) => {
                        context.error = null;
                        context.$router.push('/lot/' + response.data);
                    })
                    .catch((error) => {
                        context.error = error;
                    });
            }
        },
    }
</script>

<style scoped>
</style>