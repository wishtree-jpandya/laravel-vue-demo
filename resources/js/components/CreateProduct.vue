<template>
    <div>
        <h3 class="text-center">Create Product</h3>
        <div class="row">
            <div class="col-md-6">
                <form @submit.prevent="addProduct">
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" class="form-control" v-model="product.name">
                        <span v-if="errors" class="label label-danger">{{ errors.name[0] }}</span>
                    </div>
                    <div class="form-group">
                        <label>Detail</label>
                        <input type="text" class="form-control" v-model="product.detail">
                        <span v-if="errors" :class="['label label-danger']">{{ errors.detail[0] }}</span>
                    </div>
                    <div class="form-group">
                        <label>Price</label>
                        <input type="float" class="form-control" v-model="product.price">
                        <span v-if="errors" :class="['label label-danger']">{{ errors.price[0] }}</span>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Create</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>
 
<script>
    export default {
        data() {
            return {
                product: {},
                errors: null,
            }
        },
        methods: {
            addProduct() {
                this.axios
                    .post('http://localhost:8000/api/products', this.product)
                    .then(response => {
                        this.$router.push({ name: 'home' });
                    })
                    .catch(err => {
                        this.errors = err.response.data.errors;
                    })
                    .finally(() => this.loading = false)
            }
        }
    }
</script>