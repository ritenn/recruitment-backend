import { defineStore } from 'pinia'
import axios from 'axios'

export const useBookStore = defineStore('book', {
    state: () => ({
        book: null,
    }),
    actions: {
        async getBooks(page = 1, categoryId = null, search = null) {
            let params = {
                page
            }

            if (categoryId !== null) {
                params.category_id = categoryId
            }

            if (search !== null) {
                params.search = search
            }

            return axios.get(`/api/books`, {
                    params
                })
                .then(data => this.book = data)
        },
    },
})
