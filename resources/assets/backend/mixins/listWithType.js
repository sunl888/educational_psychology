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
    }
  },
  data () {
    return {
      typeId: null,
      types: [],
      list: [],
      showTypeManagementDialog: false
    };
  },
  mounted () {
    let url = this.$options.base.url;
    this.$http.get('types', {
      params: {
        model: url.substring(0, url.length - 1)
      }
    }).then(res => {
      this.types = res.data.data;
      if (this.types[0]) {
        this.typeId = this.types[0].id;
      }
    });
    this.$on('del-success', this.getList);
  }
};
