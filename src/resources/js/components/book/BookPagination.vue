<template>
<nav aria-label="Pagination" v-if="pages > 1">
    <ul class="pagination pagination-full flex-wrap">
        <li class="page-item">
            <button @click="changePage(current - 1)" class="page-link" >Previous</button>
        </li>
        <li v-for="page in renderPages" class="page-item" :class="page === current ? 'active' : ''">
            <button @click="changePage(page)" class="page-link">{{ page }}</button>
        </li>
        <template v-if="current > 10 && current < pages">
            <li class="page-item">
                <button class="page-link disabled">...</button>
            </li>
            <li class="page-item active">
                <button @click="changePage(current)" class="page-link">{{ current }}</button>
            </li>
        </template>
        <template v-if="pages > 10">
            <li class="page-item">
                <button class="page-link disabled">...</button>
            </li>
            <li class="page-item" :class="pages === current ? 'active' : ''">
                <button @click="changePage(pages)" class="page-link">{{ pages }}</button>
            </li>
        </template>
        <li class="page-item">
            <button @click="changePage(current + 1)" class="page-link">Next</button>
        </li>
    </ul>
    <div v-if="pages > 1" class="pagination pagination-mobile mb-2 justify-content-between">
        <button @click="changePage(current - 1)" class="page-link" >Previous</button>
        <button class="page-link active" disabled>{{ current }}</button>
        <button @click="changePage(current + 1)" class="page-link">Next</button>
    </div>
</nav>
</template>

<script setup>
import { computed, ref } from "vue";

const props = defineProps({
    pages: Number,
    current: Number,
})

const emit= defineEmits(["pageChange"])

const renderPages = computed(() => {
    let pages = props.pages > 10 ? 10 : props.pages
        pages = props.current > 10 && props.current < props.pages ? 8 : pages;

    return pages;
})

function changePage(page) {
    page = page < 0 ? 1 : page;
    page = page > props.pages ? props.pages : page;

    emit("pageChange", page);
}
</script>

<style lang="scss" scoped>
.pagination {
    &-mobile {
        display: none
    }

    @media screen and (max-width: 768px) {
        &-mobile {
            display: flex
        }
        &-full {
            display: none
        }
    }
}
</style>
