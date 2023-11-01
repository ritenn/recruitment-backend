import { defineStore } from 'pinia'
import axios from 'axios'

export const useCategoryStore = defineStore('category', {
    state: () => ({
        categories: null,
    }),
    actions: {
        async getCategories() {
            return axios.get(`/api/categories`).then(data => this.categories = data)
        },
    },
})
