<template>
<div class="container-flex">
    <div class="row">
        <div class="col-lg-12">
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="container-fluid">
                    <router-link :to="{name: 'BooksList'}" tag="button" class="btn btn-success">Return to list</router-link>
                </div>
            </nav>
        </div>
    </div>
</div>
<form class="d-flex mt-4" @submit.prevent>
    <div class="container">
        <div class="row">
            <div class="col-lg-12" v-if="data.errors">
                <div class="alert alert-danger" role="alert">
                    <p>Please fix errors.</p>
                    <ul>
                        <li v-for="(error, field) in data.errors">{{ error.join(', ') }}</li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-12" v-if="data.success">
                <div class="alert alert-success" role="alert">
                    Success.
                </div>
            </div>
            <div class="col-lg-12">
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input v-model="model.name" type="text" class="form-control" id="name" placeholder="name">
                </div>
                <div class="mb-3">
                    <label for="author" class="form-label">Author</label>
                    <input v-model="model.author" type="text" class="form-control" id="author" placeholder="author">
                </div>
                <div class="mb-3">
                    <label for="publication_date" class="form-label">Publication date</label>
                    {{model.publication_date}}
                    <input v-model="model.publication_date" type="date" class="form-control" id="publication_date">
                </div>
                <div class="mb-3">
                    <label for="stock" class="form-label">Stock</label>
                    <input v-model="model.stock" type="number" class="form-control" id="stock">
                </div>
                <div class="mb-3">
                    <label for="category" class="form-label">Category</label>
                    <select v-model="model.category_id" class="form-select" id="category">
                        <option
                            :value="category.id"
                            v-for="category in categories"
                            :selected="model.category_id === category.id"
                        >
                            {{ category.name }}
                        </option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea v-model="model.description" class="form-control" id="description" rows="3"></textarea>
                </div>
            </div>
            <div class="col-lg-12">
                <button @click="send" class="btn btn-outline-success" :disabled="data.isLoading">
                    {{ isEdit ? 'Update' : 'Save' }}
                </button>
            </div>
        </div>
    </div>
</form>
</template>

<script setup>
import { useBookStore } from "../../stores/book.store";
import { computed, ref, reactive } from "vue";
import {useCategoryStore} from "../../stores/category.store";
import { useRoute, useRouter } from 'vue-router';

const route = useRoute();
const router = useRouter();
const bookStore = useBookStore();
const categoryStore = useCategoryStore();

let categories = ref([]);
let book = ref([]);

const isEdit = computed(() => route.name === 'BookUpdate')

const data = reactive({
    errors: null,
    success: false,
    isLoading: false,
})

const model = reactive({
    name: null,
    author: null,
    publication_date: null,
    stock: null,
    description: null,
    category_id: null,
})

loadCategories()

if (isEdit.value) {
    loadBook()
}

function loadCategories() {
    categoryStore.getCategories().then((response) => {
        categories.value = response.data.data;
    })
}

function loadBook() {
    bookStore.getBook(route.params.id).then((response) => {
        model.name = response.data.data.name;
        model.author = response.data.data.author;
        model.stock = response.data.data.stock;
        model.description = response.data.data.description;
        model.category_id = response.data.data.category[0]?.id;
        model.publication_date = response.data.data.publication_date;
    })
}

function prepareData() {
    let formData = model;
    let date = new Date(formData.publication_date)
    formData.publication_date = date.toISOString().split('T')[0];
    return formData;
}

function successAlert() {
    data.success = true
    setTimeout(() => data.success = false, 4000)
}

function storeBook() {
    bookStore.storeBook(prepareData())
        .catch(errors => {
            data.errors = errors.response.data.errors;
            data.isLoading = false;
        })
        .then(response => {
            successAlert();
            setTimeout(() => router.push({path: '/update/' + response.data.data.id}), 3000)
        })
}

function updateBook() {
    bookStore.updateBook(route.params.id, prepareData())
        .catch(errors => {
            data.errors = errors.response.data.errors;
            data.isLoading = false;
        })
        .then(response => {
            data.isLoading = false
            successAlert()
        })
}

function send() {
    data.isLoading = true;
    if (isEdit.value) {
        updateBook()
    } else {
        storeBook()
    }
}
</script>

<style lang="scss" scoped>
</style>
