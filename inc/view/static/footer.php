<?php if (!defined('X')) die('Deny Access');?>
<script>
    $(document).ready(function() {
        Getonlines();
        $('#getOnlines').click(function(event) {
            event.preventDefault();
            Getonlines();
        });
    });

    function Getonlines(){
        $.ajax({
            url: 'getOnlines',
            method: 'GET',
            dataType: 'json',
            success: function(data) {
                $('#loading').hide()

                if (data.length === 0) {
                    $('#no-data').show();
                } else {
                    let rows = '';
                    data.forEach(item => {
                        const [color, name] = item.user.split(':|:');
                        rows += `<tr>
                                    <td><i class="fa-solid fa-2xs fa-circle ${item.live}"></i></td>
                                    <td>${colorGroup(color, name)}</td>
                                    <td>${item.where}</td>
                                    <td>${item.date}</td>
                                </tr>`;
                    });

                    $('#onlines').html(rows);
                    $('#data-table').show();
                }
            },
            error: function() {
                $('#loading').hide();
                $('#no-data').show();
            }
        });

        return false;
    }

    function hexToRgba(hex, alpha) {
        hex = hex.replace('#', '');
        if (hex.length === 3) {
            hex = hex[0] + hex[0] + hex[1] + hex[1] + hex[2] + hex[2];
        }
        var r = parseInt(hex.substring(0, 2), 16);
        var g = parseInt(hex.substring(2, 4), 16);
        var b = parseInt(hex.substring(4, 6), 16);
        var a = alpha || 1;
        return 'rgba(' + r + ', ' + g + ', ' + b + ', ' + a + ')';
    }

    function colorGroup(color, name) {
        const bgColor = hexToRgba(color, '0.18');
        return `<span style="color:${color};background-color:${bgColor};" class="badge badge-pill font-size-13">${name}</span>`;
    }
</script>
</body>
</html>
