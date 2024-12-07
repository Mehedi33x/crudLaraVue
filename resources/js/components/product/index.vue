<template>
    <h3 class="text-center mt-4">Product List</h3>
    <button @click="createProduct" class="btn btn-success text-end">Create</button>
    <div class="container mt-5">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Prouct Name</th>
                    <th scope="col">Pirce</th>
                    <th scope="col">Description</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody v-if="products.length > 0">
                <tr v-for="(item, index) in products" :key="index">
                    <th scope="row">{{ index + 1 }}</th>
                    <td>{{ item.name }}</td>
                    <td>{{ item.price }}</td>
                    <td>{{ item.description }}</td>
                    <td>
                        <button @click="editProduct(item.id)" class="btn btn-primary btn-sm">Edit</button>
                        <button :disabled="loading" @click="deleteProduct(item.id)"
                            class="btn btn-danger btn-sm mx-1">Delete</button>
                    </td>
                </tr>
            </tbody>
            <tbody v-else>
                <tr>
                    <td :colspan="5" class="no-data">No data found</td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
import axios from 'axios';
import Swal from 'sweetalert2';

export default {
    data() {
        return {
            products: [],
            loading: false,
        }
    },
    methods: {
        createProduct() {
            this.$router.push({ name: 'product.create' });
        },
        async fetchProducts() {
            try {
                const response = await axios.get('/api');
                this.products = response.data;
                // console.log('products:', this.products);
            } catch (error) {
                console.error('Error fetching products:', error);
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Failed to fetch products.',
                });
            }
        },
        deleteProduct(productId) {
            this.loading = true;
            Swal.fire({
                title: 'Are you sure?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!',
            }).then((result) => {
                if (result.isConfirmed) {
                    axios
                        .delete(`/api/products/${productId}`)
                        .then((response) => {
                            if (response.status === 200) {
                                this.products = this.products.filter(
                                    (product) => product.id !== productId
                                );
                                Swal.fire({
                                    position: 'top-end',
                                    icon: 'success',
                                    title: 'Success',
                                    text: 'Your product has been deleted',
                                    showConfirmButton: false,
                                    timer: 3000,
                                    toast: true,
                                });
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error',
                                    text: 'Something went wrong.',
                                });
                            }
                        })
                        .catch((error) => {
                            console.error('Error deleting product:', error);
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: 'Failed to delete the product.',
                            });
                        })
                        .finally(() => {
                            this.loading = false;
                        });
                } else {
                    this.loading = false;
                }
            });
        },
        editProduct(productId) {
            this.$router.push({ name: 'product.edit', params: { id: productId } });
        }
    },
    mounted() {
        const successMessage = localStorage.getItem('successMessage');
        if (successMessage) {
            Swal.fire({
                position: 'top-end',
                icon: 'success',
                title: 'Success',
                text: successMessage,
                showConfirmButton: false,
                timer: 3000,
                toast: true,
            });
            localStorage.removeItem('successMessage');
        }
    },
    created() {
        this.fetchProducts();
    },
};
</script>

<style scoped>
.no-data {
    text-align: center;
    vertical-align: middle;
    height: 20px;
}
</style>