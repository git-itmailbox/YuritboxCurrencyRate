<template>

    <el-form :model="form" ref="ruleForm2" label-position="left" label-width="0px" class="login-container">
        <h3 class="title">Login</h3>
        <el-form-item prop="account">
            <el-input type="text" v-model="form.email" placeholder="input email"></el-input>
        </el-form-item>
        <el-form-item prop="checkPass">
            <el-input type="password" v-model="form.password" placeholder="input password"></el-input>
        </el-form-item>
        <el-form-item style="width:100%;">
            <el-button type="primary" style="width:100%;" @click.native.prevent="onSubmit" :loading="logining">Login</el-button>
        </el-form-item>
    </el-form>

</template>

<script>
    export default {
        name: 'LoginForm',
        props: {
            logining: false
        },
        data() {
            return {
                form: {
                    email: '',
                    password: ''
                }
            }
        },
        methods: {
            onSubmit(e) {
                e.preventDefault()

                this.$emit('submit', {
                    ...this.form
                })
            }
        }
    }
</script>

<style scoped lang="scss">
    .login-form {

        &__submit-button {
            margin: 0 auto;
            width: 100%;
        }

    }

    .login-container {
        /*box-shadow: 0 0px 8px 0 rgba(0, 0, 0, 0.06), 0 1px 0px 0 rgba(0, 0, 0, 0.02);*/
        -webkit-border-radius: 5px;
        border-radius: 5px;
        -moz-border-radius: 5px;
        background-clip: padding-box;
        margin: 180px auto;
        width: 350px;
        padding: 35px 35px 15px 35px;
        background: #fff;
        border: 1px solid #eaeaea;
        box-shadow: 0 0 25px #cac6c6;
        .title {
            margin: 0px auto 40px auto;
            text-align: center;
            color: #505458;
        }
        .remember {
            margin: 0px 0px 35px 0px;
        }
    }

</style>
