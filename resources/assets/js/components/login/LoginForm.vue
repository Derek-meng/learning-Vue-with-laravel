<template>
    <form class="form-horizontal" method="POST" @submit.prevent="login">
        <div class="form-group" :class="{'has-error': errors.has('email')}">
            <label for="email" class="col-md-3 control-label">郵件</label>
            <div class="col-md-7">
                <input v-model="email"
                       v-validate data-vv-rules="required|email" data-vv-as="郵件"
                       id="email" type="email" class="form-control" name="email" required>
                <span class="help-block" v-show="errors.has('email')">{{errors.first('email')}}</span>
            </div>
        </div>
        <div class="form-group" :class="{'has-error': errors.has('password')}">
            <label for="password" class="col-md-3 control-label">密碼</label>
            <div class="col-md-7">
                <input v-model="password"
                       v-validate data-vv-rules="required|min: 6" data-vv-as="密碼"
                       id="password" type="password" class="form-control" name="password" required>
                <span class="help-block" v-show="errors.has('password')">{{errors.first('password')}}</span>

            </div>
        </div>
        <div class="form-group">
            <div class="col-md-6 col-md-offset-4">
                <button type="submit" class="btn btn-primary">
                    登入
                </button>
            </div>
        </div>
    </form>
</template>

<script>
    import JWTToken from './../../helpers/jwt';

    export default {
        data() {
            return {
                email: '',
                password: '',
            }
        },
        methods: {
            login() {
                let formData = {
                    email: this.email,
                    password: this.password,
                }
                this.$store.dispatch('loginRequest', formData).then(response => {
                    this.$router.push({name: 'profile'})
                })

            }
        }
    }
</script>

<style scoped>

</style>
