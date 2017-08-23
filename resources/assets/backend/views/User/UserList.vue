<template>
  <div>
    <TTableWrapper title="用户列表">
      <span slot="option"><Button icon="plus-round" type="primary">添加</Button></span>
      <TTable :columns="userCol" :data="userList" />
    </TTableWrapper>
  </div>
</template>
<script>
  import TTable from '../../components/t-table';
  import UserWeight from '../../components/UserWeight.vue';
  import TTableWrapper from '../../components/t-table-wrapper';
  export default {
    components: { TTable, UserWeight, TTableWrapper },
    data () {
      return {
        userCol: [
          {
            title: '用户',
            key: 'name',
            render: (h, params) => {
              return h(UserWeight, {
                props: {name: params.name}
              });
            },
            width: '200px'
          },
          {
            title: '创建日期',
            key: 'date',
            type: 'gray'
          },
          {
            title: '状态',
            key: 'status',
            render: (h, params) => {
              return h('Tag', {
                props: {color: 'green'}
              }, params.status);
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
                }, '查看'),
                h('Button', {
                  props: {
                    type: 'error',
                    size: 'small'
                  }
                }, '删除')
              ]);
            }
          }
        ],
        userList: [
          {
            name: '王小明',
            age: 18,
            status: '正常',
            date: '2016-10-03'
          },
          {
            name: '张小刚',
            age: 25,
            status: '正常',
            date: '2016-10-01'
          }
        ]
      };
    }
  };
</script>
