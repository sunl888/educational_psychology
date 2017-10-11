<template>
  <div class="setting_list">
    <div class="option">
        <span><Button @click="$router.push({name: 'addSetting'})" icon="plus-round" type="primary">添加</Button></span>
    </div>
    <TTable :columns="col" :data="settings"></TTable>
  </div>
</template>

<script>
  import HoverableTime from '../../components/HoverableTime.vue';
  import delMixin from '../../mixins/del';
  import TTable from '../../components/t-table';

  export default {
    components: { HoverableTime, TTable },
    mixins: [delMixin],
    mounted () {
      this.getSettings();
      this.$on('del-success', id => {
        this.getSettings();
      });
    },
    methods: {
      getSettings () {
        this.$http.get('settings').then(res => {
          this.settings = res.data.data;
        });
      }
    },
    data () {
      return {
        settings: [],
        col: [
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
              }, params.value && params.value.length > 10 ? params.value.substr(0, 10) + '...' : params.value);
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
              }, params.description && params.description.length > 10 ? params.description.substr(0, 10) + '...' : params.description);
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
.setting_list{
  >.option{
    overflow: hidden;
    margin-bottom: 20px;
    >span{
      float: right;
      margin-right: 10px;
    }
  }
}
</style>
