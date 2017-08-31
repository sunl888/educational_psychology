<template>
  <div class="type_management">
    <Modal width="700" v-model="showTypeListDialog" title="分类列表">
      <Button style="margin-bottom: 15px;" class="add_btn" @click="showAddDialog" icon="plus-round" type="primary">添加</Button>
      <Table :columns="tyleCol" :data="types"></Table>
    </Modal>
    <!-- 编辑分类 -->
    <Modal width="450" v-model="showTypeEditDialog" :title="title" @on-ok="confirm">
      <Form :model="formData" :label-width="50">
        <Form-item label="分类名">
          <Input v-model="formData.name" placeholder="请设置分类名"></Input>
        </Form-item>
        <Form-item label="描述">
          <Input v-model="formData.description" type="textarea" :rows="4" placeholder="请设置描述"></Input>
        </Form-item>
      </Form>
    </Modal>
  </div>
</template>

<script>
import fromMixin from '../mixins/form';
import delMixin from '../mixins/del';
export default {
  name: 'typeManagement',
  base: {
    title: '分类',
    url: 'types',
    isAdd: true
  },
  props: {
    typeQueryName: String,
    value: {
      type: Boolean,
      default: false
    }
  },
  watch: {
    'value' (curVal) {
      if (this.showTypeListDialog !== curVal) {
        this.showTypeListDialog = curVal;
      }
    },
    'showTypeListDialog' (curVal) {
      this.$emit('input', curVal);
    }
  },
  mixins: [ fromMixin, delMixin ],
  data () {
    return {
      formData: {
        'name': null,
        'description': null,
        'model_name': this.typeQueryName
      },
      types: [],
      showTypeListDialog: this.value,
      showTypeEditDialog: false,
      tyleCol: [
        {
          title: '分类名',
          key: 'name'
        },
        {
          title: '描述',
          key: 'description'
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
                    this.id = params.row.id;
                    this.$options.isAdd = false;
                    this.init();
                    this.showTypeEditDialog = true;
                  }
                }
              }, '编辑'),
              h('Button', {
                props: {
                  type: 'error',
                  size: 'small'
                },
                on: {
                  click: () => { this.del(params.row.id); }
                }
              }, '删除')
            ]);
          }
        }
      ]
    };
  },
  methods: {
    getTypeList () {
      this.$http.get('types', {
        params: {
          model: this.typeQueryName
        }
      }).then(res => {
        this.types = res.data.data;
      });
    },
    showAddDialog () {
      this.id = null;
      this.$options.isAdd = true;
      this.formData = {};
      this.init();
      this.showTypeEditDialog = true;
    }
  },
  mounted () {
    this.getTypeList();
    this.$on('on-success', this.getTypeList);
    this.$on('del-success', this.getTypeList);
  }
};
</script>

<style scoped lang="less">

</style>
