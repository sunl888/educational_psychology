<template>
  <div class="link_list">
    <RadioGroup v-model="typeId" class="types" type="button" size="large">
      <Radio v-for="item in types" :key="item.id" :label="item.id">{{item.name}}</Radio>
    </RadioGroup>
    <Button icon="wrench" class="type_manage_btn" @click="showTypeManagementDialog = true"  type="primary">管理分类</Button>
    <Button class="add_btn" @click="$router.push({name: 'addLink'})" icon="plus-round" type="primary">添加友情链接</Button>
    <draggable v-model="links" :options="{draggable: '.row'}">
      <DraggableRow 
        v-for="item in links"
        :key="item.id"
        :id="item.id"
        :url="item.url"
        :time="item.created_at"
        :pic="item.logo_url"
        :title="item.name"
        @on-edit="id => $router.push({name: 'editLink', params: { id }})"
        @on-del="del"
        ></DraggableRow>
    </draggable>
    <NoData v-if="links.length ===  0"></NoData>
    <TypeManagement typeQueryName="link" v-model="showTypeManagementDialog"/>
  </div>
</template>

<script>
import delMixin from '../../mixins/del';
import draggable from 'vuedraggable';
import { Carousel3d, Slide } from 'vue-carousel-3d';
import TypeManagement from '../../components/TypeManagement.vue';
import NoData from '../../components/NoData.vue';
import DraggableRow from '../../components/DraggableRow.vue';
export default {
  base: {
    title: '友情链接',
    url: 'links'
  },
  components: { draggable, Carousel3d, Slide, TypeManagement, NoData, DraggableRow },
  mixins: [ delMixin ],
  data () {
    return {
      typeId: null,
      types: [],
      links: [],
      showTypeManagementDialog: false
    };
  },
  watch: {
    'typeId' () {
      this.getLinkList();
    }
  },
  methods: {
    getLinkList () {
      this.$http.get('links', {
        params: {
          'type': this.typeId
        }
      }).then(res => {
        this.links = res.data.data;
      });
    }
  },
  mounted () {
    this.$http.get('types', {
      params: {
        model: 'link'
      }
    }).then(res => {
      this.types = res.data.data;
      if (this.types[0]) {
        this.typeId = this.types[0].id;
      }
    });
    this.$on('del-success', this.getLinkList);
  }
};
</script>

<style scoped lang="less">

</style>
