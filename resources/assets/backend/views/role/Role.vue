<template>
  <div class="role">
    <Panel :title="title">
      <Form ref="form" :rules="rules" :model="formData" :label-width="80">
        <Form-item label="角色" prop="name">
          <Input v-model="formData.name" placeholder="请设置角色"></Input>
        </Form-item>
        <Form-item label="角色名称" prop="display_name">
          <Input v-model="formData.display_name" placeholder="请设置角色名称"></Input>
        </Form-item>
        <Form-item label="描述">
          <Input v-model="formData.description" type="textarea" :rows="4" placeholder="请输入角色描述"></Input>
        </Form-item>
        <Form-item label="排序">
          <InputNumber :min="0" v-model="formData.order"></InputNumber>
        </Form-item>
        <FormButtomGroup />
      </Form>
    </Panel>
  </div>
</template>

<script>
import Panel from '../../components/Panel.vue';
import fromMixin from '../../mixins/form';
import FormButtomGroup from '../../components/FormButtonGroup.vue';
export default {
  base: {
    title: '角色',
    url: 'roles'
  },
  components: { Panel, FormButtomGroup },
  mixins: [ fromMixin ],
  computed: {
    rules () {
      return {
        name: [
          { required: true, type: 'string', message: '请填写角色', trigger: 'blur' }
        ],
        display_name: [
          { required: true, type: 'string', message: '请填写角色名称', trigger: 'blur' }
        ]
      };
    }
  },
  data () {
    return {
      formData: {
        'name': null,
        'display_name': null,
        'description': null,
        'order': 0,
        'permissions': null
      }
    };
  }
};
</script>

<style scoped lang="less">
</style>
