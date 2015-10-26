jQuery(document).ready(function () {
    var searchKeyword = jQuery('#search-keyword');
    var searchBlock = jQuery('#search-block');
    var searchEmpty = jQuery('#empty-search');
    var searchForm = jQuery('#search-from');
    searchKeyword.unbind();
    searchKeyword.keyup(function () {
        if (searchKeyword.val().length > 2) {
            searchEmpty.css({
                display: 'inline-block'
            });
            jQuery.ajax({
                type: "POST",
                url: "/tool.by/searchkeyword.php",
                //                url: "/searchkeyword.php",
                data: {
                    "search": searchKeyword.val()
                },
                cache: false,
                success: function (response) {
                    //                    alert(response);
                    searchBlock.show();
                    searchBlock.html(response);
                    var searchLink = jQuery('#button-show-all');
                    searchLink.unbind();
                    searchLink.click(function () {
                        searchForm.submit();
                        return false;
                    }); jQuery('#show_all').css("cursor","pointer");
                    jQuery('#show_all').bind('click', function () {
                        jQuery('#search_button').trigger('click');
                       
                    });

                }
            });
        }
        return false;
    });
    searchEmpty.unbind();
    searchEmpty.click(function () {
        //        searchKeyword.val('');
        searchEmpty.hide();
        searchBlock.hide();
        return false;
    });
    jQuery(':not(#search-block,#search-keyword,#empty-search,#search_button)').bind('click', function () {
        searchEmpty.hide();
        searchBlock.hide();
    });
});