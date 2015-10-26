jQuery(document).ready(function () {
    var searchKeyword = jQuery('#search-keyword');
    var searchBlock = jQuery('#search-block');
    var searchEmpty = jQuery('#empty-search');
    var searchForm = jQuery('#search-from');
    searchKeyword.unbind();
    searchKeyword.keyup(function () {
        if (searchKeyword.val().length > 2) {
            searchEmpty.css({display: 'inline-block'});
            jQuery.ajax({
                type: "POST",
                url: "searchkeyword.php",
                data: {"search": searchKeyword.val()},
                cache: false,
                success: function (response) {
                    searchBlock.show();
                    searchBlock.html(response);
                    var searchLink = jQuery('#button-show-all');
                    searchLink.unbind();
                    searchLink.click(function(){
                        searchForm.submit();
                       return false; 
                    });
                }
            });
        }
        return false;
    });

    searchEmpty.unbind();
    searchEmpty.click(function () {
        searchKeyword.val('');
        searchEmpty.hide();
        searchBlock.hide();
        return false;
    });

});