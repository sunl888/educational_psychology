<template>
<div>
  <Panel :title="title">
    <Form :model="formData" :label-width="80">
      <Form-item label="用户名">
        <Input v-model="formData.input" placeholder="请设置用户名"></Input>
      </Form-item>
      <Form-item label="昵称">
        <Input v-model="formData.input" placeholder="请设置用户昵称"></Input>
      </Form-item>
       <Form-item label="email">
        <Input v-model="formData.input" placeholder="请设置email"></Input>
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
export default {
  base: {
    title: '用户',
    url: 'users'
  },
  components: { Panel, FormButtomGroup },
  mixins: [ fromMixin ],
  data () {
    return {
      formData: {
        user_name: '',
        nike_name: '',
        email: ''
      }
    };
  },
  mounted () {
  }
};
</script>
<style lang="less" scoped>
</style>