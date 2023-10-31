import { defineStore } from 'pinia'
export const useAuthStore = defineStore('auth', {
    state: () => {
        return {
            token: "",
            user: {
                name: "",
                email: "",
                role: ""
            }
        }
    },
    getters: {
        isLogin: (state) => state.user.name !== ""
    },
    actions: {
        setNewToken(token: string) {
            this.token = token
        },
        setUser(name: string, email: string) {
            this.user.name = name
            this.user.email = email
        },
        clear() {
            this.token = ""
            this.user.name = ""
            this.user.email = ""
        }
    },
    persist: true
})