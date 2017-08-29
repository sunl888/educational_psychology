<template>
  <div class="login">
      <main class="login_wrapper">
        <h2>用户登录</h2>
         <Form :model="loginInfo">
            <Form-item>
              <Input v-model="loginInfo.account" placeholder="请输入用户名或邮箱"></Input>
            </Form-item>
            <Form-item>
              <Input v-model="loginInfo.password" type="password" placeholder="请输入密码" @keydown.native.enter="login"></Input>
            </Form-item>
            <Form-item>
              <Button :loading="loading" class="login_btn" type="primary" long @click="login">确认提交</Button>
              <Checkbox v-model="loginInfo.remeber">下次自动登录</Checkbox>
            </Form-item>
        </Form>
        <Button class="back_btn" type="text"><Icon class="icon" type="arrow-left-c"></Icon>返回到首页</Button>
      </main>
  </div>  
</template>

<script>
export default {
  data () {
    return {
      loading: false,
      loginInfo: {
        account: 'tiny',
        password: 'test1234',
        remeber: true
      }
    };
  },
  methods: {
    login () {
      this.loading = true;
      this.$http.post('auth/login', this.loginInfo).then(res => {
        let redirectName = this.$route.query.redirect;
        if (redirectName) {
          this.$router.replace({name: redirectName});
        } else {
          this.$router.replace({name: 'home'});
        }
        this.loading = false;
      }).catch(() => {
        // todo finally
        this.loading = false;
      });
    }
  }
};
</script>


<style lang="less" scoped>
.login{
  padding-top: 120px;
  .login_wrapper{
    position: relative;
    h2{
      font-size: 26px;
      text-align: center;
      font-weight: 700;
      color: #506470;
      margin: 10px 0 30px;
    }
    width: 350px;
    padding: 24px;
    margin: 72px auto 68px;
    background: #fff;
    box-shadow: 0 1px 2px rgba(0,0,0,.2);
    .login_btn{
      margin-bottom: 5px;
    }
    .back_btn{
      position: absolute;
      bottom: -70px;
      .icon{
        margin-right: 5px;
      }
    }
  }
}
</style>

