<template>
  <div class="setting_list">
    <RadioGroup v-model="typeName" type="button" size="large">
      <Radio v-for="item in types" :key="item.id" :label="item.name">{{item.display_name}}</Radio>
    </RadioGroup>
    <Button icon="wrench" :class="{'type_manage_btn': types.length > 0}" @click="showTypeManagementDialog = true"  type="primary">管理分类</Button>
    <Button class="add_btn" @click="$router.push({name: 'addSetting'})" icon="plus-round" type="primary">添加</Button>  
    <TTable class="table" :columns="columns" :data="list"></TTable>
    <TypeManagement @change="refreshType" typeQueryName="settings" v-model="showTypeManagementDialog"/>
  </div>
</template>

<script>
  import HoverableTime from '../../components/HoverableTime.vue';
  import listWithTypeMixin from '../../mixins/listWithType';
  import TTable from '../../components/t-table';
  import { strLimit } from '../../utils/utils';
  export default {
    components: { HoverableTime, TTable },
    mixins: [listWithTypeMixin],
    data () {
      return {
        settings: [],
        columns: [
          {
            title: '设置项',
            key: 'name'
          },
          {
            title: '设置值',
            key: 'value',
            render: (h, params) => {
              return h('span', {
                attrs: {
                  'title': params.value
                }
              }, strLimit(params.value, 10));
            }
          },
          {
            title: '描述',
            key: 'description',
            render: (h, params) => {
              return h('span', {
                attrs: {
                  title: params.description
                }
              }, strLimit(params.description, 10));
            }
          },
          {
            title: '创建日期',
            key: 'created_at',
            render: (h, params) => {
              return h(HoverableTime, {
                props: {time: params.created_at}
              });
            },
            width: '100px'
          },
          {
            title: '操作',
            key: 'action',
            render: (h, params) => {
              return h('div', [
                h('Button', {
                  props: {
                    type: 'primary',
                    size: 'small'
                  },
                  style: {
                    marginRight: '5px'
                  },
                  on: {
                    click: () => {
                      this.$router.push({name: 'editSetting', params: {id: params.id}});
                    }
                  }
                }, '编辑'),
                h('Button', {
                  props: {
                    type: 'error',
                    size: 'small'
                  },
                  on: {
                    click: () => { this.del(params.id); }
                  }
                }, '删除')
              ]);
            }
          }
        ]
      };
    },
    computed: {
      mixinConfig () {
        return {
          title: '站点设置',
          action: 'settings'
        };
      }
    },
  };
</script>
<style lang="less" scoped>
.table{
  margin-top: 20px;
}
.add_btn{
  float: right;
}
</style>
