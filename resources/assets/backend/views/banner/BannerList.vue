<template>
  <div class="banner_list">
    <RadioGroup v-model="typeId" class="types" type="button" size="large">
      <Radio v-for="item in types" :key="item.id" :label="item.id">{{item.name}}</Radio>
    </RadioGroup>
    <Button icon="wrench" class="type_manage_btn" @click="showTypeManagementDialog = true"  type="primary">管理分类</Button>
    <Button class="add_btn" @click="$router.push({name: 'addBanner'})" icon="plus-round" type="primary">添加banner</Button>
    <draggable v-model="banners" :options="{draggable: '.row'}">
      <div class="row" v-for="item in banners" :key="item.id">
        <Icon class="icon" type="navicon"></Icon>
        <Avatar class="pic" size="large" shape="square" :src="item.image_url"></Avatar>
        <span class="title">{{item.title}}</span>
        <div class="info">
          <span>{{item.url}}</span>
          <span><HoverableTime :time="item.created_at"></HoverableTime></span>
        </div>
        <div class="option">
          <Button type="primary" @click="$router.push({name: 'editBanner', params: {id: item.id}})" size="small">编辑</Button>
          <Button type="error" size="small" @click="del(item.id)">删除</Button>
        </div>
      </div>
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
export default {
  base: {
    title: 'banner',
    url: 'banners'
  },
  components: { HoverableTime, draggable, Carousel3d, Slide, SplitLine, TypeManagement, NoData },
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
      this.typeId = this.types[0].id;
    });
    this.$on('del-success', this.getBannerList);
  }
};
</script>

<style lang="less" scoped>
.banner_list{
  .types{
    margin-bottom: 20px;
  }
  .type_manage_btn{
    position: relative;
    top: -10px;
    left: 5px;
  }
  .add_btn{
    float: right;
  }
  .row:first-child{
    border-top-left-radius: 5px;
    border-top-right-radius: 5px;
  }
  .row:last-child{
    border-bottom-left-radius: 5px;
    border-bottom-right-radius: 5px;
  }
  .row{
    background-color: #fff;
    border-bottom: 1px solid #efefef;
    height: 80px;
    padding: 0 10px;
    cursor: move;
    position: relative;
    transition: all .2s;
    &:hover{
      background-color: #f8f9fb;
    }
    .icon{
      position: absolute;
      left: 15px;
      font-size: 33px;
      color: #ddd;
      top: 23px;
    }
    .pic{
      position: absolute;
      left: 70px;
      top: 19px;
    }
    .title{
      margin-top: 19px;
      padding-left: 120px;
      width: 300px;
      font-size: 16px;
      color: #333;
      float: left;
    }

    .info{
      float: left;
      color: #999;
      font-size: 14px;
      margin-top: 20px;
      >span{
        line-height: 20px;
      }
    }
    .option{
      position: absolute;
      right: 20px;
      top: 27px;
    }
  }
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
