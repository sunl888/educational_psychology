<template>
  <div class="column">
    <Panel :title="title">
      <Form :model="formData" :label-width="80">
        <Form-item label="分类名">
          <Input v-model="formData.cate_name" placeholder="请设置分类名"></Input>
        </Form-item>
        <Form-item label="分类名">
          <Input v-model="formData.description" type="textarea" :rows="4" placeholder="请输入栏目描述"></Input>
        </Form-item>
      </Form>
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
    title: '栏目',
    url: 'categories'
  },
  components: { Panel, FormButtomGroup, UploadPicture },
  mixins: [ fromMixin ],
  data () {
    return {
      formData: {
        'type': null,
        'image': null,
        'parent_id': null,
        'cate_name': null,
        'description': null,
        'url': null,
        'is_target_blank': null,
        'cate_slug': null,
        'is_nav': null,
        'order': null,
        'page_template': null,
        'list_template': null,
        'content_template': null
      }
    };
  }
};
</script>

<style lang="less" scoped>

</style>
