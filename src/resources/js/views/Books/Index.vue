<template>
<category-navigation  @set-category="changeCategory" @search="search"/>
<div class="container mt-4">
    <div class="row">
        <div class="col-lg-8">
            <book-pagination
                :current="pagination.current_page"
                :pages="pagination.last_page"
                @pageChange="pageChange"
            />
        </div>
        <div class="col-lg-4 btn-block">
            <div class="d-grid">
                <router-link :to="{name: 'BookCreate'}" tag="button" class="btn btn-success">Add new book</router-link>
            </div>
        </div>
    </div>
</div>
<div class="container mt-5">
    <div v-if="books.length" class="row item" v-for="book in books">
        <div class="col-md-4 book-image d-flex justify-content-center align-items-center">
            <p class="book-image-placeholder">Book image placeholder</p>
        </div>
        <div class="col-md-8">
            <div class="row">
                <div class="col-12">
                    <div class="d-flex mt-2 align-items-center justify-content-between">
                        <span class="book-name">{{ book.name }}</span>
                        <div>
                            <router-link :to="'/update/' + book.id" tag="button" class="btn btn-primary me-2">Edit</router-link>
                            <button @click="deleteBook(book.id)" class="btn btn-danger">Delete</button>
                        </div>
                    </div>
                    <hr/>
                </div>
                <div class="col-12">
                    <p class="book-author">Author: {{ book.author }}</p>
                </div>
                <div class="col-12">
                    <p class="book-stock">Quantity: {{ book.stock }} szt.</p>
                </div>
                <div class="col-12">
                    <p class="book-category">Category: {{ book.category[0]?.name }}</p>
                </div>
            </div>
        </div>
    </div>
    <div v-else class="row">
        <div class="col-lg-12 text-center">
            <h3>No results, add new book.</h3>
        </div>
    </div>
</div>
</template>

<script setup>
import { useBookStore } from "../../stores/book.store";
import { computed, ref } from "vue";
import CategoryNavigation from "../../components/category/CategoryNavigation.vue";
import BookPagination from "../../components/book/BookPagination.vue";

const bookStore = useBookStore();

let books = ref([]);
let pagination = ref([]);
let category = ref(null);

loadBooks();

function changeCategory(categoryId) {
    category.value = categoryId;
    loadBooks(1, categoryId);
}

function loadBooks(page = 1, categoryId = null, searchable = null) {
    bookStore.getBooks(page, categoryId || category.value, searchable).then((response) => {
        books.value = response.data.data;
        pagination.value = response.data.meta;
    })
}

function search(searchable) {
    loadBooks(1, category.value, searchable);
}

function pageChange(page) {
    loadBooks(page);
}

function deleteBook(id) {
    bookStore.deleteBook(id).finally(() => {
        books.value = books.value.filter(book => book.id !== id);
        loadBooks();
    });
}
</script>

<style lang="scss" scoped>
.row {
   &.item {
       margin: 10px;
   }
}

.book {
    &-name {
        font-size: 20px;
        text-transform: capitalize;
    }
    &-image {
        width: 200px;
        min-height: 250px;
        background: #3a9dd7;
        border-radius: 6px;

        @media screen and (max-width: 768px) {
            width: 100%;
        }

        &-placeholder {
            color: white;
            font-size: 13px;
        }

        &:hover {
            cursor: pointer
        }
    }
}
</style>
