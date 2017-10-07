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
<footer class="footer">
    &copy; 2017 xx科技 版权所有 [xxxxx号]
</footer>
