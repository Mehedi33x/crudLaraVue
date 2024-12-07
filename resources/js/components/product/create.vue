<template>
    <h3 class="text-center mt-4">Create Product</h3>
    <hr>
    <div class="mx-5 mt-2">
        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <label class="form-label">Name</label>
                    <input v-model="form.name" type="text" name="name" class="form-control"
                        placeholder="Enter Product Name">
                </div>
                <div class="mb-3">
                    <label class="form-label">Price</label>
                    <input v-model="form.price" type="text" name="price" class="form-control"
                        placeholder="Enter Product Price">
                </div>

            </div>
            <div class="col-md-6">
                <div class="input-group mb-3">
                    <label for="inputGroupSelect04" class="input-group mb-2">Choose Option</label>
                    <select v-model="form.category_id" class="form-select" id="inputGroupSelect04"
                        aria-label="Example select with button addon">
                        <option selected>Choose...</option>
                        <option v-for="category in categories" :key="category.id" :value="category.id">{{ category.name
                            }}</option>
                    </select>
                    <button class="btn btn-outline-secondary" type="button">Button</button>
                </div>
                <div class="input-group mb-3">
                    <label for="inputGroupSelect04" class="input-group mb-2">Images</label>
                    <input @change="handleFileUpload" type="file" class="form-control">
                    <button class="btn btn-outline-secondary" type="button" id="inputGroupFileAddon04">Button</button>
                </div>

            </div>
            <div class="mb-3">
                <label for="exampleFormControlTextarea1" class="form-label">Example textarea</label>
                <textarea v-model="form.description" class="form-control" id="exampleFormControlTextarea1"
                    rows="3"></textarea>
            </div>
        </div>
        <button @click="saveData" type="button" class="btn btn-success">Success</button>

    </div>
</template>


<script>
import axios from 'axios';
import Swal from 'sweetalert2';

export default {
    data() {
        return {
            categories: [
                { id: 1, name: 'Meat' },
                { id: 2, name: 'Fish' },
                { id: 3, name: 'Vegetables' }
            ],
            form: {
                name: '',
                price: '',
                category_id: '',
                description: '',
                image: '',
            },
        };
    },
    methods: {
        handleFileUpload(event) {
            this.form.image = event.target.files[0];
        },
        async saveData() {
            try {
                const formData = new FormData();
                formData.append('name', this.form.name);
                formData.append('price', this.form.price);
                formData.append('category_id', this.form.category_id);
                formData.append('description', this.form.description);
                // formData.append('image', this.form.image);
                const response = await axios.post('/api/product/store', formData, {
                    headers: {
                        'Content-Type': 'multipart/form-data',
                    },
                });
                this.$router.push({ name: 'product.index',
                    query: {successMessage: response.data.message},
                 });
            } catch (error) {
                console.error(error.response?.data || error.message);
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: error.response?.data?.message || 'Something went wrong!',
                });
            }
        },
    }
};
</script>

<style></style>