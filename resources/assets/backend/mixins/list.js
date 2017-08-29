export default{
  props: {
    title: String,
    queryName: String,
    pageSize: {
      type: Number,
      default: 10
    }
  },
  data () {
    return {
      keyword: '',
      total: 0,
      perPage: this.pageSize,
      currentPage: 1,
      allowSortFields: [],
      delayTimer: null,
      list: [],
      loading: false
    };
  },
  mounted () {
    this.getList();
  },
  watch: {
    'keyword' () {
      if (this.delayTimer === null) {
        this.delayTimer = setTimeout(() => {
          this.getList(1, this.keyword);
          clearTimeout(this.delayTimer);
          this.delayTimer = null;
        }, 300);
      }
    }
  },
  methods: {
    refresh () {
      this.$nextTick(() => {
        this.getList(this.currentPage);
      });
    },
    getList (page = 1, keyword = '', sort) {
      if (this.queryName) {
        this.loading = true;
        this.$http.get(this.queryName, {
          params: {
            per_page: this.perPage,
            page,
            q: keyword
          }
        }).then(res => {
          this.loading = false;
          this.list = res.data.data;
          this.total = res.data.meta.pagination.total;
          this.allowSortFields = res.data.meta.allow_sort_fields;
        }).catch(() => {
          this.loading = false;
        });
      }
    },
    change (currentPage) {
      this.getList(currentPage);
    }
  }
};
