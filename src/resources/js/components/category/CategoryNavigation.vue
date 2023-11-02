<template>
<div class="container-flex">
    <div class="row">
        <div class="col-lg-12">
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="container-fluid">
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                            <li class="nav-item">
                                <button
                                    @click="setCategory(null)"
                                    class="btn nav-link"
                                    :class="currentCategory === null ? 'active' : ''"
                                >
                                    show all
                                </button>
                            </li>
                            <li class="nav-item" v-for="category in categories">
                                <button
                                    @click="setCategory(category.id)"
                                    class="btn nav-link"
                                    :class="category.id === currentCategory ? 'active' : ''"
                                >
                                    {{ category.name }}
                                </button>
                            </li>
                        </ul>
                        <form class="d-flex" @submit.prevent>
                            <input v-model="search" v-on:change="searchBooks" class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                            <button @click="searchBooks" class="btn btn-outline-success">Search</button>
                        </form>
                    </div>
                </div>
            </nav>
        </div>
    </div>
</div>
</template>

<script setup>
import { computed, ref } from "vue";
import {useCategoryStore} from "../../stores/category.store";

const categoryStore = useCategoryStore();

let categories = ref([]);
let currentCategory = ref(null);
let search = ref(null);

categoryStore.getCategories().then((response) => categories.value = response.data.data)

const emit= defineEmits(["setCategory", 'search'])

function searchBooks() {
    emit("search", search.value);
}

function setCategory(categoryId) {
    currentCategory.value = categoryId;
    emit("setCategory", categoryId);
}
</script>

<style lang="scss" scoped>
</style>
