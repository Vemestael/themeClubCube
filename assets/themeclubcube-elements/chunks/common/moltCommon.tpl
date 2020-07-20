<script>
    var global = {
        siteUrl: '[[++site_url]]',
        baseUrl: '[[++base_url]]',
        assetsUrl: '[[++assets_url]]',
        cultureKey: '[[++cultureKey]]'
    }
    var jquerySource = '[[+jquerySource]]';
    [[+jsDeferred:is=`1`:then=`
        var jsDeferred = '[[+jsUrl]]';
    `:else=``]]

    [[+cssDeferred:is=`1`:then=`
        var cssDeferred = '[[+cssUrl]]';
    `:else=``]]
</script>