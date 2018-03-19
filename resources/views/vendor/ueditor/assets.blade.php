<!-- 配置文件 -->
<script type="text/javascript" src="{{ asset('vendor/neditor/neditor.config.js') }}"></script>
<!-- 编辑器源码文件 -->
<script type="text/javascript" src="{{ asset('vendor/neditor/neditor.all.js') }}"></script>
<script>
    window.UEDITOR_CONFIG.serverUrl = '{{ route(config('ueditor.route.name')) }}'
</script>