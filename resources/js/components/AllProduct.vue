<template>
    <div>
        <h2 class="text-center">Products List</h2>
 
        <table class="table">
            <thead>
            <tr>
                <th>Sr.No</th>
                <th>Name</th>
                <th>Detail</th>
                <th>Price</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="(product, index) in products.data" :key="product.id">
                <td>{{ index+1 }}</td>
                <td>{{ product.name }}</td>
                <td>{{ product.detail }}</td>
                <td>{{ product.price }}</td>
                <td>
                    <div class="btn-group" role="group">
                        <router-link :to="{name: 'edit', params: { id: product.id }}" class="btn btn-success">Edit</router-link>
                        <button class="btn btn-danger" @click="deleteProduct(product.id)">Delete</button>
                    </div>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
</template>
 
<script>
    export default {
        data() {
            return {
                products: []
            }
        },
        created() {
            this.axios
                .get('http://localhost:8000/api/products/')
                .then(response => {
                    this.products = response.data;
                });
        },
        methods: {
            deleteProduct(id) {
                if(confirm("Do you really want to delete?")){
                    this.axios
                        .delete(`http://localhost:8000/api/products/${id}`)
                        .then(response => {
                            let i = this.products.map(data => data.id).indexOf(id);
                            this.products.splice(i, 1)
                        });
                }
            }
        }
    }
</script>