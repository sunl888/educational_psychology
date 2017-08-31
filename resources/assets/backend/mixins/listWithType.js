import delMixin from './del';
import draggable from 'vuedraggable';
import TypeManagement from '../components/TypeManagement.vue';
import NoData from '../components/NoData.vue';
import DraggableRow from '../components/DraggableRow.vue';
export default {
  mixins: [ delMixin ],
  components: { draggable, TypeManagement, NoData, DraggableRow },
  watch: {
    'typeId' () {
      this.$router.push({name: this.$route.name, params: {id: this.typeId}});
      this.getList();
    }
  },
  methods: {
    getList () {
      this.$http.get(this.$options.base.url, {
        params: {
          'type': this.typeId
        }
      }).then(res => {
        this.list = res.data.data;
      });
    },
    reSort () {
      this.$http.post('settings/index_order', {
        index_order: this.list.map(item => item.id),
        model: this.model
      });
    },
    refreshType () {
      this.$http.get('types', {
        params: {
          model: this.model
        }
      }).then(res => {
        this.types = res.data.data;
      });
    }
  },
  data () {
    return {
      typeId: null,
      types: [],
      list: [],
      showTypeManagementDialog: false,
      model: ''
    };
  },
  mounted () {
    let url = this.$options.base.url;
    this.model = url.substring(0, url.length - 1);
    this.$http.get('types', {
      params: {
        model: this.model
      }
    }).then(res => {
      this.types = res.data.data;
      let tid = Number(this.$route.params.id);
      if (!isNaN(tid) && this.types.some(item => item.id === tid)) {
        this.typeId = tid;
      } else if (this.types[0]) {
        this.typeId = this.types[0].id;
      }
    });
    this.$on('del-success', this.getList);
  }
};
