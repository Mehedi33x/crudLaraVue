<template>
    <h3 class="text-center mt-4">Create Product</h3>
    <hr>
    <div class="mx-5 mt-2">
        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <label class="form-label">Name</label>
                    <input type="text" name="name" class="form-control" placeholder="Enter Product Name">
                </div>
                <div class="mb-3">
                    <label class="form-label">Price</label>
                    <input type="text" name="price" class="form-control" placeholder="Enter Product Price">
                </div>

            </div>
            <div class="col-md-6">
                <div class="input-group mb-3">
                    <label for="inputGroupSelect04" class="input-group mb-2">Choose Option</label>
                    <select class="form-select" id="inputGroupSelect04" aria-label="Example select with button addon">
                        <option selected>Choose...</option>
                        <option v-for="category in categories" :key="category.id" :value="category.id">{{ category.name
                            }}</option>
                    </select>
                    <button class="btn btn-outline-secondary" type="button">Button</button>
                </div>
                <div class="input-group mb-3">
                    <label for="inputGroupSelect04" class="input-group mb-2">Images</label>
                    <input type="file" class="form-control" multiple>
                    <button class="btn btn-outline-secondary" type="button" id="inputGroupFileAddon04">Button</button>
                </div>

            </div>
            <div class="mb-3">
                <label for="exampleFormControlTextarea1" class="form-label">Example textarea</label>
                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
            </div>
        </div>
        <button type="button" class="btn btn-success">Success</button>

    </div>
</template>


<script>
export default {
    data() {
        return {
            categories: [
                { id: 1, name: 'Meat' },
                { id: 2, name: 'Fish' },
                { id: 3, name: 'Vegetables' }
            ]
        };
    }
};
</script>

<style></style>