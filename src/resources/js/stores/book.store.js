import { defineStore } from 'pinia'
import axios from 'axios'

export const useBookStore = defineStore('book', {
    state: () => ({
        book: null,
        books: null,
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
                .then(data => this.books = data)
        },
        async getBook(id) {
            return axios.get(`/api/books/` + id)
                .then(data => this.book = data)
        },
        async storeBook(data) {
            return axios.post(`/api/books`, data);
        },
        async updateBook(id, data) {
            return axios.put(`/api/books/` + id, data);
        },
        async deleteBook(id) {
            return axios.delete(`/api/books/` + id);
        },
    },
})
