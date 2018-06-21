<template>
    <form class="form-horizontal" method="POST" @submit.prevent="register">
        <div class="form-group" :class="{'has-error': errors.has('name')}">
            <label for="name" class="col-md-3 control-label">用戶名</label>
            <div class="col-md-7">
                <input v-model="name"
                       v-validate data-vv-rules="required|min:3" data-vv-as="用戶名"
                       id="name" type="text" class="form-control" name="name" required>
                <span class="help-block" v-show="errors.has('name')">{{errors.first('name')}}</span>

            </div>
        </div>
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
                       v-validate data-vv-rules="required| min: 6" data-vv-as="密碼"
                       id="password" type="password" class="form-control" name="password" required>
                <span class="help-block" v-show="errors.has('password')">{{errors.first('password')}}</span>

            </div>
        </div>
        <div class="form-group" :class="{'has-error': errors.has('password-confirmation')}">
            <label for="password-confirm" class="col-md-3 control-label">確認密碼</label>
            <div class="col-md-7">
                <input id="password-confirm"
                       v-validate data-vv-rules="required| min: 6|confirmed:password" data-vv-as="確認密碼"
                       type="password" class="form-control" name="password-confirmation" required>
                <span class="help-block" v-show="errors.has('password-confirmation')">{{errors.first('password-confirmation')}}</span>

            </div>
        </div>
        <div class="form-group">
            <div class="col-md-6 col-md-offset-4">
                <button type="submit" class="btn btn-primary">
                    註冊
                </button>
            </div>
        </div>
    </form>
</template>

<script>
    export default {
        data() {
            return {
                name: '',
                email: '',
                password: '',
            }
        },
        methods: {
            register() {
                let formData = {
                    name: this.name,
                    email: this.email,
                    password: this.password,
                }
                axios.post('/api/register', formData).then(response => {
                    this.$router.push({name: 'confirm'})
                })
            }
        }
    }
</script>

<style scoped>

</style>
