<template>
  <div class="user">
    <Panel :title="title">
      <Form :model="formData" :label-width="80">
        <Form-item label="用户名">
          <Input v-model="formData.user_name" placeholder="请设置用户名"></Input>
        </Form-item>
        <Form-item label="昵称">
          <Input v-model="formData.nick_name" placeholder="请设置用户昵称"></Input>
        </Form-item>
        <Form-item label="email">
          <Input v-model="formData.email" placeholder="请设置email"></Input>
        </Form-item>
        <Form-item label="密码">
          <Input v-model="formData.password" type="password" placeholder="请设置密码"></Input>
        </Form-item>
        <Form-item label="头像">
          <UploadPicture @on-success="uploadPic" :url="formData.avatar_url" height="180px" class="upload_picture" />
        </Form-item>
      </Form>
      <FormButtomGroup />
    </Panel>
  </div>
</template>
<script>
import Panel from '../../components/Panel.vue';
import fromMixin from '../../mixins/form';
import FormButtomGroup from '../../components/FormButtonGroup.vue';
import UploadPicture from '../../components/UploadPicture.vue';
export default {
  base: {
    title: '用户',
    url: 'users'
  },
  components: { Panel, FormButtomGroup, UploadPicture },
  mixins: [ fromMixin ],
  data () {
    return {
      formData: {
        'user_name': null,
        'nick_name': null,
        'password': null,
        'email': null,
        'avatar': null,
        'roles': null,
        'permissions': null
      }
    };
  },
  methods: {
    uploadPic (avatar) {
      this.formData.avatar = avatar;
    }
  }
};
</script>
<style lang="less" scoped>
.user{
  .upload_picture{
    width: 180px;
    margin-top: 10px;
  }
}
</style>