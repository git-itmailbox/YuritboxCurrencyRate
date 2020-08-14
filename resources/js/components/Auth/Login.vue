<template>
    <div class="login">
        <div class="login__content">
            <login-form @submit="onSubmit"></login-form>
        </div>
    </div>
</template>

<script>
    import LoginForm from './LoginForm'
    export default {
        name: 'Login',
        components: {LoginForm},
        data() {
            return {
                isLogin: false
            }
        },
        methods: {
            onSubmit(loginData) {
                const self = this
                this.isLogin = true
                this.$auth.login({
                    data: loginData,
                    redirect: '/',
                    fetchUser: true
                }).then( (res) =>{
                    self.isLogin = false
                    localStorage.setItem('laravel-jwt-auth', res.data.access_token);
                    this.$auth.fetch()
                }).catch((err) => {
                    console.log('error')
                    console.log(err.message)
                    self.isLogin = false
                })

            }
        }
    }
</script>

<style scoped lang="scss">
    .login {
        height: 100vh;
        width: 100vw;
        display: flex;
        align-items: center;
        justify-content: center;

        &__content {

        }
    }
</style>
