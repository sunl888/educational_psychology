<template>
  <div class="setting_list">
    <ListWrapper ref="list" title="设置列表" :queryName="mixinConfig.action">
      <span slot="option"><Button @click="$router.push({name: 'addSetting'})" icon="plus-round" type="primary">添加</Button></span>
      <template slot-scope="props">
        <TTable :columns="colums" :data="props.data"></TTable>
      </template>
    </ListWrapper>
  </div>
</template>

<script>
  import ListWrapper from '../../components/ListWrapper.vue';
  import HoverableTime from '../../components/HoverableTime.vue';
  import delMixin from '../../mixins/del';
  import TTable from '../../components/t-table';
  import { strLimit } from '../../utils/utils';
  export default {
    components: { HoverableTime, TTable, ListWrapper },
    mixins: [delMixin],
    data () {
      return {
        settings: [],
        colums: [
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
</style>
