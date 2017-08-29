export default{
  methods: {
    del (id) {
      this.$Modal.confirm({
        title: '确认删除？',
        content: `你确定要删除该${this.$options.base.title}`,
        onOk: () => {
          this.$http.delete(`${this.$options.base.url}/${id}`).then(res => {
            this.$Message.success('已删除');
            this.$refs['list'].refresh();
          });
        }
      });
    }
  }
};
