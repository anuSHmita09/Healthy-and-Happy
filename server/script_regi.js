
        $(document).ready(function () {
            $('#submit').click(function () {
                var name = $('#name').val();

                $.ajax({
                    url: 'process.php',
                    type: 'POST',
                    data: { name: name },
                    success: function (response) {
                        $('#response').html(response);
                    }
                });
            });
        });
