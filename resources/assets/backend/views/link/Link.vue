<template>
  <div class="link">
    <Panel :title="title">
      <Form :model="formData" :label-width="80">
        <Form-item label="URL">
          <Input v-model="formData.url" placeholder="请设置友情链接url"></Input>
        </Form-item>
        <Form-item label="链接名称">
          <Input v-model="formData.name" placeholder="请输入链接名称"></Input>
        </Form-item>
        <Form-item label="联系人">
          <Input v-model="formData.linkman" placeholder="请输入联系人"></Input>
        </Form-item>
        <Form-item label="栏目图片">
          <UploadPicture @on-success="uploadPic" :url="formData.logo_url" height="180px" class="upload_picture" />
        </Form-item>
        <Form-item label="分类">
          <Select v-model="formData.type_id" style="width:200px">
            <Option v-for="item in types" :value="item.id" :key="item.id">{{ item.name }}</Option>
          </Select>
        </Form-item>
        <Form-item label="是否显示">
          <i-switch v-model="formData.is_visible" size="large">
            <span slot="open">显示</span>
            <span slot="close">隐藏</span>
          </i-switch>
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
import UploadPicture from '../../components/UploadPicture.vue';
export default {
  base: {
    title: '友情链接',
    url: 'links'
  },
  components: { Panel, FormButtomGroup, UploadPicture },
  mixins: [ fromMixin ],
  methods: {
    uploadPic (logo) {
      this.formData.logo = logo;
    }
  },
  data () {
    return {
      types: [],
      formData: {
        'url': null,
        'name': null,
        'logo': null,
        'linkman': null,
        'type_id': null,
        'is_visible': true,
      }
    };
  },
  mounted () {
    this.$on('on-success', () => {
      this.$router.push({name: 'linkList'});
    });
    this.$http.get('types', {
      params: {
        model: 'link'
      }
    }).then(res => {
      this.types = res.data.data;
    });
  }
};
</script>

<style scoped lang="less">
.link{
  .upload_picture{
    width: 180px;
    margin-top: 10px;
  }
}
</style>
