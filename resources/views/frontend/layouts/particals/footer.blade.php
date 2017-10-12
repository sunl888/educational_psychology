@push('js')
<script>
    $(function () {
        var $footer = $('footer.footer');
        var $window = $(window);
        var $body = $('body');
        $window.resize(function () {
            console.log($window.height(), $body.height());
            if ($window.height() > $body.height() + 110) {
                $footer.hide();
            } else {
                $footer.show();
            }
        });
        $window.resize();
    })
</script>
@endpush
<footer class="footer"{!! isset($contentPage)?'style="background: #f5f6f5"':'' !!}>
    &copy; {!! date('Y') !!} {{ setting('site_name') }} 版权所有 [{{ setting('record_number') }}]
</footer>
