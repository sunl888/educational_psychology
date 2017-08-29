export default{
  methods: {
    del (id) {
      this.$Modal.confirm({
        title: '提示',
        content: this.activeTab === 'default' ? '你确定要删除该文章?' : '在回收站中删除该文章将无法恢复你确定要删除？',
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
