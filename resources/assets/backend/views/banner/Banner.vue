<template>
  <div class="banner">
    <Panel :title="title">
      <Form :model="formData" :label-width="80">
        <Form-item label="标题">
          <Input v-model="formData.title" placeholder="请设置标题"></Input>
        </Form-item>
        <Form-item label="URL">
          <Input v-model="formData.url" placeholder="请设置Banner URL"></Input>
        </Form-item>
        <Form-item label="分类">
          <Select v-model="formData.type_id" style="width:200px">
            <Option v-for="item in types" :value="item.id" :key="item.id">{{ item.name }}</Option>
          </Select>
        </Form-item>
        <Form-item label="排序">
          <InputNumber :min="0" v-model="formData.order"></InputNumber>
        </Form-item>
        <Form-item label="头像">
          <UploadPicture @on-success="uploadPic" :url="formData.image_url" height="180px" class="upload_picture" />
        </Form-item>
        <Form-item label="是否显示">
          <i-switch v-model="formData.is_visible" size="large">
            <span slot="open">显示</span>
            <span slot="close">隐藏</span>
          </i-switch>
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
    title: 'Banner',
    url: 'banners'
  },
  components: { Panel, FormButtomGroup, UploadPicture },
  mixins: [ fromMixin ],
  data () {
    return {
      types: [],
      showTypeManagementDialog: false,
      formData: {
        'url': null,
        'title': null,
        'image': null,
        'type_id': null,
        'order': 0,
        'is_visible': true
      }
    };
  },
  methods: {
    uploadPic (image) {
      this.formData.image = image;
    }
  },
  mounted () {
    this.$on('on-success', () => {
      this.$router.push({name: 'bannerList'});
    });
    this.$http.get('types', {
      params: {
        model: 'banner'
      }
    }).then(res => {
      this.types = res.data.data;
    });
  }
};
</script>

<style scoped lang="less">
.banner{
  .upload_picture{
    margin-top: 10px;
  }
}
</style>
