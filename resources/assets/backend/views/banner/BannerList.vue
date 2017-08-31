<template>
  <div class="banner_list">
    <RadioGroup v-model="typeId" class="types" type="button" size="large">
      <Radio v-for="item in types" :key="item.id" :label="item.id">{{item.name}}</Radio>
    </RadioGroup>
    <Button icon="wrench" class="type_manage_btn" @click="showTypeManagementDialog = true"  type="primary">管理分类</Button>
    <Button class="add_btn" @click="$router.push({name: 'addBanner'})" icon="plus-round" type="primary">添加banner</Button>
    <draggable v-model="banners" :options="{draggable: '.row'}">
      <DraggableRow 
        v-for="item in banners"
        :key="item.id"
        :id="item.id"
        :url="item.url"
        :time="item.created_at"
        :pic="item.image_url"
        :title="item.title"
        @on-edit="id => $router.push({name: 'editBanner', params: { id }})"
        @on-del="del"
        ></DraggableRow>
    </draggable>
    <main class="sample">
      <SplitLine class="split_line">示例</SplitLine>
      <Carousel3d v-if="banners.length > 0" :controls-visible="true" :count="banners.length">
        <Slide v-for="(item, index) in banners" :key="index" :index="index">
          <img :src="item.image_url">
        </Slide>
      </Carousel3d>
      <NoData v-else></NoData>
    </main>
    <TypeManagement typeQueryName="banner" v-model="showTypeManagementDialog"/>
  </div>
</template>

<script>
import delMixin from '../../mixins/del';
import HoverableTime from '../../components/HoverableTime.vue';
import draggable from 'vuedraggable';
import { Carousel3d, Slide } from 'vue-carousel-3d';
import SplitLine from '../../components/SplitLine.vue';
import TypeManagement from '../../components/TypeManagement.vue';
import NoData from '../../components/NoData.vue';
import DraggableRow from '../../components/DraggableRow.vue';
export default {
  base: {
    title: 'banner',
    url: 'banners'
  },
  components: { HoverableTime, draggable, Carousel3d, Slide, SplitLine, TypeManagement, NoData, DraggableRow },
  mixins: [ delMixin ],
  data () {
    return {
      typeId: null,
      types: [],
      banners: [],
      showTypeManagementDialog: false
    };
  },
  methods: {
    getBannerList () {
      this.$http.get('banners', {
        params: {
          'type': this.typeId
        }
      }).then(res => {
        this.banners = res.data.data;
      });
    }
  },
  watch: {
    'typeId' () {
      this.getBannerList();
    }
  },
  mounted () {
    this.$http.get('types', {
      params: {
        model: 'banner'
      }
    }).then(res => {
      this.types = res.data.data;
      if (this.types[0]) {
        this.typeId = this.types[0].id;
      }
    });
    this.$on('del-success', this.getBannerList);
  }
};
</script>

<style lang="less" scoped>
.banner_list{
  .sample{
    margin: 30px 0;
    padding: 50px 40px 30px 40px;
    background-color: #fff;
    border-radius: 5px;
    .split_line{
      margin-bottom: 50px;
    }
  }
}
</style>
