<template>
  <div>
    <TTableWrapper title="用户列表" queryName="users?include=roles">
      <span slot="option"><Button @click="$router.push({name: 'addUser'})" icon="plus-round" type="primary">添加</Button></span>
      <template scope="props">
        <TTable :columns="userCol" :data="props.data" />
      </template>
    </TTableWrapper>
  </div>
</template>
<script>
  import TTable from '../../components/t-table';
  import UserWeight from '../../components/UserWeight.vue';
  import TTableWrapper from '../../components/t-table-wrapper';
  import HoverableTime from '../../components/HoverableTime.vue';
  export default {
    components: { TTable, UserWeight, TTableWrapper, HoverableTime },
    data () {
      return {
        userCol: [
          {
            title: '昵称',
            key: 'nick_name',
            render: (h, params) => {
              return h(UserWeight, {
                props: params
              });
            },
            width: '200px'
          },
          {
            title: '用户名',
            key: 'user_name',
            width: '160px'
          },
          {
            title: 'email',
            key: 'email',
            type: 'gray',
            style: {'text-align': 'left'},
            width: '230px'
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
            title: '状态',
            key: 'locked_at',
            render: (h, params) => {
              const status = params.locked_at === null;
              return h('Tag', {
                props: {color: status ? 'green' : 'red', type: 'border'}
              }, status ? '正常' : '锁定');
            }
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
                  }
                }, '编辑'),
                h('Button', {
                  props: {
                    type: 'error',
                    size: 'small'
                  }
                }, '删除')
              ]);
            }
          }
        ]
      };
    }
  };
</script>