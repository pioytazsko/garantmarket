$(document).ready(function () {
            $('.view').click(function () {
                var id = $(this).attr('data');
                var view = $(this).attr('value');
                $.ajax({
                    type: "POST",
                    url: "/admin/controller/view_item.php",
                    data: {
                        id: id,
                        view:view
                    },
                    success: function (data) {
                        console.log(data);

                    }
                });
                if (view=='view'){$(this).val('not')}else {$(this).val('view')}
                
            })
        })